<?php

namespace App\Http\Controllers\admin\offers;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\offer\StoreRequest;
use App\Http\Requests\admin\offer\UpdateRequest;
use App\Models\products\Offer;
use App\Models\products\Product;
use File;
use Response;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $offers = Offer::paginate(25);
        $products = Product::pluck('name_' . app()->getLocale(), 'id')->toArray();
        $offers->load('product');
        return view('AdminPanel.offers.index', [
            'active' => 'offers',
            'title' => trans('common.offers'),
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.offers'),
                ],
            ],
        ], compact('offers', 'products'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try {

            $Offer = Offer::create($request->validated());
            if ($request->hasFile('image')) {

                $Offer['image'] = upload_image('offers/' . $Offer->id, $request->image);
                $Offer->update();

            }

            if ($Offer) {

                return redirect()->route('offers.index')
                ->with('success', trans('common.successMessageText'));
            }
            else{
                return redirect()->back()
    
                ->with('failed', trans('common.faildMessageText'));
            }
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function update(UpdateRequest $request, Offer $offer)
    {
        $offer->update($request->except('_token', 'image'));

        if ($request->hasFile('image')) {
            delete_image('uploads/offers/' . $offer->id, $offer->getRawOriginal('image'));

            $offer['image'] = upload_image('offers/' . $offer->id, $request->image);
            $offer->update();
        }
        if ($offer) {
            return redirect()->route('offers.index')
                ->with('success', 'تم تعديل البيانات بنجاح');
        } else {
            return redirect()->back()
                ->with('failed', 'لم نستطع تعديل البيانات');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Offer $offer)
    {
        if (File::exists('uploads/offers/' . $offer->id))
        File::deleteDirectory('uploads/offers/' . $offer->id);
      
        if ($offer) {

            $offer->delete();

            return Response::json($offer->id);
        } else {
            return Response::json("false");
        }
    }
}

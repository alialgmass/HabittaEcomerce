<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\snacks\StoreRequest;
use App\Http\Requests\admin\snacks\UpdateRequest;
use App\Models\products\Snack;
use Response;

class SnackController extends Controller
{
    public function index()
    {
        $snacks = Snack::paginate(25);
        return view('AdminPanel.snacks.index', [
            'active' => 'snacks',
            'title' => trans('common.snacks'),
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.snacks')
                ]
            ]
        ], compact('snacks'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try{

            $snack = Snack::create($request->validated());
            if ($request->hasFile('image')) {

                $snack['image'] = upload_image('snacks/' . $snack->id, $request->image);
                $snack->update();

            }

            if ($snack) {

                return redirect()->route('snacks.index')
                ->with('success', 'تم حفظ البيانات بنجاح');
            } else {

                return redirect()->back()
                    ->with('failed', 'لم نستطع حفظ البيانات');
            }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
    }




    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request,Snack $snack)
    {


        $snack->update($request->except('_token', 'image'));

        if ($request->hasFile('image')) {
            delete_image('uploads/snacks/' . $snack->id ,$snack->getRawOriginal('image'));

            $snack['image'] = upload_image('snacks/' . $snack->id, $request->image);
            $snack->update();
        }
        if ($snack) {
            return redirect()->route('snacks.index')
            ->with('success', trans('common.successMessageText'));
        }
        else{
            return redirect()->back()

            ->with('failed', trans('common.faildMessageText'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Snack $snack)
    {



        if ($snack) {
            delete_image('uploads/snacks/' . $snack->id ,$snack->getRawOriginal('image'));
            $snack->delete();


            return Response::json($snack->id);
        } else {
            return Response::json("false");
        }


    }
}

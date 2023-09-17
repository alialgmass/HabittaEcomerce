<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\coupons\StoreRequest;
use App\Models\orders\Coupon;
use Illuminate\Http\Request;
use Response;

class CouponsController extends Controller
{
    public function index()
    {
        $coupons = Coupon::orderBy('id','asc')->paginate(25);
        return view('AdminPanel.coupons.index', [
            'active' => 'coupons',
            'title' => trans('common.coupons'),
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.promoCode')
                ]
            ],
        ], compact('coupons'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        $coupon = Coupon::create($data);
        if ($coupon) {
            return redirect()->route('coupons.index')->with([
                'success'=> trans('common.yourCouponAddedSuccessfully'),
                'Active' => 'coupons',
            ]);
        }
        return redirect()->back()->with(['failed'=>trans('common.yourCouponNotAddedSuccessfully')]);
    }

    public function destroy($id)
    {
        $coupon = Coupon::find($id);
        if ($coupon->delete()) {
            return Response::json($id);
        }
        return Response::json("false");
    }
}

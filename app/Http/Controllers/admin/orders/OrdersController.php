<?php

namespace App\Http\Controllers\admin\orders;

use App\Http\Controllers\Controller;
use App\Models\orders\Order;
use Illuminate\Http\Request;
use League\CommonMark\Node\Query\OrExpr;

class OrdersController extends Controller
{
    public function index(Request $request)
    {
        $orders = Order::with(['items','delivery','user','restaurant','address'])->orderBy('status', 'asc');
        if ($request->has('client_id'))
        {
            if ($_GET['client_id'] != '') {
                $orders = $orders->where('user_id', $_GET['client_id']);
            }
        }
        if ($request->has('order_number'))
        {
            if ($_GET['order_number'] != '') {
                $orders = $orders->where('order_number', $_GET['order_number']);
            }
        }
        if ($request->has('status'))
        {
            if ($_GET['status'] != '') {
                $orders = $orders->where('status', $_GET['status']);
            }
        }
        if (isset($_GET['from_date']))
        {
            if ($_GET['from_date'] != '') {
                $orders = $orders->where('date_time_str', '>=', strtotime($_GET['from_date']));
            }
        }
        if (isset($_GET['to_date']))
        {
            if ($_GET['to_date'] != '') {
                $orders = $orders->where('date_time_str', '<=', strtotime($_GET['to_date']));
            }
        }
        $orders = $orders->paginate(20);

        return view('AdminPanel.orders.index', [
            'title' => trans('common.orders'),
            'active' => 'orders',
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.orders')
                ]
            ]
        ], compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['items', 'user', 'address', 'coupon']);
        return view('AdminPanel.orders.details', [
            'title' => trans('common.orders'),
            'active' => 'orders',
            'breadcrumbs' => [
                [
                    'url' => route('orders.index'),
                    'text' => trans('common.orders')
                ],
                [
                    'url' => '',
                    'text' => trans('common.order') . ': #' . $order->order_number
                ]
            ]
        ], compact('order'));
    }

    public function update(Request $request, Order $order){
        $msg = trans('common.statusUpdatedSuccessfully');
        if($request->status == 'cancelled'){
            $userBalance = $order->user->balance;
            $order->user()->update([
                'balance' => (float)$userBalance + (float)$order->total
            ]);
            $msg = trans('common.orderTotalReturnToUserWallet');
        }
        $order->update([
            'status' => $request->status
        ]);
        return redirect()->route('orders.index')
        ->with('success', $msg);
    }
}

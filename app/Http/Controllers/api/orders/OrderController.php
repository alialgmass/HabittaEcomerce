<?php

namespace App\Http\Controllers\api\orders;

use App\Http\Controllers\Controller;
use App\Http\Resources\orders\OrderResource;
use App\Models\orders\Order;
use App\Models\orders\OrderItems;
use App\Models\products\Product;
use Illuminate\Http\Request;
use App\Http\Requests\api\orders\storeOrderRequest;
use App\Traits\messageTrait;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
use messageTrait;
    public function index()
    {
        try{
            $user=auth()->user();
            $user->load('orders');
            $orders=$user->orders()->with(['addresses','user'])->get();
            return $this->successfully('true',['order'=>OrderResource::collection($orders)]);
        }
        catch (\Exception $exception){
            $this->failed($exception->getMessage());
        }

    }



    public function store(storeOrderRequest $request)
    {
        try{
            DB::beginTransaction();
            $user=auth()->user();
            $data=$request->validated();
            $products = $data['products'];
            if(empty($products)){
                return $this->failed('productsIsRequired', JsonResponse::HTTP_UNPROCESSABLE_ENTITY);
            }
            $data+=['order_number'=>$this->make_order_number()
                ,'user_id'=>$user->id];
            $order=Order::create($data);
            $subTotal=0;
            foreach ($products as $product){
                $select_product=Product::find($product['product_id']);
                $subTotal+=$select_product->price * $product['quantity'];
                $items = OrderItems::create([
                    'order_id' => $order->id,
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'price' => $select_product->price,
                    'total' => $select_product->price * $product['quantity'],
                    'notes' => $product['notes'] ?? '',
                ]);
            }
            $order->update(['subtotal'=>$subTotal,'total'=>$subTotal]);

                DB::commit();
                return $this->successfully('true',$order);


        }
        catch(\Exception $exception){
            DB::rollBack();
            return $this->failed($exception->getMessage());
        }

    }


    public function show(string $id)
    {

    }




    public function update(Request $request, string $id)
    {

    }


    public function destroy(string $id)
    {

    }
    public function  make_order_number(){
        $user=auth()->user();
        $user->load('orders');

        $order_numbers=auth()->user()->orders()->pluck('order_number')->toArray();
        $order_number=auth()->user()->id .'_'. rand(100000, 999999);
        while(in_array($order_number,$order_numbers)){
            $order_number=auth()->user()->id .'_'. rand(100000, 999999);
        }
        return $order_number;

    }
}

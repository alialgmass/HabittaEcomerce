<?php

namespace App\Http\Controllers\front\products;

use App\Http\Controllers\Controller;
use App\Http\Requests\api\wishlists\StoreRequest;
use App\Http\Resources\home\ProductsResource;
use App\Models\products\Product;
use App\Models\products\Wishlist;
use App\Traits\messageTrait;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    use messageTrait;
    public function index(Request $request){
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->get();
        $products = Product::whereIn('id', $wishlists->pluck('product_id'))->get();
        return $this->successfully(trans('api.dataSendSuccessfully'), [
            'products' => ProductsResource::collection($products),
        ]);
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validate($request->rules());
        $wishlist = Wishlist::where('user_id', auth()->user()->id)->where('product_id', $data['product_id'])->first();
        if($wishlist){
            $wishlist->delete();
            $wishlists = Wishlist::where('user_id', auth()->user()->id)->get();
            $products = Product::whereIn('id', $wishlists->pluck('product_id'))->get();
            return $this->successfully(trans('api.productRemoveFromWishlistSuccessfully'), [
                'products' => ProductsResource::collection($products),
            ]);
        }
        $data['user_id'] = auth()->user()->id;
        $wishlist = Wishlist::create($data);
        $wishlists = Wishlist::where('user_id', auth()->user()->id)->get();
        $products = Product::whereIn('id', $wishlists->pluck('product_id'))->get();
        if($wishlist){
            return $this->successfully(trans('api.productAddToWishlistSuccessfully'), [
                'products' => ProductsResource::collection($products),
            ]);
        }
        return $this->failed(trans('api.someThingWentWrong'));
    }
}

<?php

namespace App\Http\Controllers\api\products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\products\Product;
use App\Http\Resources\home\ProductsResource;
use App\Traits\messageTrait;
use App\Http\Resources\product\ProductDetailsResource;

class ProductController extends Controller
{
    use messageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('active', 1)->where('quantity','>',1)->paginate(25);
        return $this->successfully(trans('api.dataSendSuccessfully'), [
            'products' => ProductsResource::collection($products),
        ]);
    }

   

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
       return new  ProductDetailsResource($product);
    }

    

   
}

<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Http\Resources\home\CategoriesResource;
use App\Http\Resources\home\productsResource;
use App\Models\categories\Category;
use App\Models\products\Product;
use App\Traits\messageTrait;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use messageTrait;

    public function index()
    {
        $request= (object)$_REQUEST;
        $categories = Category::where('status', 'active')->orderBy('ordering')->get();

        $products = Product::with('category')->where('active', 1)->where('quantity','>',1);


        if ( isset($request->categoryId ) && $request->categoryId != 0) {
            $categoryId = $request->categoryId;

            $products = $products->where('category_id', $categoryId);


        }

        $products = $products->latest()->paginate(25);


        $data = [
            'categories' => CategoriesResource::collection($categories),
            'products' => productsResource::collection($products),

        ];

        return  view('front.index',compact('data'));
    }
    public function show(){}

}

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\home\CategoriesResource;
use App\Http\Resources\home\ProductsResource;
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

        $newProducts = Product::with('category')->where('active', 1)->where('quantity','>',1);
        $topRatedProducts = Product::with('category')->where('active', 1)->where('quantity','>',1);
        
        if ( $request->categoryId != '' && $request->categoryId != 0) {
            $categoryId = $request->categoryId;

            $newProducts = $newProducts->where('category_id', $categoryId);
            $topRatedProducts = $topRatedProducts->where('category_id', $categoryId);

        }

        $newProducts = $newProducts->latest()->take(7)->get();
        $topRatedProducts = $topRatedProducts->withAvg('reviews', 'rating')->orderByDesc('reviews_avg_rating')->take(7)->get();

        $data = [
            'categories' => CategoriesResource::collection($categories),
            'newProducts' => ProductsResource::collection($newProducts),
            'topRatedProducts' => ProductsResource::collection($topRatedProducts),
            
        ];

        return $this->successfully(trans('api.dataSendSuccessfully'), [
            'home' => $data,
        ]);
    }
    public function show(){}

}

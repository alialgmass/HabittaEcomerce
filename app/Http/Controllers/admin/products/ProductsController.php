<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use App\Http\Requests\admin\products\StoreProductRequest;
use App\Http\Requests\admin\products\UpdateProductRequest;
use App\Models\products\Option;
use App\Models\products\Product;
use App\Models\products\ProductOption;
use App\Models\products\ProductOptionItems;
use App\Models\products\Specification;
use App\Repositories\products\ProductRepository;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    protected $productRepository;
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->paginate(25);
        return view('AdminPanel.products.index', [
            'active' => 'products',
            'title' => trans('common.products'),
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.products')
                ]
            ]
        ], compact('products'));
    }

    public function create()
    {
        return $this->productRepository->create();
    }

    public function show(Product $product){
        return $this->productRepository->show($product);
    }

    public function store(StoreProductRequest $request)
    {
        try {
            DB::beginTransaction();
            return $this->productRepository->store($request);
        } catch (\Exception $e) {
            DB::rollBack();
            return $e->getMessage();
        }
    }

    public function edit(Product $product)
    {
        return $this->productRepository->edit($product);
    }

    public function update(UpdateProductRequest $request, Product $product)
    {
        return $this->productRepository->update($request,$product);
    }

    public function destroy(Product $product)
    {
        return $this->productRepository->destroy($product);
    }

    public function deleteImage($key)
    {
        $product = Product::where('mainImage', $key)->first();
        if ($product->mainImage != '') {
            delete_image('uploads/products/' . $product->id, $product->mainImage);
            $product->mainImage = '';
            $product->update();
        }
        session()->flash('success', trans('common.successMessageText'));
        return back();
    }

    public function Images($key)
    {
        $image = productImage::where('additionalImages', $key)->first();
        if ($image->additionalImages != '') {
            delete_image('uploads/products/' . $image->product_id, $image->additionalImages);
            $image->additionalImages = '';
            $image->update();
        }
        session()->flash('success', trans('common.successMessageText'));
        return back();
    }

}

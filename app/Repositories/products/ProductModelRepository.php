<?php
namespace App\Repositories\products;

use App\Http\Requests\admin\products\StoreProductRequest;
use App\Models\categories\Category;
use App\Models\products\Addon;
use App\Models\products\Ingredient;
use App\Models\products\Nutrient;
use App\Models\products\Product;
use App\Models\products\Size;
use File;
use  App\Models\products\ProductFeature;
use Illuminate\Support\Facades\DB;
use Response;

class ProductModelRepository implements ProductRepository
{
    public function create()
    {
        $categories = Category::where('id', '!=', '0')->pluck('name_' . app()->getLocale(), 'id')->toArray();

        
        return view('AdminPanel.products.create', [
            'active' => 'products',
            'title' => trans('common.products'),
            'breadcrumbs' => [
                [
                    'url' => route('products.index'),
                    'text' => trans('common.products'),
                ], [
                    'url' => '',
                    'text' => trans('common.CreateNew'),
                ],
            ],
        ], compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();
        $product = Product::create($data);


        if ($request->image != '') {
            $product['image'] = upload_image('products/' . $product->id, $request->image);
            $product->update();
        }
        if (isset($_FILES['additionalImages'])) {
            for ($i = 0; $i < count($request->additionalImages); $i++) {
                $product->productImages()->create([
                    'additionalImages' => upload_image('products/' . $product->id, $request->additionalImages[$i]),
                ]);
            }
        }
        if (isset($request->key_ar)) {
            for ($i = 0; $i < count($request->key_ar); $i++) {
                ProductFeature::create([
                    'product_id'=>$product->id,
                    'key_ar'=>$request->key_ar,
                    'key_en'=>$request->key_en,
                    'value_ar'=>$request->value_ar,
                    'value_en'=>$request->value_en,
                ]);
            }
        }
        DB::commit();
        if ($product) {
            return redirect()->route('products.index')
            ->with('success', 'تم حفظ البيانات بنجاح');
        } else {
            return redirect()->back()
                ->with('failed', 'لم نستطع حفظ البيانات');
        }
    }

    public function edit($product)
    {
        $product->load( 'offers', 'category');
        $categories = Category::where('id', '!=' , '0')->pluck('name_' . app()->getLocale(), 'id')->toArray();
    
        return view('AdminPanel.products.edit', [
            'active' => 'products',
            'title' => trans('common.products'),
            'breadcrumbs' => [
                [
                    'url' => route('products.index'),
                    'text' => trans('common.products'),
                ],
                [
                    'url' => '',
                    'text' => trans('common.edit') . ' # ' . $product->id,
                ],
            ],
        ], compact('categories', 'product'));
    }

    public function update($request, $product)
    {
        $data = $request->validated();
        $product->update($data);

       

        if ($request->image != '') {
            $product['image'] = upload_image('products/' . $product->id, $request->image);
            $product->update();
        }

        if (isset($_FILES['additionalImages'])) {
            for ($i = 0; $i < count($request->additionalImages); $i++) {
                $product->productImages()->create([
                    'additionalImages' => upload_image('products/' . $product->id, $request->additionalImages[$i]),
                ]);
            }
        }

        if ($product) {
            return redirect()->route('products.index')
                ->with('success', trans('common.successMessageText'));
        } else {
            return redirect()->back()
                ->with('failed', trans('common.faildMessageText'));
        }
    }

    public function show(Product $product)
    {
        $product->load( 'offers', 'category');
        return view('AdminPanel.products.show',
            [
                'active' => 'products',
                'title' => trans('common.products'),
                'breadcrumbs' => [
                    [
                        'url' => route('products.index'),
                        'text' => trans('common.products'),
                    ], [
                        'url' => '',
                        'text' => trans('common.productDetails'),
                    ],
                ],
            ]
            , compact('product'));
    }
    public function destroy(Product $product)
    {

       
            if ($product->image != '') {
                File::deleteDirectory(public_path('uploads/products/' . $product->id), );
            }
            $id = $product->id;
            if ($product->delete()) {
                return Response::json($id);
            } else {
                return Response::json("false");
            }
    }
}

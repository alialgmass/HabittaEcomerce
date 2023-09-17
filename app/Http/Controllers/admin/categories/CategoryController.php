<?php

namespace App\Http\Controllers\admin\categories;

use App\Http\Controllers\Controller;
use App\Models\categories\Category;
use Illuminate\Http\Request;
use App\Http\Requests\admin\category\StoreRequest;
use App\Http\Requests\admin\category\UpdateRequest;
use DB;
use File;
use Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::where('id', '!=', '0')->orderBy('ordering')->paginate(25);

        return view('AdminPanel.categories.index', [
            'active' => 'categories',
            'title' => trans('common.categories'),
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.categories')
                ]
            ]
        ], compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        try{
            DB::beginTransaction();
            $category = Category::create($request->validated());
            if ($request->hasFile('image')) {
                $category['image'] = upload_image('categories/' . $category->id, $request->image);
                $category->update();
            }

            if ($category) {
                DB::commit();
                return redirect()->route('categories.index')
                ->with('success', 'تم حفظ البيانات بنجاح');
            } else {
                DB::rollBack();
                return redirect()->back()
                    ->with('failed', 'لم نستطع حفظ البيانات');
            }
            } catch (\Exception $e) {
                return $e->getMessage();
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function update(UpdateRequest $request,Category $category)
    {

        $category->update($request->except('_token', 'image'));

        if ($request->hasFile('image')) {
            delete_image('uploads/categories/' . $category->id ,$category->getRawOriginal('image'));
            $category['image'] = upload_image('categories/' . $category->id, $request->image);
            $category->update();
        }
        if ($category) {
            return redirect()->route('categories.index')
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
    public function destroy(Category $category)
    {


        delete_image('uploads/categories/' . $category->id ,$category->getRawOriginal('image'));
        if ($category) {

            $category->delete();


            return Response::json($category->id);
        } else {
            return Response::json("false");
        }


    }
}

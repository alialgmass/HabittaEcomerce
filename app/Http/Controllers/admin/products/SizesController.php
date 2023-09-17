<?php

namespace App\Http\Controllers\admin\products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\products\sizes\StoreRequest;
use App\Http\Requests\admin\products\sizes\UpdateRequest;
use App\Models\products\Size;
use Response;

class SizesController extends Controller
{
    //
    public function index(){
        $sizes=Size::paginate(25);
        return view('AdminPanel.sizes.index' ,[
            'active' => 'size',
            'title' => trans('common.size'),
            'breadcrumbs' => [
                [
                    'url' => '',
                    'text' => trans('common.size')
                ]
            ]
        ], compact('sizes'));

    }
    public function store(StoreRequest $request ){
        $size = Size::create($request->validated());
           
            if($size){
                return redirect()->route('sizes.index')
                ->with('success', 'تم حفظ البيانات بنجاح');
            }
            else{
                return redirect()->back()
                ->with('failed', 'لم نستطع حفظ البيانات');
            }
    }
    public function update(UpdateRequest $request,Size $size){
       
        $size->update($request->validated());
      
        
        if ($size) {
            return redirect()->route('sizes.index')
            ->with('success', 'تم تعديل البيانات بنجاح');
        } else {
            return redirect()->back()
                ->with('failed', 'لم نستطع تعديل البيانات');
        } 
    }
    public function destroy(Size $size){
       
        if ($size) {
         
            $size->delete();

           
            return Response::json($size->id);
        } else {
            return Response::json("false");
        }
    }
}

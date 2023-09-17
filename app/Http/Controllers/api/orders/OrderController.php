<?php

namespace App\Http\Controllers\api\orders;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\api\orders\storeOrderRequest;

class OrderController extends Controller
{
    
    public function index()
    {
        
    }

   

    public function store(storeOrderRequest $request)
    {
       $data=$request->validated();
       return $data;
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
}

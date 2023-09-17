<?php

namespace App\Repositories\products;

use App\Http\Requests\admin\product\StoreRequest;
use App\Http\Requests\admin\products\StoreProductRequest;
use App\Http\Requests\admin\products\UpdateProductRequest;
use App\Models\products\Product;

interface ProductRepository {
    public function create();
    public function edit(Product $product);
    public function update(UpdateProductRequest $request, Product $product);
    public function store(StoreProductRequest $request);
    public function show(Product $product);
    // public function edit(Product $product);
    // public function update(StoreRequest $request, Product $product);
    public function destroy(Product $product);
}
?>

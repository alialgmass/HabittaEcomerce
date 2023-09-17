<?php

namespace App\Models\products;

use App\Models\products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class productImages extends Model
{
    use HasFactory;
    protected $table = 'product_images';
    protected $fillable = [
        'product_id',
        'additionalImages',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    
    public function getAdditionalImagesAttribute($value)
    {
        return asset('uploads/products/' . $this->product_id . '/' . $value);
    }

}

<?php

namespace App\Models\review;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\products\Product;
use App\Models\User;

class Review extends Model
{
    use HasFactory;
    protected $table = "reviews";
    protected $fillable=[
        'user_id',
        'product_id',
        'user_name',
        'rating',
        'comment',
        'active'
    ];

    public function product()
    {
       return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // public function getRatingAttribute($value)
    // {
    //     return $value . ' / 5';
    // }
}

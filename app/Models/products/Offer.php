<?php

namespace App\Models\products;

use App\Models\products\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;
    protected $table = 'offers';
    protected $fillable = [
        'product_id',
        'percentage',
        'image',
        'start_date',
        'end_date',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getImageAttribute($value)
    {
        return asset('uploads/offers/' .$this->id. '/'. $value);
    }

    public function getStartDateAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }

    public function getEndDateAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }

    // check if product has special offer or not
    public function hasSpecialOffer()
    {
        $today = date('Y-m-d');
        if ($this->start_date <= $today && $this->end_date >= $today) {
            return true;
        }
        return false;
    }

}

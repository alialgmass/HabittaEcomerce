<?php

namespace App\Models\products;

use App\Models\categories\Category;
use App\Models\products\Offer;
use App\Models\products\productImages;
use App\Models\products\Wishlist;
use App\Models\review\Review;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar', 'name_en', 'description_ar', 'description_en','full_description_ar','full_description_en', 'image', 'price', 'discount', 'quantity', 'active', 'sum_rating', 'count_rating', 'category_id','ordering'];

    public function getNameAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->name_ar;
        }
        return $this->name_en;
    }

    public function getDescriptionAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->description_ar;
        }
        return $this->description_en;
    }
    public function getFullDescriptionAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->full_description_ar;
        }
        return $this->full_description_en;
    }

    public function getImageAttribute($value)
    {
        return asset('uploads/products/' . $this->id . '/' . $value);
    }

    public function getActiveAttribute($value)
    {
        if ($value) {
            return  trans('common.active') ;
        } else {
            return  trans('common.inactive') ;
        }

    }

    public function getRateAttribute()
    {
        if ($this->count_rating == 0) {
            return 0;
        }

        return round($this->sum_rating / $this->count_rating, 1);
    }

    public function inWishlist($product_id)
    {
        if (auth()->user()) {
            $wishlist = Wishlist::where('user_id', auth()->user()->id)->where('product_id', $product_id)->first();
            if ($wishlist) {
                return 1;
            } else {
                return 0;
            }

        }
        return 0;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function productImages()
    {
        return $this->hasMany(productImages::class);
    }

    public function getAdditionalImagesAttribute()
    {
        $images[] = $this->image;
        foreach ($this->productImages as $image) {
            $images[] = $image->additionalImages;
        }
        return $images;
    }

    public function offers()
    {
        return $this->hasMany(Offer::class, 'product_id');
    }
    // check if product has special offer or not
    public function hasOffer(): bool
    {
        $toDay = date('Y-m-d');
        if ($this->offers()->where('end_date', '>=', $toDay)->count() > 0) {
            return true;
        }
        return false;
    }

    public function getOfferAttribute()
    {
        $toDay = date('Y-m-d');
        $offer = $this->offers()->where('end_date', '>=', $toDay)->first();
        if ($offer) {
            $remainingDays = (strtotime($offer->end_date) - strtotime($toDay)) / (60 * 60 * 24);
            return [
                'percentage' => $offer->percentage,
                'priceAfterDiscount' => $this->price - ($this->price * $offer->percentage / 100),
                'remainingDays' => $remainingDays,
            ];
        }
        return [
            'priceAfterDiscount' => 0,
            'percentage' => 0,
            'remainingDays' => 0,
        ];
    }
    public function productfutuer()
    {
        return $this->hasMany(ProductFeature::class);
    }

    public function getProductfutuerAttribute()
    {
        $futuers;
        if (app()->getLocale() == 'ar') {
            foreach ($this->productfutuer()->get() as $futuer) {
                $futuers[]=['key'=>$futuer->key_ar,'value'=>$futuer->value_ar];
            }
        }
        else{
            foreach ($this->productfutuer as $futuer) {
                $futuers[]=['key'=>$futuer->key_en,'value'=>$futuer->value_en];
            }
        }
    
        
        return $futuers;
    }

}

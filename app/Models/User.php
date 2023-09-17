<?php

namespace App\Models;

use App\Models\country\Country;
use App\Models\orders\Order;
use App\Models\products\Wishlist;
use App\Models\review\Review;
use App\Models\Users\Address;
use App\Models\Users\Search;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'password',
        'phone',
        'country_code',
        'newPhone',
        'newCountryCode',
        'country_id',
        'language',
        'device_token',
        'longitude',
        'latitude',
        'is_verified',
        'otp',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getImageAttribute($value)
    {
        $image = asset('AdminAssets/app-assets/images/portrait/small/avatar.png');
        if ($value != '') {
            $image = asset('uploads/users/' . $this->id . '/' . $value);
        }
        return $image;
    }

    public function setPasswordAttribute($password)
    {
        if (!empty($password)) {
            $this->attributes['password'] = Hash::make($password);
        }
    }

    public function getLanguageAttribute($value)
    {
        return $value ?? 'en';
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id');
    }

    public function hasOrders(): bool
    {
        return $this->orders()->where('status', '!=', 'completed')->where('status', '!=', 'cancelled')->count() > 0;
    }

    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id');
    }

    public function getPhoneWithCountryCodeAttribute()
    {
        if(app()->getLocale() == 'ar')
            return $this->country_code . $this->phone . '+';
        else
            return '+' . $this->country_code . $this->phone;
    }

    public function searches()
    {
        return $this->hasMany(Search::class);
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function deliveryOrders(){
       
        return $this->hasMany(Order::class,'delivery_id');
    
}

}

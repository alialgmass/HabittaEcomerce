<?php

namespace App\Models\country;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    protected  $table = "countries";
    protected $fillable = [
        'name_ar' , 'name_en' , 'country_key' , 'country_code' , 'max_number' , 'flag', 'currency'
    ];

    public function getFlagAttribute($value)
    {
        return asset('uploads/countries/' . $this->id . '/' . $value);
    }
    public function users()
    {
        return $this->hasMany(User::class, 'country_id', 'id');
    }

    public function getNameAttribute()
    {
        return ucfirst($this->{'name_' . app()->getLocale()});
    }
    
    public function getMaxNumberAttribute($value)
    {
        return (int) $value;
    }
}

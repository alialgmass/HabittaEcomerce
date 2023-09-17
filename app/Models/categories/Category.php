<?php

namespace App\Models\categories;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ['name_ar', 'name_en', 'image',"ordering", "status"];

    public function getImageAttribute($value)
    {
        $image = asset('AdminAssets/app-assets/images/portrait/small/avatar.png');
        if ($value != '') {
            $image = asset('uploads/categories/' . $this->id . '/' . $value);
        }
        return $image;
    }

    public function getNameAttribute()
    {
        $name = $this->name_ar;
        if (app()->getLocale() == 'en') {
            $name = $this->name_en;
        }
        return $name;
    }
    public function checkStatus()
    {
        if ($this->status == 'active')
        return "<span class='badge badge-light-success'>مفعل</span>";
        else
            return "<span class='badge badge-light-danger'>غير مفعل</span>";
    }
    // status
    public function scopeWhereStatus($query, $status)
    {
        return $query->where('status', $status);
    }

}

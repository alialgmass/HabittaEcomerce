<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;
    protected $table = 'pages';
    protected $fillable = [
        'ordering',
        'title_ar',
        'title_en',
        'content_ar',
        'content_en',
        'type',
    ];

    public function getTitleAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->title_ar;
        }
        return $this->title_en;
    }

    public function getContentAttribute()
    {
        if (app()->getLocale() == 'ar') {
            return $this->content_ar;
        }
        return $this->content_en;
    }
}

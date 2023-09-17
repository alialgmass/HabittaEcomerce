<?php

namespace App\Models\Users;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Search extends Model
{
    use HasFactory;
    protected $table = 'searches';
    protected $fillable = [
        'user_id',
        'keyword',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, $search)
    {
        return $query->where('keyword', 'like', '%' . $search . '%');
    }

    public function scopeUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }


}

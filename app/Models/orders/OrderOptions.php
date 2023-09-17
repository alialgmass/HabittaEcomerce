<?php

namespace App\Models\orders;

use App\Models\orders\Order;
use App\Models\orders\OrderItems;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderOptions extends Model
{
    use HasFactory;
    protected $table = "order_options";
    protected $fillable = [
        'order_id',
        'order_items_id',
        'optionable_id',
        'optionable_type',
        'price',
        'quantity',
        'total',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function orderItem()
    {
        return $this->belongsTo(OrderItems::class);
    }

    public function optionable()
    {
        return $this->morphTo();
    }

}

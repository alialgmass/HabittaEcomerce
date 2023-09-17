<?php

namespace App\Models\orders;

use App\Models\orders\Coupon;
use App\Models\orders\OrderItems;
use App\Models\orders\OrderOptions;
use App\Models\User;
use App\Models\Users\Address;
use App\Models\resturants\Restaurant;
use Carbon\Carbon;
use App\Events\NewOrderAdded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\chats\Room;

class Order extends Model
{
    use HasFactory;
    protected $table = "orders";
    protected $fillable = [
        'order_number',
        'user_id',
        'address_id',
        'status',
        'payment_type',
        'payment_status',
        'transaction_id',
        'subtotal',
        'delivery_fees',
        'discount',
        'coupon_id',
        'discount',
        'total',
        'delivery_id',
        'restaurant_id'
    ];

    public function items()
    {
        return $this->hasMany(OrderItems::class);
    }

    public function getImagesAttribute()
    {
        $images = [];
        foreach ($this->items as $item) {
            $images[] = $item->product->image;
        }
        return $images;
    }

    public function ProductsNames($lang)
    {
        $names = [];
        foreach ($this->items as $item) {
            $names[] = $item->product['name_'.$lang];
        }
        return $names;
    }


    public function options()
    {
        return $this->hasMany(OrderOptions::class);
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // get created_at Attribute with carbon format
    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('M d, Y');
    }

    public function status()
    {
        if ($this->status == 'processing') {
            return "<span class='btn btn-warning btn-sm'>" . trans('common.processing') . "</span>";
        } elseif ($this->status == 'inTheWay') {
            return "<span class='btn btn-primary btn-sm'>" . trans('common.inTheWay') . "</span>";
        } elseif ($this->status == 'completed') {
            return "<span class='btn btn-success btn-sm'>" . trans('common.completed') . "</span>";
        } elseif ($this->status == 'cancelled') {
            return "<span class='btn btn-danger btn-sm'>" . trans('common.cancelled') . "</span>";
        }
    }

    public function discount()
    {
        $discount = 0;
        if ($this->coupon_id != '') {
            $discount = $this->discount;
        }
        return $discount;
    }

    public function totals()
    {
        $total = 0;
        $discount = 0;
        $netTotal = 0;
        $fees = 0;
        $total = $this->items()->sum('total');
        $fees = $this->fees;
        $discount = $this->discount();
        $netTotal = $this->total;
        return [
            'total' => $total,
            'discount' => $discount,
            'fees' => $fees,
            'netTotal' => $netTotal,
        ];
    }
    public function restaurant(){
        return $this->belongsTo(Restaurant::class);
    }
    public function delivery(){
        return $this->belongsTo(User::class, 'delivery_id');
    }
    public function getDateAttribute($value){
        return  Carbon::parse($this->created_at)->format('M d, Y');
          
      }
      public function getTimeAttribute($value){
          return  Carbon::parse($this->created_at)->format('g:i a');
  
      }
      public function getDateTimeAttribute($value){
          return  Carbon::parse($this->created_at)->format('d M').' '.    Carbon::parse($this->created_at)->format('g:i a');
  
      }
      public function room()
      {
          return $this->hasOne(Room::class);
      }
    

}

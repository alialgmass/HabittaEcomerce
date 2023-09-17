<?php

namespace App\Models\orders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'percentage',
        'amount',
        'max_date',
        'max_clients',
        'is_active'
    ];

    public function arabicStatus()
    {
        $message = '';
        $now = date('Y-m-d', strtotime('-1 day', strtotime(now())));
        if ($this->max_date > $now) {
            if ($this->invoices_count <= $this->max_clients || $this->max_clients == 0) {
                $message = '<span class="btn btn-sm btn-success">' . trans('common.CouponIsValid') . '</span>';
                $status = 1;
            } else {
                $message = '<span class="btn btn-sm btn-warning">' . trans('common.TheMaximumNumberOfClientsHasBeenReached') . '</span>';
                $status = 0;
            }
        } else {
            $message = '<span class="btn btn-sm btn-danger">' . trans('common.ItIsNoLongerUsable') . '</span>';
            $status = 0;
        }
        return [
            'message' => $message,
            'status' => $status
        ];
    }

    public function apiStatus()
    {
        $message = '';
        $now = date('Y-m-d', strtotime('-1 day', strtotime(now())));
        if ($this->max_date > $now ) {
            if ($this->invoices_count <= $this->max_clients || $this->max_clients == 0) {
                $message = trans('api.CouponIsValid');
                $status = 1;
            } else {
                $message = trans('api.TheMaximumNumberOfClientsHasBeenReached');
                $status = 0;
            }
        } else {
            $message = trans('api.ItIsNoLongerUsable');
            $status = 0;
        }
        return [
            'message' => $message,
            'status' => $status,
        ];
    }

    public function invoices()
    {
        return $this->hasMany(Order::class, 'coupun_id');
    }

    public function value()
    {
        $value = '';
        if ($this->percentage != '') {
            $value = $this->percentage;
        } else {
            $value = $this->amount;
        }
        return $value;
    }

    public function max_invoices()
    {
        if ($this->max_clients == 0) {
            return 'لا يوجد حد أقصى';
        } else {
            return $this->max_clients . ' ' . trans('common.client');
        }
    }

}

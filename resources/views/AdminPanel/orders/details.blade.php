@extends('AdminPanel.layouts.master')

@section('content')
<section class="invoice-preview-wrapper">
    <div class="row invoice-preview">
        <div class="col-xl-12 col-md-12 col-12">
            <div class="card invoice-preview-card">
                <div class="card-body invoice-padding pb-0">
                    <div class="d-flex justify-content-between flex-md-row flex-column invoice-spacing mt-0 mb-0">
                        <div>
                            <div class="logo-wrapper mb-0">
                                @if(getSettingImageLink('logo') != '')
                                <img src="{{getSettingImageLink('logo')}}" height="80" />
                                @endif
                                <h3 class="text-primary invoice-logo">
                                    {{getSettingValue('siteTitle_'.session()->get('Lang'))}}</h3>
                            </div>
                        </div>
                        <div class="mt-md-0 mb-0 pt-2">
                            <h4 class="invoice-title mb-0">
                                {{trans('common.order')}}
                                <span class="invoice-number">#{{$order->order_number}}</span>
                                <p class="invoice-date">{{date('d/m/Y',$order->date_time_str)}}</p>
                            </h4>
                        </div>
                    </div>
                </div>
                <hr class="invoice-spacing" />
                <!-- Address and Contact starts -->
                <div class="card-body invoice-padding pt-0">
                    <div class="row">
                        <div class="col-xl-12 p-0">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ trans('common.userDetails') }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 mb-2">
                                            <b>{{ trans('common.client') }}:</b>
                                            {{ $order->user->name }}
                                        </div>
                                        <div class="col-4 mb-2">
                                            <b>{{ trans('common.phone') }}:</b>
                                            {{ $order->user->PhoneWithCountryCode }}
                                        </div>
                                        <div class="col-4 mb-2">
                                            <b>{{ trans('common.coupon') }}:</b>
                                            <span class="badge badge-light-primary">
                                                {{ $order->coupon->code ?? '-' }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr class="invoice-spacing" />
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">{{ trans('common.addressDetails') }}</h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-4 mb-2">
                                            <b>{{ trans('common.title') }}:</b>
                                            {{ $order->address->title ?? '-' }}
                                        </div>
                                        <div class="col-4 mb-2">
                                            <b>{{ trans('common.place') }}:</b>
                                            {{ $order->address->address ?? '-' }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Address and Contact ends -->
                <!-- Invoice Description starts -->
                <div class="table-responsive">
                    <table class="table">
                        <thead class="text-center">
                            <tr>
                                <th class="py-1">{{trans('common.products')}}</th>
                                <th class="py-1">{{trans('common.category')}}</th>
                                <th class="py-1">{{trans('common.type')}}</th>
                                <th class="py-1">{{trans('common.price')}}</th>
                                <th class="py-1">{{trans('common.quantity')}}</th>
                                <th class="py-1">{{trans('common.total')}}</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($order->items as $item)
                            @if($item->product != '')
                            <tr>
                                <td class="py-1">
                                    <p class="card-text fw-bold mb-25">{{$item->product->name ?? '-'}}</p>
                                </td>
                                <td class="py-1">
                                    <span class="fw-bold">{{$item->product->category->name}}</span>
                                </td>
                                <td class="py-1">
                                    <span class="fw-bold">{{$item->product->type}}</span>
                                </td>
                                <td class="py-1">
                                    <span class="fw-bold">{{$item->price}}</span>
                                </td>
                                <td class="py-1">
                                    <span class="fw-bold">{{$item->quantity}}</span>
                                </td>
                                <td class="py-1">
                                    <span class="fw-bold">{{$item->price * $item->quantity}}</span>
                                </td>
                            </tr>
                            @endif
                            @empty

                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-body invoice-padding pb-0">
                    <div class="row invoice-sales-total-wrapper">
                        <div class="col-md-6 order-md-1 order-2 mt-md-0 mt-3">
                        </div>
                        <div class="col-md-6 d-flex justify-content-end order-md-2 order-1">
                            <div class="invoice-total-wrapper">
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">{{trans('common.total')}}:</p>
                                    <p class="invoice-total-amount">{{$order->totals()['total']}}</p>
                                </div>
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">{{trans('common.discount')}}:</p>
                                    <p class="invoice-total-amount">{{$order->totals()['discount']}}</p>
                                </div>
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">{{trans('common.fees')}}:</p>
                                    <p class="invoice-total-amount">{{$order->totals()['fees']}}</p>
                                </div>
                                <hr class="my-50" />
                                <div class="invoice-total-item">
                                    <p class="invoice-total-title">{{trans('common.netTotal')}}:</p>
                                    <p class="invoice-total-amount">{{$order->totals()['netTotal']}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Invoice Description ends -->
            </div>
        </div>
        <!-- /Invoice -->
    </div>
</section>
@stop

@section('new_style')
<!-- BEGIN: Page CSS-->
<link rel="stylesheet" type="text/css"
    href="{{asset('AdminAssets/app-assets/css-rtl/core/menu/menu-types/vertical-menu.css')}}">
<link rel="stylesheet" type="text/css"
    href="{{asset('AdminAssets/app-assets/css-rtl/plugins/forms/pickers/form-flat-pickr.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('AdminAssets/app-assets/css-rtl/pages/app-invoice.css')}}">
<!-- END: Page CSS-->
@stop
@section('scripts')
<!-- BEGIN: Page JS-->
<script src="{{asset('AdminAssets/app-assets/js/scripts/pages/app-invoice.js')}}"></script>
<!-- END: Page JS-->
@stop

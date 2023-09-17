@extends('AdminPanel.layouts.master')
@section('content')


<!-- Bordered table start -->
<div class="row" id="table-bordered">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">{{trans('common.userDetails')}}</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-4">
                        <b>{{trans('common.username')}}:</b>

                        {{$review->user_name}}
                    </div>
                    <div class="col-4">
                        <b>{{trans('common.phone')}}:</b>
                        {{$review->user->phone}}
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ trans('common.productDetails') }}
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <b>{{trans('common.product_name')}}:</b>
                        {{$review->product->name}}
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">
                    {{ trans('common.review') }}
                </h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <b>{{trans('common.comment')}}:</b>
                        {{$review->comment}}
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <b>{{trans('common.review')}}:</b>
                        {{$review->rating}}
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>
<!-- Bordered table end -->
@stop

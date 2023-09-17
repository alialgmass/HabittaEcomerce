@extends('AdminPanel.layouts.master')
@section('content')

<!-- Bordered table start -->
<div class="row" id="table-bordered">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">تفاصيل المنتج</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-3">
                        <b>{{ trans('common.name') }}:</b>
                        {{ $product->name }}
                    </div>

                    <div class="col-3">
                        <b>{{ trans('common.price') }}:</b>
                        {{ $product->price }}
                    </div>
                    <div class="col-3">
                        <b>{{ trans('common.quantity') }}:</b>
                        <span dir="rtl">
                            <label class="badge badge-light-success">
                                {{ $product->quantity }}
                            </label>
                        </span>
                    </div>
                    <div class="col-3">
                        <b>{{ trans('common.discount') }}:</b>
                        <span dir="rtl">
                            <label class="badge badge-light-success">
                                {{ $product->discount }}
                            </label>
                        </span>
                    </div>
                    <div class="col-3">
                        <b>{{ trans('common.active') }}:</b>
                        <span dir="ltr">
                            {!! $product->active !!}
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    {{ trans('common.details') }}
                </h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-2">
                        <b> {{ trans('common.type') }} : </b> {{ $product->type }}
                    </div>

                    <div class="col-12 mb-2">
                        <b> {{ trans('common.category') }} : </b> {{ $product->category->name ?? '-' }}
                    </div>
                    <div class="col-12 mb-2">
                        <b> {{ trans('common.description') }} : </b> {!! $product->description ?? '-' !!}
                    </div>
                    <div class="col-12 mb-2">
                        <b> {{ trans('common.calories') }} : </b> {!! $product->calories ?? '-' !!}
                    </div>
                    @isset($product->ingredients[0])
                    <div class="col-12 mb-2">
                        <b> {{ trans('common.ingredients') }} :

                        </b>
                        <br>
                        @foreach ($product->ingredients as $ingredients)
                        {{ trans('common.name') }} : {!! $ingredients->name ?? '-' !!}
                        @endforeach

                    </div>
                    @endisset
                    @isset($product->addons[0])
                    <div class="col-12 mb-2">
                        <b> {{ trans('common.addons') }} :

                        </b>
                        <br>
                        @foreach ($product->addons as $addons)
                        {{ trans('common.name') }} : {!! $addons->name ?? '-' !!}
                        {{ trans('common.price') }} : {!! $addons->pivot->price ?? '-' !!}
                        @endforeach

                    </div>
                    @endisset
                    @isset($product->sizes[0])
                    <div class="col-12 mb-2">
                        <b> {{ trans('common.sizes') }} :

                        </b>
                        <br>
                        @foreach ($product->sizes as $sizes)
                        {{ trans('common.name') }} : {!! $sizes->name ?? '-' !!}
                        {{ trans('common.price') }} : {!! $sizes->pivot->price ?? '-' !!}
                        @endforeach

                    </div>
                    @endisset
                    @isset($product->nutrient[0])
                    <div class="col-12 mb-2">
                        <b> {{ trans('common.nutrient') }} :

                        </b>
                        <br>
                        @foreach ($product->nutrients as $nutrient)
                        {{ trans('common.name') }} : {!! $nutrient->name ?? '-' !!}
                        {{ trans('common.value') }} : {!! $nutrient->pivot->value ?? '-' !!}
                        @endforeach

                    </div>
                    @endisset




                </div>
            </div>
            <div class="card-footer">
                الصورة
                <img src="{{ $product->image }}" class="card-img-bottom" alt="{{ trans('common.nationalIdCard') }}"
                    style="height: 200px; object-fit: contain; width: 100%">
            </div>
        </div>

    </div>
</div>
<!-- Bordered table end -->



@stop

@extends('AdminPanel.layouts.master')
@section('content')
<section id="statistics-card">
    <div class="divider">
        <div class="divider-text">{{trans('common.details')}}</div>
    </div>
    <div class="row justify-content-center">
        <div class=" col-sm-4">
            <div class="card text-center">
                <div class="card-body">
                    <h2 class="fw-bolder">{{$products->count()}}</h2>
                    <p class="card-text">إجمالي المنتجات</p>
                </div>
            </div>
        </div>
        <div class=" col-sm-4">
            <div class="card text-center">
                <div class="card-body">
                    <h2 class="fw-bolder">
                        {{ $products->sum(function ($product) {
                        return (int)$product->price ;
                        })
                        }}
                    </h2>
                    <p class="card-text">إجمالي الأسعار</p>
                </div>
            </div>
        </div>
        <div class=" col-sm-4">
            <div class="card text-center">
                <div class="card-body">
                    <h2 class="fw-bolder">
                        {{ $products->sum(function ($product) {
                        return (int) $product->quantity;
                        })
                        }}
                    </h2>
                    <p class="card-text">إجمالي الكميات</p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Bordered table start -->
<div class="row" id="table-bordered">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}}</h4>
            </div>
            <div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mb-2">
                    <thead class="text-center">
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">{{trans('common.name')}}</th>
                            <th class="text-center">{{trans('common.image')}}</th>
                            <th class="text-center">{{trans('common.quantity')}}</th>
                            <th class="text-center">{{trans('common.price')}}</th>
                            <th class="text-center">{{trans('common.status')}}</th>
                            <th class="text-center">{{trans('common.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($products as $product)
                        <tr id="row_{{$product->id}}">
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{$product->name }}
                            </td>
                            <td>
                                <img src="{{ $product->image }}" alt="image" class="img-fluid img-thumbnail" width="80px">
                            </td>
                            <td class="text-center">
                                <label class="badge badge-light-success">
                                    {{$product->quantity}}
                                </label>
                            </td>
                            <td class="text-center">
                                {{ $product->price }}
                            </td>
                            <td class="text-center">
                                {!! $product->active !!}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('products.show', ['product' => $product]) }}"
                                    class="btn btn-icon btn-primary" data-bs-original-title="{{ trans('common.view') }}"
                                    data-bs-placement="top" data-bs-toggle="tooltip">
                                    <i data-feather='eye'></i>
                                </a>
                                <a href={{ route('products.edit', $product->id) }} class="btn btn-icon btn-info"
                                    data-bs-original-title="{{trans('common.edit')}}" data-bs-placement="top"
                                    data-bs-toggle="tooltip">
                                    <i data-feather='edit'></i>
                                </a>
                                <?php $delete = route('products.destroy',['product'=>$product->id]); ?>
                                <button type="button" class="btn btn-icon btn-danger"
                                    onclick="confirmDelete('{{$delete}}','{{$product->id}}')" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
                                    <i data-feather='trash-2'></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="p-3 text-center ">
                                <h2>{{trans('common.nothingToView')}}</h2>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $products->links('vendor.pagination.default') }}
        </div>
    </div>
</div>
<!-- Bordered table end -->
@stop
@section('page_buttons')
<a href="{{ route('products.create') }}" class="btn btn-primary">
    {{trans('common.CreateNew')}}
</a>
@stop

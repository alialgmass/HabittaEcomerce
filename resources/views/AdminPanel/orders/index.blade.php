@extends('AdminPanel.layouts.master')
@section('content')

<div class="row" id="table-bordered">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }}</h4>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mb-2">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>{{ trans('common.history') }}</th>
                            <th>{{ trans('common.order_number') }}</th>
                            <th>{{ trans('common.client') }}</th>
                            <th>{{ trans('common.status') }}</th>
                            <th>{{ trans('common.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($orders as $order)
                        <tr id="row_{{$order->id}}">
                            <td>{{$loop->iteration}}</td>
                            <td>
                                <span class="badge badge-light-primary">
                                    {{ $order->created_at }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-light-primary">
                                    {{$order->order_number}}
                                </span>
                            </td>
                            <td>
                                <b>
                                {{$order->user->name ?? '-'}}
                                </b> <br>
                                <span class="badge badge-light-primary m-1">
                                    {{ $order->user->PhoneWithCountryCode }}
                                </span>
                            </td>
                            <td>
                                {!! $order->status() !!}
                            </td>
                            <td class="text-center">
                                @if($order->status != 'cancelled')
                                <a href="javascript:;" data-bs-target="#editStatus{{$order->id}}" data-bs-toggle="modal"
                                    class="btn btn-icon btn-info btn-sm" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                    <i data-feather='edit'></i>
                                </a>
                                @endif
                                <a href="{{ route('orders.show', ['order' => $order->id]) }}"
                                    class="btn btn-icon btn-success btn-sm" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="{{ trans('common.from_details') }}">
                                    <i data-feather='list'></i>
                                </a>
                                 <a href="{{ route('orders.show', ['order' => $order->id]) }}"
                                    class="btn btn-icon btn-success btn-sm" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="{{ trans('common.from_details') }}">
                                    <i data-feather='list'></i>
                                </a>
                                <?php /*$delete = route('admin.orders.delete', ['id' => $order->id]); ?>
                                <button type="button" class="btn btn-icon btn-danger"
                                    onclick="confirmDelete('{{ $delete }}','{{ $order->id }}')">
                                    <i data-feather='trash-2'></i>
                                </button>
                                */ ?>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="22" class="p-3 text-center ">
                                <h2>{{ trans('common.nothingToView') }}</h2>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
               <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDduSqAxu0cK7IEGBhYC5OlRpkdJzbvCDo" ></script>
            @foreach($orders as $order)
             
              
                    @include('AdminPanel.orders.edit')
                       @include('AdminPanel.orders.showmap')
              
            @endforeach
            {{ $orders->links('vendor.pagination.default') }}
        </div>
    </div>
</div>
<!-- Bordered table end -->
@stop
@section('page_buttons')
<a href="javascript:;" data-bs-target="#searchOrders" data-bs-toggle="modal" class="btn btn-primary">
    {{trans('common.search')}}
</a>
@include('AdminPanel.orders.search')
@stop

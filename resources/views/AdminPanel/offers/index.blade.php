@extends('AdminPanel.layouts.master')
@section('content')

<!-- Bordered table start -->
<div class="row" id="table-bordered">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{ $title }}</h4>
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
                            <th class="text-center">{{ trans('common.percentage') }}</th>
                            <th class="text-center">{{ trans('common.image') }}</th>
                            <th class="text-center">{{ trans('common.product_name') }}</th>
                            <th class="text-center">{{ trans('common.startDate') }}</th>
                            <th class="text-center">{{ trans('common.endDate') }}</th>
                            <th class="text-center">{{ trans('common.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($offers as $offer)
                        <tr id="row_{{ $offer->id }}">
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $offer->percentage . '%'}}
                            </td>
                            <td>
                                <img src="{{ $offer->image }}" alt="image" class="
                                img-fluid img-thumbnail" width="80px">
                            </td>
                            <td>
                                {{ $offer->product->name }}
                            </td>
                            <td>
                                <span class="badge badge-light-success">
                                    {{ $offer->start_date }}
                                </span>
                            </td>
                            <td>
                                <span class="badge badge-light-warning">
                                    {{ $offer->end_date }}
                                </span>
                            </td>
                            <td>
                                <a href="javascript:;" data-bs-target="#editoffer{{ $offer->id }}"
                                    data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="{{ trans('common.edit') }}">
                                    <i data-feather='edit'></i>
                                </a>
                                <?php $delete = route('offers.destroy', ['offer' => $offer->id]); ?>
                                <button type="button" class="btn btn-icon btn-danger"
                                    onclick="confirmDelete('{{ $delete }}','{{ $offer->id }}')" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="{{ trans('common.delete') }}">
                                    <i data-feather='trash-2'></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="p-3 text-center ">
                                <h2>{{ trans('common.nothingToView') }}</h2>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @foreach ($offers as $offer)
            @include('AdminPanel.offers.edit')
            @endforeach
            {{ $offers->links('vendor.pagination.default') }}

        </div>
    </div>
</div>
<!-- Bordered table end -->

@stop

@section('page_buttons')
<a href="javascript:;" data-bs-target="#createoffer" data-bs-toggle="modal" class="btn btn-primary">
    {{ trans('common.CreateNew') }}
</a>
@include('AdminPanel.offers.create')
@stop
@section('scripts')
<script>
    function checkDate(e) {
        var date = new Date(e.value);
        var yesterday = new Date(new Date().setDate(new Date().getDate() - 1));
        if (date <= yesterday) {
            e.value = '';
            alert('لا يمكن اختيار تاريخ سابق لليوم');
        }
    }
    function checkDiscountPrice(e) {
        if (e.value < 0) {
            e.value = 0;
            alert('لا يمكن اختيار سعر سالب');
        }
    }
    function checkDiscountQuantity(e) {
        if (e.value < 0) {
            e.value = 0;
            alert('لا يمكن اختيار كمية سالبة');
        }
    }
</script>
@stop

@extends('AdminPanel.layouts.master')
@section('content')

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
                           <th>{{trans('common.username')}}</th>
                                <th>{{trans('common.product_name')}}</th>
                                  <th>{{trans('common.review')}}</th>
                                   <th>{{trans('common.comment')}}</th>
                                <th>{{trans('common.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($reviews as $review)
                        <tr id="row_{{$review->id}}">
                            <td>
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                {{ $review->user_name }}
                            </td>
                            <td>
                                {{ $review->product->name }}
                            </td>
                             <td>
                                {{ $review->rating }}
                            </td>
                              <td>
                                {{ $review->comment }}
                            </td>
                            <td class="text-center">
                                <a href="{{ route('reviews.show', ['review'=>$review->id]) }}"
                                    class="btn btn-icon btn-primary" data-bs-original-title="{{ trans('common.view') }}"
                                    data-bs-placement="top" data-bs-toggle="tooltip">
                                    <i data-feather='eye'></i>
                                </a>
                                <?php $delete = route('reviews.destroy',['review'=>$review->id]); ?>
                                <button type="button" class="btn btn-icon btn-danger"
                                    onclick="confirmDelete('{{$delete}}','{{$review->id}}')" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
                                    <i data-feather='trash-2'></i>
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-3 text-center">
                                <h2>{{trans('common.nothingToView')}}</h2>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $reviews->links('vendor.pagination.default') }}
        </div>
    </div>
</div>
<!-- Bordered table end -->
@stop

<div class="modal fade text-md-start" id="editStatus{{$order->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">{{trans('common.edit')}}</h1>
                </div>
                {{Form::open(['url'=>route('orders.update',['order'=>$order->id]), 'id'=>'editorderForm',
                'class'=>'row gy-1 pt-75','files'=>true])}}
                @method('PUT')
                <div class="form-group row mb-2">
                    <label class="col-sm-2 col-form-label" for="status">{{ trans('common.status') }}</label>
                    <div class="col-sm-10">
                        {{Form::select('status',
                        [
                        'processing' => trans('common.processing'),
                        'inTheWay' => trans('common.inTheWay'),
                        'completed' => trans('common.completed'),
                        'cancelled' => trans('common.cancelled'),
                        ],$order->status,['id'=>'status','class'=>'form-control
                        selectpicker','data-live-search'=>'true','required'])}}
                        @if($errors->has('status'))
                        <span class="text-danger" role="alert">
                            <b>{{ $errors->first('status') }}</b>
                        </span>
                        @endif
                    </div>
                </div>
                <div class="col-12 text-center mt-2 pt-50">
                    <button type="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                        {{trans('common.Cancel')}}
                    </button>
                </div>
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>

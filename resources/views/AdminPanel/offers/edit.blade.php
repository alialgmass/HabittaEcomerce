<div class="modal fade text-md-start" id="editoffer{{$offer->id}}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
        <div class="modal-content">
            <div class="modal-header bg-transparent">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body pb-5 px-sm-5 pt-50">
                <div class="text-center mb-2">
                    <h1 class="mb-1">{{trans('common.edit')}}</h1>
                </div>
                {{Form::open(['url'=>route('offers.update',[$offer->id]), 'id'=>'editofferForm',
                'class'=>'row gy-1 pt-75','files'=>true])}}
                @method('PUT')
             
            <div class="col-12 col-md-6">
                    <label class="form-label" for="percentage">{{trans('common.percentage')}}</label>
                    {{Form::number('percentage',$offer->percentage,['id'=>'percentage', 'class'=>'form-control','required'])}}
                </div>
                  <div class="col-12 col-md-6">
                    <label class="form-label" for="product_name">{{ trans('common.product_name') }}</label>
                    {{ Form::select('product_id', $products,$offer->product->name, ['id' => 'product_name', 'class' => 'form-control', 'required']) }}
                </div>
                 <div class="col-12 col-md-6">
                    <label class="form-label" for="start_date">{{trans('common.startDate')}}</label>
                    {{Form::date('start_date',$offer->start_date,['id'=>'start_date', 'class'=>'form-control','required'])}}
                </div>
                 <div class="col-12 col-md-6">
                    <label class="form-label" for="end_date">{{trans('common.endDate')}}</label>
                    {{Form::date('end_date',$offer->end_date,['id'=>'end_date', 'class'=>'form-control','required'])}}
                </div>

                <div class="col-12 col-md-6">
                    <label class="form-label" for="image">{{trans('common.image')}}</label>
                    {{Form::file('image',['id'=>'image', 'class'=>'form-control'])}}
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

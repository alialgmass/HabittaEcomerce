<!-- form -->
<div class="divider">
  <div class="divider-text">{{trans('common.information')}}</div>
</div>
<div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label" for="category_id">{{ trans('common.categories') }}</label>
    <div class="col-sm-10">
        {{Form::select('category_id',
        $categories,'',['id'=>'category_id','class'=>'form-control selectpicker','data-live-search'=>'true',
        'required'])}}
        @if($errors->has('category_id'))
        <span class="text-danger" role="alert">
            <b>{{ $errors->first('category_id') }}</b>
        </span>
        @endif
    </div>
</div>

<div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label" for="price">{{ trans('common.price') }}</label>
    <div class="col-sm-10">
        {{Form::number('price','',['id'=>'price','class'=>'form-control', 'min'=>0, 'required' ])}}
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label" for="discount">{{ trans('common.discount') }}</label>
    <div class="col-sm-10">
        {{Form::number('discount','',['id'=>'discount','class'=>'form-control', 'min'=>0, 'required'])}}
    </div>
</div>
<div class="form-group row mb-2">
    <label class="col-sm-2 col-form-label" for="quantity">{{ trans('common.quantity') }}</label>
    <div class="col-sm-10">
        {{Form::number('quantity','',['id'=>'quantity','class'=>'form-control', 'min'=>0, 'required' ])}}
    </div>
</div>

<div class="form-group row mb-2">
  <label class="col-sm-2 col-form-label" for="active">{{ trans('common.status') }}</label>
  <div class="col-sm-10">
    {{Form::select('active',[
      '1' =>trans('common.active'),
      '0' =>  trans('common.inactive')
    ],'',['id'=>'active','class'=>'form-control', 'required' ])}}
  </div>
</div>
<div class="form-group row mb-2">
  <label class="col-sm-2 col-form-label" for="show_on_it">{{ trans('common.show_on_product') }}</label>
  <div class="col-sm-10">
    {{Form::select('show_on_it',[
      'new' =>trans('common.new'),
      'offer' =>  trans('common.offer')
    ],'',['id'=>'show_on_it','class'=>'form-control', 'required' ])}}
  </div>
</div>
<div class="form-group row mb-2">
  <label class="col-sm-2 col-form-label" for="ordering">{{ trans('common.ordering') }}</label>
  <div class="col-sm-10">
    {{Form::number('ordering',1,['id'=>'ordering','class'=>'form-control', 'min'=>0])}}
  </div>
</div>


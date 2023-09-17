<div class="row">
    <div class="col-12 col-md-6">
        <label class="form-label" for="currency">{{ trans('common.currency') }}</label>
        {{Form::text('currency',getSettingValue('currency'),['id'=>'currency','class'=>'form-control'])}}
    </div>
</div>

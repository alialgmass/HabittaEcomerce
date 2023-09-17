<div class="row">
    <div class="col-12 col-md-6">
        <label class="form-label" for="titleTerms_ar">{{ trans('common.title_ar') }}</label>
        {{Form::text('titleTerms_ar',getSettingValue('titleTerms_ar'),['id'=>'titleTerms_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="titleTerms_en">{{ trans('common.title_en') }}</label>
        {{Form::text('titleTerms_en',getSettingValue('titleTerms_en'),['id'=>'titleTerms_en','class'=>'form-control'])}}
    </div>
    <div class="col-12">
        <label class="form-label" for="terms_ar">{{ trans('common.terms_ar') }}</label>
        {{Form::textarea('terms_ar',getSettingValue('terms_ar'),['rows'=>'3','id'=>'terms_ar','class'=>'form-control'])}}
    </div>
    <div class="col-12">
        <label class="form-label" for="terms_en">{{ trans('common.terms_en') }}</label>
        {{Form::textarea('terms_en',getSettingValue('terms_en'),['rows'=>'3','id'=>'terms_en','class'=>'form-control'])}}
    </div>

</div>

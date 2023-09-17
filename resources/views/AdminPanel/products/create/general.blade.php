<!-- form -->
<div class="row">
    <div class="divider">
        <div class="divider-text">{{ trans('common.products') }}</div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label" for="name_ar">{{ trans('common.name_ar') }}</label>
        <div class="col-sm-10">
            {{ Form::text('name_ar', '', ['id' => 'name_ar', 'class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label" for="name_en">{{ trans('common.name_en') }}</label>
        <div class="col-sm-10">
            {{ Form::text('name_en', '', ['id' => 'name_en', 'class' => 'form-control', 'required']) }}
        </div>
    </div>
   
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label" for="description_ar">{{ trans('common.description_ar') }}</label>
        <div class="col-sm-10">
            {{ Form::textarea('description_ar', '', ['rows' => '4', 'id' => 'description_ar', 'class' => 'form-control']) }}
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label" for="description_en">{{ trans('common.description_en') }}</label>
        <div class="col-sm-10">
            {{ Form::textarea('description_en', '', ['rows' => '4', 'id' => 'description_en', 'class' => 'form-control']) }}
        </div>
    </div>
      <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label" for="full_description_ar">{{ trans('common.full_description_ar') }}</label>
        <div class="col-sm-10">
            {{ Form::textarea('full_description_ar', '', ['rows' => '4', 'id' => 'full_description_ar', 'class' => 'form-control']) }}
        </div>
    </div>
    <div class="form-group row mb-2">
        <label class="col-sm-2 col-form-label" for="full_description_en">{{ trans('common.full_description_en') }}</label>
        <div class="col-sm-10">
            {{ Form::textarea('full_description_en', '', ['rows' => '4', 'id' => 'full_description_en', 'class' => 'form-control']) }}
        </div>
    </div>
</div>
<!--/ form -->

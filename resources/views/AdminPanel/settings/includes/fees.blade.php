<div class="row">
    <div class="col-12 col-md-6">
        <label class="form-label" for="deliverFees">{{ trans('common.feesTransfer') }}</label>
        {{Form::number('deliverFees',getSettingValue('deliverFees'),['id'=>'deliverFees','class'=>'form-control',
        'min'=>0,
        'onchange'=>'this.value = parseFloat(this.value).toFixed(2);',
        'onkeyup' => 'checkDecimal(this)',
        'onkeypress' => 'checkDecimal(this)',
        'onblur' => 'checkDecimal(this)',
        'onkeydown' => 'checkDecimal(this)',
       ])}}
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="vat">{{ trans('common.vat') }}</label>
        {{Form::number('vat',getSettingValue('vat'),['id'=>'vat','class'=>'form-control',
        'min'=>0,
        'max' => 100,
        'onchange'=>'this.value = parseFloat(this.value).toFixed(2);',
        'onkeyup' => 'checkDecimal(this)',
        'onkeypress' => 'checkDecimal(this)',
        'onblur' => 'checkDecimal(this)',
        'onkeydown' => 'checkDecimal(this)',
       ])}}
    </div>
</div>

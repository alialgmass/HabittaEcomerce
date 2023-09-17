<!-- form -->
<div class="row">
    <div class="col-md-5 text-center">
        <h3 class="">{{ trans('common.logo') }}</h3>
        {!! getSettingImageValue('logo') !!}
        <div class="file-loading">
            <input class="files" name="logo" type="file">
        </div>
    </div>
    <div class="col-md-5 text-center">
        <h3>{{ trans('common.cover') }}</h3>
        {!! getSettingImageValue('cover') !!}
        <div class="file-loading">
            <input class="files" name="cover" type="file">
        </div>
    </div>
</div>
<!--/ form -->

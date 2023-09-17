<!-- form -->
<div class="row">
    <div class="col-md-3 text-center">
      <h3>{{ trans('common.image') }} </h3>
      {!! getProductImageValue($product->image) !!}
        <div class="file-loading">
            <input class="files" name="image" type="file" value="{{$product->image}}">
        </div>
    </div>
</div>
<div class="row pt-2">
    <div class="divider col-11 col-sm-11">
        <div class="divider-text">{{trans('common.additionalImages')}}</div>
    </div>
    <div class="col-1 col-sm-1">
        <div class="btn btn-primary mt-1 me-1 btn-create-images"> <i data-feather="plus"></i></div>
    </div>
</div>
<div class="row pt-1 images-section">
    @if($product->productImages->count() > 0)
    <div class="options-list-place">
        <div class="row  options-list">
            @foreach ($product->productImages as $image)
            {!! AddittionalProductImage($image->additionalImages) !!}
            @endforeach
        </div>
    </div>
    @endif
</div>
<!--/ form -->


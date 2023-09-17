@extends('AdminPanel.layouts.master')
@section('content')

<!-- Bordered table start -->
<div class="row" id="table-bordered">
  <div class="col-12">
    {{Form::open(['url'=>route('products.store'), 'files'=>'true'])}}
    @method('POST')
    <div class="card">
      <div class="card-body">
        <ul class="nav nav-tabs" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general" aria-controls="home"
              role="tab" aria-selected="true">
              <i data-feather="home"></i> {{trans('common.general')}}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="information-tab" data-bs-toggle="tab" href="#information" aria-controls="information" role="tab"
              aria-selected="false">
              <i data-feather="file-text"></i> {{trans('common.information')}}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="feature-tab" data-bs-toggle="tab" href="#feature" aria-controls="feature" role="tab"
              aria-selected="false">
              <i data-feather="file-text"></i> {{trans('common.feature')}}
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="images-tab" data-bs-toggle="tab" href="#images" aria-controls="images" role="tab"
              aria-selected="false">
              <i data-feather="image"></i> {{trans('common.images')}}
            </a>
          </li>
        </ul>
        <div class="tab-content">
          @if ($errors->any())
          <div class="alert alert-danger">
            <ul>
              @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
          @endif
          <div class="tab-pane active" id="general" aria-labelledby="general-tab" role="tabpanel">
            @include('AdminPanel.products.create.general')
          </div>
          <div class="tab-pane" id="information" aria-labelledby="information-tab" role="tabpanel">
            @include('AdminPanel.products.create.information')
          </div>
             <div class="tab-pane" id="feature" aria-labelledby="feature-tab" role="tabpanel">
            @include('AdminPanel.products.create.feature')
          </div>
         
          <div class="tab-pane" id="images" aria-labelledby="images-tab" role="tabpanel">
            @include('AdminPanel.products.create.images')
          </div>
        </div>
      </div>
      <div class="card-footer">
        <input type="submit" value="{{trans('common.Save changes')}}" class="btn btn-primary">
      </div>
    </div>
    {{Form::close()}}
  </div>
</div>
<!-- Bordered table end -->
@stop
@section("scripts")
@include("AdminPanel.products.create.script")
<script>
    function checkDiscountDate(e) {
        var date = new Date(e.value);
        var today = new Date();
        if (date < today) {
            e.value = '';
            alert('لا يمكن اختيار تاريخ سابق لليوم');
        }
    }
    function checkDiscountPrice(e) {
        if (e.value < 0) {
            e.value = 0;
            alert('لا يمكن اختيار سعر سالب');
        }
    }
    function checkDiscountQuantity(e) {
        if (e.value < 0) {
            e.value = 0;
            alert('لا يمكن اختيار كمية سالبة');
        }
    }
</script>
@stop

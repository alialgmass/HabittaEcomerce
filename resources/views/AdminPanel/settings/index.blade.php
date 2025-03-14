@extends('AdminPanel.layouts.master')
@section('content')
<!-- Bordered table start -->
<div class="row" id="table-bordered">
    <div class="col-12">
        {{Form::open(['url'=>route('settings.update'), 'files'=>'true'])}}
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="general-tab" data-bs-toggle="tab" href="#general"
                            aria-controls="home" role="tab" aria-selected="true">
                            <i data-feather="home"></i> {{trans('common.generalSettings')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="fees-tab" data-bs-toggle="tab" href="#fees"
                            aria-controls="fees" role="tab" aria-selected="false">
                            <i data-feather="dollar-sign"></i>{{ trans('common.fees') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="currency-tab" data-bs-toggle="tab" href="#currency"
                            aria-controls="currency" role="tab" aria-selected="false">
                            <i data-feather="dollar-sign"></i>{{ trans('common.currency') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="terms-tab" data-bs-toggle="tab" href="#terms" aria-controls="terms"
                            role="tab" aria-selected="false">
                            <i data-feather="package"></i>{{ trans('common.terms') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="features-tab" data-bs-toggle="tab" href="#features"
                            aria-controls="features" role="tab" aria-selected="false">
                            <i data-feather="heart"></i>{{ trans('common.features') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="social-tab" data-bs-toggle="tab" href="#social" aria-controls="social"
                            role="tab" aria-selected="false">
                            <i data-feather="tool"></i> {{trans('common.socialSettings')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="images-tab" data-bs-toggle="tab" href="#images" aria-controls="images"
                            role="tab" aria-selected="false">
                            <i data-feather="image"></i> {{trans('common.imagesSettings')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact"
                            aria-controls="contact" role="tab" aria-selected="false">
                            <i data-feather="mail"></i> {{trans('common.contactSettings')}}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="aboutus-tab" data-bs-toggle="tab" href="#aboutus"
                            aria-controls="aboutus" role="tab" aria-selected="false">
                            <i data-feather="users"></i> {{ trans('common.aboutUs') }}
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="general" aria-labelledby="general-tab" role="tabpanel">
                        @include('AdminPanel.settings.includes.general')
                    </div>
                    <div class="tab-pane" id="fees" aria-labelledby="fees-tab" role="tabpanel">
                        @include('AdminPanel.settings.includes.fees')
                    </div>
                    <div class="tab-pane" id="currency" aria-labelledby="currency-tab" role="tabpanel">
                        @include('AdminPanel.settings.includes.currency')
                    </div>
                    <div class="tab-pane" id="terms" aria-labelledby="terms-tab" role="tabpanel">
                        @include('AdminPanel.settings.includes.terms')
                    </div>
                    <div class="tab-pane" id="features" aria-labelledby="features-tab" role="tabpanel">
                        @include('AdminPanel.settings.includes.features')
                    </div>
                    <div class="tab-pane" id="social" aria-labelledby="social-tab" role="tabpanel">
                        @include('AdminPanel.settings.includes.social')
                    </div>
                    <div class="tab-pane" id="images" aria-labelledby="images-tab" role="tabpanel">
                        @include('AdminPanel.settings.includes.images')
                    </div>
                    <div class="tab-pane" id="contact" aria-labelledby="contact-tab" role="tabpanel">
                        @include('AdminPanel.settings.includes.contact')
                    </div>
                    <div class="tab-pane" id="aboutus" aria-labelledby="aboutus-tab" role="tabpanel">
                        @include('AdminPanel.settings.includes.aboutus')
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

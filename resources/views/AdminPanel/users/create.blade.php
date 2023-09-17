@extends('AdminPanel.layouts.master')

@section('content')
<div class="row">
    <div class="col-12">
        <!-- profile -->
        <div class="card">
            <div class="card-body py-2 my-25">
                {{Form::open(['files'=>'true','class'=>'validate-form','url'=>route('users.store')])}}
                <div class="row d-flex justify-content-center">
                    <div class="col-md-3 text-center">
                        <div class="file-loading">
                            <input class="files" name="photo" type="file">
                        </div>
                    </div>
                </div>
                <!-- form -->
                <div class="row pt-3">
                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label" for="name">{{trans('common.name')}}
                            <span class="text-danger">*</span>
                        </label>
                        {{Form::text('name','',['id'=>'name','class'=>'form-control','required'])}}
                        @if($errors->has('name'))
                        <span class="text-danger" role="alert">
                            <b>{{ $errors->first('name') }}</b>
                        </span>
                        @endif
                    </div>
                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label" for="email">{{trans('common.email')}}
                            <span class="text-danger">*</span>
                        </label>
                        {{Form::email('email','',['id'=>'email','class'=>'form-control','required'])}}
                        @if($errors->has('email'))
                        <span class="text-danger" role="alert">
                            <b>{{ $errors->first('email') }}</b>
                        </span>
                        @endif
                    </div>
                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label" for="password">{{trans('common.password')}}
                            <span class="text-danger">*</span>
                        </label>
                        {{Form::password('password',
                        ['id'=>'password','class'=>'form-control','autoComplete'=>'new-password','required'])}}
                        @if($errors->has('password'))
                        <span class="text-danger" role="alert">
                            <b>{{ $errors->first('password') }}</b>
                        </span>
                        @endif
                    </div>
                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label" for="phone">{{trans('common.phone')}}</label>
                        {{Form::text('phone','',['id'=>'phone','class'=>'form-control'])}}
                        @if($errors->has('phone'))
                        <span class="text-danger" role="alert">
                            <b>{{ $errors->first('phone') }}</b>
                        </span>
                        @endif
                    </div>
                    <div class="col-12 col-sm-4 mb-1">
                        <label class="form-label" for="role_id">{{trans('common.role')}}</label>
                        {{Form::select('role_id',
                        $roles
                        ,'',['id'=>'role_id','class'=>'form-control
                        selectpicker','data-live-search'=>'true', 'required'])}}
                        @if($errors->has('role_id'))
                        <span class="text-danger" role="alert">
                            <b>{{ $errors->first('role_id') }}</b>
                        </span>
                        @endif
                    </div>
                    <div class="col-12 col-sm-4 mb-1">
                        <label for="language" class="form-label">{{trans('common.language')}}</label>
                        {{Form::select('language',[
                        'ar' => trans('common.lang1Name'),
                        'en' => trans('common.lang2Name')
                        ],'',['id'=>'language','class'=>'form-control selectpicker'])}}
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary mt-1 me-1">{{trans('common.Save
                            changes')}}</button>
                    </div>
                </div>
                <!--/ form -->
                {{Form::close()}}
            </div>
        </div>
    </div>
</div>
@stop

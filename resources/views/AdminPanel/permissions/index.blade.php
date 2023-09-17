@extends('AdminPanel.layouts.master')
@section('content')
    <!-- Bordered table start -->
    <div class="row" id="table-bordered">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{$title}}</h4>
                </div>
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="table-responsive">
                    <table class="table table-bordered mb-2">
                        <thead class="text-center">
                            <tr>
                                <th >#</th>
                                <th>{{trans('common.name')}}</th>
                                <th>{{trans('common.actions')}}</th>
                            </tr>
                        </thead>
                        <tbody class="text-center">
                            @forelse($permissions as $permission)
                            <tr id="row_{{$permission->id}}">
                                <td>
                                    {{$loop->iteration}}
                                </td>
                                <td>
                                    {{$permission['name_ar']}}<br>
                                    {{$permission['name_en']}}
                                </td>
                                <td>
                                    <a href="javascript:;" data-bs-target="#editpermission{{$permission->id}}" data-bs-toggle="modal" class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-original-title="{{trans('common.edit')}}">
                                        <i data-feather='edit'></i>
                                    </a>
                                    <?php $delete = route('permissions.delete',['permission'=>$permission->id]); ?>
                                    <button type="button" class="btn btn-icon btn-danger" onclick="confirmDelete('{{$delete}}','{{$permission->id}}')">
                                        <i data-feather='trash-2'></i>
                                    </button>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-3 text-center ">
                                        <h2>{{trans('common.nothingToView')}}</h2>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                {{ $permissions->links('vendor.pagination.default') }}
            </div>
        </div>
    </div>

@foreach($permissions as $permission)
    <div class="modal fade text-md-start" id="editpermission{{$permission->id}}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.edit')}}: {{$permission['name_'.session()->get('Lang')]}}</h1>
                    </div>
                    {{Form::open(['url'=>route('permissions.update',['permission'=>$permission->id]), 'id'=>'editpermissionForm'.$permission->id, 'class'=>'row gy-1 pt-75'])}}
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                            {{Form::text('name_ar',$permission->name_ar,['id'=>'name_ar', 'class'=>'form-control', 'required'])}}
                        </div>
                        @error('name_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                            {{Form::text('name_en',$permission->name_en,['id'=>'name_en', 'class'=>'form-control', 'required'])}}
                            @error('name_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 text-center mt-2 pt-50">
                            <button type="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                {{trans('common.Cancel')}}
                            </button>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@endforeach

@stop
 @section('page_buttons')
    <a href="javascript:;" data-bs-target="#createpermission" data-bs-toggle="modal" class="btn btn-primary">
        {{trans('common.CreateNew')}}
    </a>

    <div class="modal fade text-md-start" id="createpermission" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-edit-user">
            <div class="modal-content">
                <div class="modal-header bg-transparent">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body pb-5 px-sm-5 pt-50">
                    <div class="text-center mb-2">
                        <h1 class="mb-1">{{trans('common.CreateNew')}}</h1>
                    </div>
                    {{Form::open(['url'=>route('permissions.store'), 'id'=>'createpermissionForm', 'class'=>'row gy-1 pt-75'])}}
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="name_ar">{{trans('common.name_ar')}}</label>
                            {{Form::text('name_ar','',['id'=>'name_ar', 'class'=>'form-control', 'required'])}}
                            @error('name_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label" for="name_en">{{trans('common.name_en')}}</label>
                            {{Form::text('name_en','',['id'=>'name_en', 'class'=>'form-control', 'required'])}}
                            @error('name_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- <div class="row">
                            <div class="col-12">
                                <h4 class="mt-2 pt-50">{{trans('common.permission Permissions')}}</h4>
                                <!-- Permission table -->
                                <div class="table-responsive">
                                    <table class="table table-flush-spacing">
                                        <tbody>
                                            <tr>
                                                <td class="text-nowrap fw-bolder">
                                                    {{trans('common.Select All')}}
                                                    <span data-bs-toggle="tooltip" data-bs-placement="top" title="{{trans('common.Allows a full access to the system')}}">
                                                        <i data-feather="info"></i>
                                                    </span>
                                                </td>
                                                <td>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="selectAll" />
                                                        <label class="form-check-label" for="selectAll"> {{trans('common.Select All')}} </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            @foreach(getPermissions() as $permissionGroup)
                                                <tr>
                                                    <td class="text-nowrap fw-bolder">{{$permissionGroup['name'] ?? ''}}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            @foreach($permissionGroup['permissions'] as $permission)
                                                                <div class="form-check me-3 me-lg-1">
                                                                    <input class="form-check-input" type="checkbox" id="permission{{$permission['id']}}" name="permissions[]" value="{{$permission['id']}}" />
                                                                    <label class="form-check-label" for="permission{{$permission['id']}}"> {{$permission['name']}} </label>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- Permission table -->
                            </div>
                        </div> --}}

                        <div class="col-12 text-center mt-2 pt-50">
                            <button type="submit" class="btn btn-primary me-1">{{trans('common.Save changes')}}</button>
                            <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal" aria-label="Close">
                                {{trans('common.Cancel')}}
                            </button>
                        </div>
                    {{Form::close()}}
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
<script src="{{asset('AdminAssets/app-assets/js/scripts/pages/modal-add-permission.js')}}"></script>
@stop

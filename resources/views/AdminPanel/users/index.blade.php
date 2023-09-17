@extends('AdminPanel.layouts.master')
@section('content')
<!-- Bordered table start -->
<div class="row" id="table-bordered">
    <div class="col-12">
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}}</h4>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered mb-2">
                    <thead class="text-center">
                        <tr>
                            <th>#</th>
                            <th>{{trans('common.name')}}</th>
                            <th>{{trans('common.email')}}</th>
                            <th>{{trans('common.phone')}}</th>
                            <th>{{trans('common.role')}}</th>
                            <th class="text-center">{{trans('common.actions')}}</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
                        @forelse($users as $user)
                        <tr id="row_{{$user->id}}">
                            <td>
                                {{$loop->iteration}}
                            </td>
                            <td>
                                {{ $user->name }}
                            </td>
                            <td>{{$user->email}}</td>
                            <td>
                                {{$user->phone}}
                            </td>
                            <td>
                                {{$user->role->name ?? '-'}}
                            </td>
                            <td class="text-center">
                                @if(!$user->hasRole('admin'))
                                @if($user->block == '0')
                                <a href="#"
                                    class="btn btn-icon btn-warning" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-original-title="{{trans('common.block')}}">
                                    <i data-feather='shield-off'></i>
                                </a>
                                @else
                                <a href="#"
                                    class="btn btn-icon btn-success" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-original-title="{{trans('common.unblock')}}">
                                    <i data-feather='shield'></i>
                                </a>
                                @endif
                                <a href="{{route('users.edit',['user'=>$user->id])}}"
                                    class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-original-title="{{trans('common.edit')}}">
                                    <i data-feather='edit'></i>
                                </a>
                                <?php $delete = route('users.destroy',['user'=>$user->id]); ?>
                                <button type="button" class="btn btn-icon btn-danger"
                                    onclick="confirmDelete('{{$delete}}','{{$user->id}}')" data-bs-toggle="tooltip"
                                    data-bs-placement="top" data-bs-original-title="{{trans('common.delete')}}">
                                    <i data-feather='trash-2'></i>
                                </button>
                                @else
                                @if(auth()->user()->id == 1)
                                <a href="{{route('admin.adminUsers.edit',['user'=>$user->id])}}"
                                    class="btn btn-icon btn-info" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-original-title="{{trans('common.edit')}}">
                                    <i data-feather='edit'></i>
                                </a>
                                @endif
                                @endif
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

            {{ $users->links('vendor.pagination.default') }}


        </div>
    </div>
</div>
<!-- Bordered table end -->



@stop
@section('page_buttons')
<a href="{{route('users.create')}}" class="btn btn-primary">
    {{trans('common.CreateNew')}}
</a>
@stop

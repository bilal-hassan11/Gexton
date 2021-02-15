@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Staff Users</li>
                </ol>
            </div>
            <h4 class="page-title">All Staff Users</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="header-title">All Staff Users</h4>
                <a href="{{ route('staff.add') }}" class="btn btn-sm btn-primary">Add Staff User</a>
            </div>
            <p class="sub-header">Following is the list of all the staff users.</p>
            <table class="table dt_table table-bordered w-100 nowrap" id="laravel_datatable">
                <thead>
                    <tr>
                        <th width="20">S.No</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Company</th>
                        <th>Type</th>
                        <th>Permissions</th>
                        <th>Added On</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $k => $user)
                    <tr>
                        <td>
                            <p class="m-0 text-center">{{ $k + 1 }}</p>
                        </td>
                        <td>{{ $user->complete_name }}</td>
                        <td><small>{{ $user->username }}</small></td>
                        <td><small>{{ $user->company->company_name }}</small></td>
                        <td>
                            <small class="badge badge-{{user_types($user->user_type)['class']}}">{{ ucwords($user->user_type) }}</small>
                        </td>
                        <td class="text-center">
                            @if($user->user_type != 'admin')
                                @foreach ($user->user_permissions as $permission)
                                    <p class="m-0"><small class="badge text-dark bg-soft-dark">{{ ucwords(str_replace('-',' ',$permission->name)) }}</small></p>
                                @endforeach
                            @else
                                <p class="m-0"><small class="badge text-danger bg-soft-danger">All Permissions</small></p>
                            @endif
                        </td>
                        <td>
                            <p class="m-0"><small>{{ get_date($user->created_on) }}</small></p>
                        </td>
                        
                        <td class="text-center">
                            <p class="mb-1">
                                <small>Current Status:</small> <span class="badge text-{{$user->is_active ? 'success' : 'danger'}} bg-soft-{{$user->is_active ? 'success' : 'danger'}}">{{$user->is_active ? 'Active' : 'Disabled'}}</span>
                            </p>
                            <p class="m-0">
                                <button type="button" class="btn btn-xs btn-{{ $user->is_active ? 'danger' : 'success'}}" onclick="ajaxRequest(this)" data-url="{{ route('staff.update_status', $user->hashid) }}">{{ $user->is_active ? 'Disable' : 'Activate'}} User</button>
                            </p>
                        </td>
                        <td>
                            <a href="{{route('staff.edit', $user->hashid)}}" class="btn btn-warning btn-xs waves-effect waves-light">
                                <i class="fa fa-edit"></i>
                            </a>
                            <button type="button" onclick="ajaxRequest(this)" data-url="{{ route('staff.delete', $user->hashid) }}"  class="btn btn-danger btn-xs waves-effect waves-light">
                                <i class="fa fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
@include('admin.partials.datatable')
@endsection
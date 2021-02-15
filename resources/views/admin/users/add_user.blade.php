@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('staff') }}">Staff Users</a></li>
                    <li class="breadcrumb-item active">{{ isset($user) ? 'Edit' : 'Add'}} Staff User</li>
                </ol>
            </div>
            <h4 class="page-title">{{ isset($user) ? 'Edit' : 'Add'}} Staff User</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <h4 class="header-title m-t-0">{{ isset($user) ? 'Edit' : 'Add'}} Staff User</h4>
            <p class="text-muted font-14 m-b-20">
                Here you can {{ isset($user) ? 'edit' : 'add'}} staff user.
            </p>

            <form action="{{ route('staff.save') }}" class="ajaxForm" method="post" enctype="multipart/form-data" novalidate>
                @csrf
                @if(isset($user) && $user->image)
                    <div class="form-group my-3">
                        <img src="{{check_file($user->image, 'user')}}" alt="{{ $user->full_name ?? 'No Image' }}" class="img-fluid fit-image avatar-xl rounded-circle">
                    </div>
                @endif
                <div class="form-group mb-3">
                    <label>Profile Image</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" name="profile_img" id="profile_img" accept=".gif, .jpg, .png">
                            <label class="custom-file-label profile_img_label" for="profile_img">Choose file</label>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label for="company_id">Company<span class="text-danger">*</span></label>
                    <select class="form-control" data-parsley-required name="company_id" id="company_id">
                        <option value="">Select Company</option>
                        @foreach ($companies as $company)
                            <option {{isset($user) && $user->company_id == $company->id ? 'selected' : ''}} value="{{$company->id}}">{{$company->company_name}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label for="first_name">First Name<span class="text-danger">*</span></label>
                    <input type="text" name="first_name" parsley-trigger="change" data-parsley-required placeholder="Enter first name" class="form-control" id="first_name" value="{{ $user->first_name ?? '' }}">
                </div>

                <div class="form-group mb-3">
                    <label for="last_name">Last Name<span class="text-danger">*</span></label>
                    <input type="text" name="last_name" parsley-trigger="change" data-parsley-required placeholder="Enter last name" class="form-control" id="last_name" value="{{ $user->last_name ?? '' }}">
                </div>

                <div class="form-group mb-3">
                    <label for="username">username<span class="text-danger">*</span></label>
                    <input type="text" @if (!isset($user)) name="username" parsley-trigger="change" data-parsley-required @else disabled @endif placeholder="Enter username" class="form-control" id="username" value="{{ $user->username ?? '' }}">
                </div>

                <div class="form-group mb-3">
                    <label for="email">Email<span class="text-danger">*</span></label>
                    <input type="email" name="email" placeholder="Enter email" class="form-control" id="email" value="{{ $user->email ?? '' }}">
                </div>

                <div class="form-group mb-3">
                    <label for="user_type">User Type<span class="text-danger">*</span></label>
                    <select class="form-control" onchange="changed_user_type(this.value)" data-parsley-required name="user_type" id="user_type">
                        <option value="">Select User Type</option>
                        <option {{isset($user) && $user->user_type == 'admin' ? 'selected' : ''}} value="admin">Admin</option>
                        <option {{isset($user) && $user->user_type == 'normal' ? 'selected' : ''}} value="normal">Normal</option>
                    </select>
                </div>

                <div class="form-group mb-3" id="permissions_wrap" style="display: {{ isset($user) && $user->user_type == 'normal' ? 'block' : 'none'}}">
                    <label for="permissions">User Permissions</label>
                    <select class="form-control select2" multiple name="permissions[]" id="permissions">
                        @foreach ($permissions as $permission)
                            <option {{isset($user) && in_array($permission->slug, $user_permissions) ? 'selected' : ''}} value="{{$permission->name}}">{{$permission->name}}</option>
                        @endforeach
                    </select>
                </div>

                @if(!isset($user))
                <div class="form-group mb-3">
                    <label for="password">Password<span class="text-danger">*</span></label>
                    <input type="password" name="password" parsley-trigger="change" data-parsley-required placeholder="Enter password atleast 8 charactes long" class="form-control" id="password" value="{{ $user->last_name ?? '' }}">
                </div>
                @else
                <input type="hidden" value="{{ $user->hashid }}" name="user_id" />
                @endif

                <div class="form-group mb-3 text-right">
                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                        Submit
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@if(isset($user))
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <h4 class="header-title m-t-0 mb-3">Update Password For Staff</h4>

            <form action="{{ route('staff.update_password') }}" class="ajaxForm" method="post">
                @csrf
                <div class="form-group mb-3">
                    <label for="new_password">Password<span class="text-danger">*</span></label>
                    <input type="password" name="password" parsley-trigger="change" data-parsley-minlength="8" data-parsley-required placeholder="Enter password atleast 8 charactes long" class="form-control" id="new_password">
                </div>
                <div class="form-group mb-3">
                    <label for="password_confirmation">Confirm Password<span class="text-danger">*</span></label>
                    <input type="password" name="password_confirmation" data-parsley-minlength="8" parsley-trigger="change" data-parsley-equalto="#new_password" data-parsley-required placeholder="Enter confirm password atleast 8 charactes long" class="form-control" id="password_confirmation">
                </div>
                <div class="form-group mb-3 text-right">
                    <input type="hidden" value="{{ $user->hashid }}" name="user_id" />
                    <button class="btn btn-primary waves-effect waves-light" type="submit">
                        Submit
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endif
@endsection

@section('page-scripts')
<script>
    $('#profile_img').change(function() {
        var filename = $('#profile_img').val();
        if (filename.substring(3,11) == 'fakepath') {
            filename = filename.substring(12);
        }
        if(filename && filename != ''){
            $('.profile_img_label').html(filename);
        }else{
            $('.profile_img_label').html('Choose file');
        }
   });

   $(document).ready(function () {
        if ($('.select2').length > 0) {
            $('.select2').select2({
                placeholder: 'Select User Permissions',
                tags: true,
            })
        }
    });

    function changed_user_type(type){
        if(type != 'admin'){
            $("#permissions_wrap").show();
            $("#permissions").attr('required', 'required');
        }else{
            $("#permissions").removeAttr('required');
            $("#permissions_wrap").hide();
        }

        $('.select2').select2({
            placeholder: 'Select User Permissions',
            tags: true,
        })
    }
</script>
@endsection
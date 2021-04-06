@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Add Users</li>
                </ol>
            </div>
            <h4 class="page-title">Add User</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="d-flex align-items-center justify-content-between">
            </div>
            <form action="{{ route('user.save') }}" method="get" class="ajaxForm">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control"  placeholder="Enter First Name" name="first_name" value="{{ @$update_user->first_name }}" required>                    
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Last name</label>
                            <input type="text" class="form-control" placeholder="Last Name" name="last_name" value="{{ @$update_user->last_name }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control"  placeholder="Enter Username" name="username" value="{{ @$update_user->username }}" required>                     
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" placeholder="Enter Email Address" name="email" value="{{ @$update_user->email }}" required>
                            {{-- @error('email')
                            <p class="text-danger">{{ $message }}</p>
                            @enderror --}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Address</label>
                            <input type="text" class="form-control"  placeholder="Enter Address" name="address" value="{{ @$update_user->address }}" required>                    
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>NIC</label>
                            <input type="text" class="form-control" placeholder="Enter NIC Number" name="nic" value="{{ @$update_user->nic ?? old('nic') }}" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Contact Number</label>
                            <input type="text" class="form-control"  placeholder="Enter Contact Number" name="contact_number" value="{{ @$update_user->contact_number }}" required>                    
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Enable/Disable ACl</label>
                            <select class="form-control" name="acl" required>
                                <option value="">Enable/Disable ACl</option>
                                <option value="1"  @if(isset($update_user) && $update_user->acl == true) selected @endif>Enable</option>
                                <option value="0"  @if(isset($update_user) && $update_user->acl == false) selected @endif>Disable</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <input type="hidden" name="user_id" value="{{ @$update_user->hashid }}">

                <input type="submit" class="btn btn-primary" value="{{ (isset($update))?'Update':'Add'  }}">
                </form>
    
        </div>
    </div>
</div>

@endsection

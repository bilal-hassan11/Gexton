@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ol>
            </div>
            <h4 class="page-title">All Users</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class=" float-right">
                <a href="{{ route('user.add') }}" class="btn btn-primary">Add User</a>    
            </div> 
            <div class="d-flex align-items-center justify-content-between">
            </div>
            <div class="mb-5">
                <form action="{{ route('users.search') }}" method="GET">
                    <div class="row">
                        <div class="col-sm-6">
                            <input type="text" class="form-control" name="search">
                        </div> 
                        <div class="col-sm-2">
                            <input type="submit" class="btn btn-primary" value="search">    
                        </div>  
                    </div> 
                </form>
            </div>
            
            
            <table class="table  table-bordered w-100 nowrap" id="">
                <thead>
                    <tr>
                        <th width="20">S.No</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Contact</th>
                        <th>ACL</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if(!empty($users) && isset($users))
                        @foreach($users as $k => $user)
                        <tr>
                            <td>
                                <p class="m-0 text-center">{{ $users->firstItem() + $k }}</p>
                            </td>
                            <td>{{ $user->username}}</td>
                            <td>{{ $user->email}}</td>
                            <td>{{ $user->address}}</td>
                            <td>{{ $user->contact_number}}</td>
                            <td>
                                @if($user->acl == 1)
                                    <span class="badge badge-success">Enabled</span>
                                @else
                                    <span class="badge badge-danger">Disabled</span>
                                @endif
                            </td>
                            <td>  
                                <a href="{{ route('user.update',['user_id'=>$user->hashid]) }}"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                     @else
                        <h1>NO DATA</h1>   
                    @endif    
                </tbody>
            </table>
            <div class="mpag mt-2">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>


@endsection

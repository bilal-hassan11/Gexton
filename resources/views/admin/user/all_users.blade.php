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
            <div class="d-flex align-items-center justify-content-between">
                {{-- <h4 class="header-title">Add User</h4> --}}
                {{-- @can('add-product')
                <a href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="add_range()">Add Product Range</a>
                @endcan --}}
            </div>
            <div class="mb-5">
                <h4 class="header-title">Add User's IP</h4>
                <form action="{{ route('acl.users.save') }}" method="GET" class="ajaxForm">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="form-group">
                                <select class="form-control" required="required" name="user">
                                    <option value="">Select User</option>
                                    @if(isset($users) && !empty($users))
                                        @foreach($users AS $user)
                                            <option value="{{ $user->hashid }}" @if(isset($update_acls) && $user->id == $update_acls->user_id) selected @endif>{{ $user->username }}</option>
                                        @endforeach()
                                    @endif
                                </select>
                                <input type="hidden" value="{{ (isset($update_acls->id))? $update_acls->hashid : '' }}" name="user_id">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter IP" required name="ip" value="{{ @$update_acls->ips }}">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <input type="submit" class="btn btn-primary" value="{{ (isset($update))? 'Update':'Add' }}">
                        </div>
                    </div>
                </form>
                <form action="{{ route('acl.users.search') }}" method="GET">
                    <div class="row">
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="search">
                        </div> 
                        <div class="col-sm-2">
                            <input type="submit" class="btn btn-primary" value="search">    
                        </div>   
                    </div> 
                </form>
                
            </div>
            
            <table class="table dt_table table-bordered w-100 nowrap" id="">
                <thead>
                    <tr>
                        <th width="20">S.No</th>
                        <th>Name</th>
                        <th>IPS</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @if(!empty($acls) && isset($acls)) --}}
                        @foreach($acls as $k => $user)
                        <tr>
                            <td>
                                <p class="m-0 text-center">{{ $acls->firstItem() + $k }}</p>
                            </td>
                            <td>{{ $user->users->username}}</td>
                            <td>{{ $user->ips}}</td>
                            <td>  
                                <a href="{{ route('acl.users.show',['user_id'=>$user->hashid]) }}"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    {{-- @else
                        <p>NO DATA</p>    
                    @endif     --}}
                </tbody>
            </table>
            {{ $acls->links() }}
        </div>
    </div>
</div>

<!-- Center modal content -->
<div class="modal fade" id="permission_modal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mypermission_modalLabel"><span id="modal_title"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form class="ajaxForm" action="{{route('product.range.save')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="Product_Range">Product Range</label>
                        <input class="form-control" name="name" type="text" id="Product_Range"  required="required" />
                    </div>
                    <div class="form-group">
                        <input class="form-control" name="product_id" type="hidden" id="product_id" />
                        <button class="btn btn-xs btn-success">Submit</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection

{{-- @section('page-scripts')
@include('admin.partials.datatable')
<script>


function add_range(is_update = false, permission_id = null, permission_name = null){
        $("#product_id").val(permission_id);
        $("#Product_Range").val(permission_name);
        if(is_update){
            $("#modal_title").html('Update '+permission_name);
        }else{
            $("#modal_title").html('Add New Permission');
        }

        $("#permission_modal").modal('show');
    }
</script>
@endsection --}}
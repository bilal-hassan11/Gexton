@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">ACL</li>
                </ol>
            </div>
            <h4 class="page-title">All ACL</h4>
        </div>
    </div>
</div>

<!-- Center modal content -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="mypermission_modalLabel"><span id="modal_title"></span></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="{{ route('acl.users.save') }}" method="GET" class="ajaxForm" id="database_model">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select class="form-control" required="required" name="user">
                                    <option value="">Select User</option>
                                    @if(isset($users) && !empty($users))
                                        @foreach($users AS $user)
                                            <option value="{{ $user->id }}">{{ $user->username }}</option>
                                        @endforeach()
                                    @endif
                                </select>
                                <input type="hidden" value="" name="user_id">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter IP" required name="ip" value="">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-primary">{{ (isset($update))? 'Update':'Add' }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="d-flex align-items-center justify-content-between">
            </div>
            <div class="mb-5">
                {{-- <h4 class="header-title">Add User's IP</h4> --}}
                <form action="{{ route('acl.users.search') }}" method="GET">
                    <div class="row">
                        <div class="col-sm-6 d-flex">
                            <input type="text" class="form-control" name="search">
                            <input type="submit" class="btn btn-primary" value="search" style="margin-left: 20px">
                        </div> 
                        <div class="col-sm-6">
                              
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right" >Add ACL</button>
 
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
                                <a href="{{ route('acl.users.save') }}" data="{{json_encode($user)}}" class="edit"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    {{-- @else
                        <p>NO DATA</p>    
                    @endif     --}}
                </tbody>
            </table>
             <div class="mpag mt-2">
                {{ $acls->links() }}
             </div>
        </div>
    </div>
</div>


@endsection
 @section('page-scripts')
{{-- @include('admin.partials.datatable') --}}
<script>

$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  
  var recipient = button.data('whatever') // Extract info from data-* attributes

  var modal = $(this)
//   modal.find('.modal-title').text( 'Add ACL')
//   modal.find('.modal-body input').val('Add Acl')
  $('.ajaxForm')[0].reset();
})
$(document).on('click','.edit',function(e){

    e.preventDefault();
    var data = JSON.parse($(this).attr('data'));
    console.log(data);
    var url = $(this).attr('href');
    $("#exampleModal").modal('show');

    $('#database_model').attr('action',url);
    $('select[name="user"]').val(data.user_id).change();
    // $('select[name="nat"]').val(data.nat).change();
    // $('select[name="type"]').val(data.type).change();
    
    var name = $('select[name="user"]').find(":selected").text();
    $("#exampleModal").find('.modal-title').text( name + ' ACL');

    $('input[name="ip"]').val(data.ips);
    // $('input[name="nat"]').val(data.nat);
    // $('input[name="type"]').val(data.type);
    $('input[name="user_id"]').val(data.id);

});

</script>
@endsection 
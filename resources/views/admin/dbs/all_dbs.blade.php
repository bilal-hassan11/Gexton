@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Database</li>
                </ol>
            </div>
            <h4 class="page-title">All DATABASE</h4>
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
            <form action="{{ route('dbs.save') }}" method="GET" id="database_model" class="ajaxForm">
                    <div class="row">
                    <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter DBS NAME" required name="dbs_name" value="{{ @$update_dbs->dbs_name }}">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter User Name" required name="username" value="{{ @$update_dbs->username }}">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Enter Password" required name="password" value="{{ @$update_dbs->password }}">
                                <input type="hidden" value="{{ (isset($update_dbs->id))? $update_dbs->hashid : '' }}" name="dbs_id">  
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
            
            <div class="mb-5">
                {{-- <h4 class="header-title mb-2">Add Database</h4> --}}
                <form action="{{ route('dbs.search') }}" method="GET">
                    <div class="row">
                        <div class="col-sm-6 d-flex">
                            <input type="text" class="form-control" name="search">
                            <input type="submit" class="btn btn-primary" value="search" style="margin-left: 20px"> 
                        </div> 
                        <div class="col-sm-6 ">
                             
                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal" style="float: right" >Add Database</button>

                        </div>   
                        
                    </div> 
                </form>
            
            <table class="table dt_table table-bordered w-100 nowrap mt-5" id="">
                <thead>
                    <tr>
                        <th width="20">S.No</th>
                        <th>DBS NAME</th>
                        <th>USER Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                        @foreach($DBS as $k => $db)
                        <tr>
                            <td>
                                <p class="m-0 text-center">{{ $k + 1 }}</p>
                            </td>
                            <td>{{ $db->dbs_name}}</td>
                            <td>{{ $db->username}}</td>
                            <td>  
                                <a href="{{ route('dbs.save')}}" class="edit" data="{{json_encode($db)}}"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    {{-- @else
                        <p>NO DATA</p>    
                    @endif     --}}
                </tbody>
            </table>
            <div class="mpag mt-2">
                 {{ $DBS->links() }}
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
//   modal.find('.modal-title').text('Add Database')
//   modal.find('.modal-body input').val('Add Database')
  $('.ajaxForm')[0].reset();
})
$(document).on('click','.edit',function(e){

    e.preventDefault();
    var data = JSON.parse($(this).attr('data'));
    console.log(data);
    var url = $(this).attr('href');
    $("#exampleModal").modal('show');

    $("#exampleModal").find('.modal-title').text( data.dbs_name + ' Database');
    $('#database_model').attr('action',url);
    $('input[name="dbs_name"]').val(data.dbs_name);
    $('input[name="username"]').val(data.username);
    $('input[name="password"]').val(data.password);
    $('input[name="dbs_id"]').val(data.id);

});

</script>
@endsection 
@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">IPPOOLS</li>
                </ol>
            </div>
            <h4 class="page-title">All IPPOOLS</h4>
        </div>
    </div>
</div>
<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add IP pool</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ route('ippool.save') }}" method="GET" class="ajaxForm">
                    <div class="row">
                    <div class="col-sm-12">
                            <div class="form-group">
                                <select class="form-control" required="required" name="dbs_name" >
                                    <option value="">Select DBS</option>
                                    @if(isset($dbs) && !empty($dbs))
                                        @foreach($dbs AS $db)
                                            <option value="{{ $db->id }}">{{ $db->dbs_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Enter IP" required name="ip" value="{{ @$update_ippool->ip }}">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select class="form-control" required="required" name="nat">
                                    <option value="">Select NAT</option>
                                    <option value="yes">YES</option>
                                    <option value="no">NO</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <select class="form-control" required="required" name="type">
                                    <option value="">Select type</option>
                                    <option value="private">PRIVATE</option>
                                    <option value="corporate">CORPORATE</option>
                                </select>
                                <input type="hidden" value="" name="ippool_id">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            {{-- <input type="submit" class="btn btn-primary" value="{{ (isset($update))? 'Update':'Add' }}"> --}}
                            <button type="submit" class="btn btn-primary" id="add">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="d-flex align-items-center justify-content-between">
            </div>
            <div class="mb-5">
                {{-- <h4 class="header-title">Add IPPOOLS</h4> --}}
                
                <form action="{{ route('ippool.search') }}" method="GET">
                    <div class="row">
                        <div class="col-sm-6 d-flex">
                            <input type="text" class="form-control" name="search">
                             <input type="submit" class="btn btn-primary" value="search" style="margin-left: 20px">  
                        </div> 
                        <div class="col-sm-6">
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" style="float: right">
                                 Add IPPool
                            </button>
                        </div>   
                    </div> 
                </form>
            </div>
            
            <table class="table dt_table table-bordered w-100 nowrap" id="">
                <thead>
                    <tr>
                        <th width="20">S.No</th>
                        <th>DBS ID</th>
                        <th>IP</th>
                        <th>NAT</th>
                        <th>TYPE</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    
                        @foreach($ippools as $k => $ippool)
                        <tr>
                            <td>
                                <p class="m-0 text-center">{{ $k + 1 }}</p>
                            </td>
                            <td>{{ $ippool->dbs->dbs_name}}</td>
                            <td>{{ $ippool->ip}}</td>
                            <td>{{ $ippool->nat}}</td>
                            <td>{{ $ippool->type}}</td>
                            <td>  
                                {{-- <a href="{{ route('ippool.show')}}" class="edit" data="{{json_encode($ippool)}}"><i class="fas fa-edit"></i></a> --}}
                                <a href="{{ route('ippool.save')}}" class="edit" data="{{json_encode($ippool)}}"><i class="fas fa-edit"></i></a>
                            </td>
                        </tr>
                        @endforeach
                    {{-- @else
                        <p>NO DATA</p>    
                    @endif     --}}
                </tbody>
            </table>
            <div class="mpag mt-2">
                {{ $ippools->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
 @section('page-scripts')
{{-- @include('admin.partials.datatable') --}}
<script>

$('#exampleModalCenter').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) // Button that triggered the modal
  
  var recipient = button.data('whatever') // Extract info from data-* attributes

  var modal = $(this)
//   modal.find('.modal-title').text('Add IPPool')
//   modal.find('.modal-body input').val('Add IPPool');
  $('.ajaxForm')[0].reset();

})
$(document).on('click','.edit',function(e){

    e.preventDefault();
    var data = JSON.parse($(this).attr('data'));
    console.log(data);
    var url = $(this).attr('href');
    $("#exampleModalCenter").modal('show');

    $('#database_model').attr('action',url);
    $('select[name="dbs_name"]').val(data.id).change();
    $('select[name="nat"]').val(data.nat).change();
    $('select[name="type"]').val(data.type).change();
    
    var name = $('select[name="dbs_name"]').find(":selected").text();
    $("#exampleModalCenter").find('.modal-title').text( name + ' Database');

    $('input[name="ip"]').val(data.ip);
    $('input[name="nat"]').val(data.nat);
    $('input[name="type"]').val(data.type);
    $('input[name="ippool_id"]').val(data.id);

});

</script>
@endsection 

@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Products</li>
                </ol>
            </div>
            <h4 class="page-title">All Products Range</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="header-title">Products Range</h4>
                @can('add-product')
                <a href="javascript:void(0)" class="btn btn-sm btn-primary" onclick="add_range()">Add Product Range</a>
                @endcan
            </div>
            <p class="sub-header">Following is the list of all the Products Range.</p>
            <table class="table dt_table table-bordered w-100 nowrap" id="laravel_datatable">
                <thead>
                    <tr>
                        <th width="20">S.No</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ProductRange as $k => $product)
                    <tr>
                        <td>
                            <p class="m-0 text-center">{{ $k + 1 }}</p>
                        </td>
                        <td><small>{{ $product->name ?? '-' }}</small></td>
                        <td><small>{{ $product->slug }}</small></td>
                        <td>
                            @can('edit-range')
                            <a onclick="add_range(true, '{{$product->hashid}}', '{{$product->name}}')" href="javascript:void(0)" class="btn btn-warning btn-xs waves-effect waves-light">
                                <i class="fa fa-edit"></i>
                            </a>
                            @endcan
                           
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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

@section('page-scripts')
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
@endsection
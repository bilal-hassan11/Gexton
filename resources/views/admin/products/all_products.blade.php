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
            <h4 class="page-title">All Products</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="d-flex align-items-center justify-content-between">
                <h4 class="header-title">Products</h4>
                @can('add-product')
                <a href="{{ route('products.add') }}" class="btn btn-sm btn-primary">Add Product</a>
                @endcan
            </div>
            <p class="sub-header">Following is the list of all the products.</p>
            <table class="table dt_table table-bordered w-100 nowrap" id="laravel_datatable">
                <thead>
                    <tr>
                        <th width="20">S.No</th>
                        <th>Range</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $k => $product)
                    <tr>
                        <td>
                            <p class="m-0 text-center">{{ $k + 1 }}</p>
                        </td>
                        <td><small>{{ $product->range->name ?? '-' }}</small></td>
                        <td><small>{{ $product->name }}</small></td>
                        <td>
                            <button type="button" onclick="view_shades('{{$product->hashid}}', '{{$product->name ?? ''}}')" class="btn btn-success btn-xs waves-effect waves-light">View Shades</button>

                            @can('edit-product')
                            <a href="{{route('products.edit', $product->hashid)}}" class="btn btn-warning btn-xs waves-effect waves-light"><i class="fa fa-edit"></i></a>
                            @endcan
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="shadeModal" tabindex="-1" role="dialog" aria-labelledby="shadeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="shadeModalLabel">Shade Details For <span id="product_name"></span></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="shades_html"></div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('page-scripts')
@include('admin.partials.datatable')
<script>
    function view_shades(product_id, product_name){
        var url = "{{route('products.view_shades')}}";
        var params = {product_id};
        getAjaxRequests(url, params, 'post', function(res){
            $("#shades_html").html(res.html);
            $("#product_name").html(product_name);
            $("#shadeModal").modal('show');
        });
    }
</script>
@endsection
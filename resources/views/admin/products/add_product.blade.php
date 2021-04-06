@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">{{ isset($product) ? 'Edit' : 'Add'}} Product Shades</li>
                </ol>
            </div>
            <h4 class="page-title">{{ isset($product) ? 'Edit' : 'Add'}} Product Shades</h4>
        </div>
    </div>
</div>

<form action="{{route('products.save')}}" method="post" class="ajaxForm"> 
    @csrf
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">{{ isset($product) ? 'Edit' : 'Add'}} Shades</h4>

                    <div class="row">
                                            

        <div class="col-lg-12">
            
               
                <div class="form-group mb-3">
                    <label for="example-select">Range</label>
                    <select class="form-control get_pro_type" id="example-select" name="range_id"  @if(@$range_id)  disabled @endif>
                     @foreach($ranges as $val)
                     <option value="{{$val->id}}" @if($val->id==@$range_id) selected   @endif >{{$val->name}}</option>
                     @endforeach
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="example-select">Product</label>
                    <input  class="form-control" id="example-number" type="text" name="product_name" value="{{@$ProductType->name}}"  @if(@$range_id)  disabled @endif >
                </div>

        <!-- <div class="form-group mb-3">
            <label for="example-number">Product Name</label>
            <input class="form-control" id="prod-name" type="text" name="number">
        </div> -->

        <div>
        <button type="button" class="btn btn-success add_details">Add 
        </button>                                                        
        </div>
        <br>

        <div class="form-main" id="addon">
        <div class="panel-body">
                                                                                                                            
        @if(!isset($product)) 

        <div class="table1">
        <div class="row">

    
            <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="example-number">Item Name (Shade Name/Color)</label>
                <input  class="form-control" id="example-number" type="text" name="item[0][color]" >
            </div>
            </div>
                                                    
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="example-number">Item No (Shade No)</label>
                    <input  class="form-control shade_get" id="example-number" type="text" name="item[0][Shade]" index="0" >
                </div>
            </div>

           
                                                    
            </div>
            <div class="form2">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                    <table class="table table-centered mb-0" id="inline-editable" >
                    <thead>
                        <tr>
                        <th></th>
                        <th>Item Code</th>
                        <th>Weight in ltrs</th>
                        <th>Purchase Price</th>
                        <th>Sale Price</th>
                                                                                  
                        </tr>
                    </thead>
                                                                            
                    <tbody>

                      <tr>
                               <th scope="row">STIN</th>
                               <td><input  class="st_ltr"  type="text" step="any" name="item[0][st_code]" ></td>
                               <td><input  class="st_ltr"  type="number" step="any" name="item[0][st_ltr]" ></td>
                               <td><input  class="st_pp"  type="number" step="any" name="item[0][st_pp]" ></td>
                               <td><input  class="st_sp"  type="number" step="any" name="item[0][st_sp]" ></td>


                                                                                 
                        </tr>

                     <tr>
                               <th scope="row">QTR</th>
                               <td><input  class="qtr_ltr"  type="text" step="any" name="item[0][qtr_code]" ></td>
                                <td><input  class="qtr_ltr"  type="number" step="any" name="item[0][qtr_ltr]" ></td>
                                <td><input  class="qtr_pp"  type="number" step="any" name="item[0][qtr_pp]" ></td>
                                <td><input  class="qtr_sp"  type="number" step="any" name="item[0][qtr_sp]" ></td>


                                                                                 
                        </tr>
                                 
                        <tr>
                             <th scope="row">GALLON</th>

                             <td><input  class="gln_ltr"  type="text" step="any" name="item[0][gln_code]" ></td>
                             <td><input  class="gln_ltr"  type="number" step="any" name="item[0][gln_ltr]" ></td>


                            <td><input  class="gln_pp"  type="number" step="any" name="item[0][gln_pp]" ></td>
                             <td><input  class="gln_sp"  type="number" step="any" name="item[0][gln_sp]" ></td>
                                                        
                                                                                       
                        </tr>
                   
                        <tr>
                        <th scope="row">DRUM</th>
                        <td><input  class="drm_ltr"  type="text" step="any" name="item[0][drm_code]" ></td>
                        <td><input  class="drm_ltr"  type="number" step="any" name="item[0][drm_ltr]" ></td>
                        <td><input   class="drm_pp"  type="number" step="any" name="item[0][drm_pp]" ></td>



                                <td><input  class="drm_sp"  type="number" step="any" name="item[0][drm_sp]" ></td>
                                                                                 
                        </tr>
                                                                         
                    </tbody>
                   </table>
                   </div>
               
              </div>
             </div>
             </div>
          </div>   
        </div>
     </div>
  @endif
  @if(isset($product)) 
  <input type="hidden" name="product_name" value="{{@$ProductType->hashid}}" >
  <input type="hidden" name="range_id" value="{{@hashids_encode($ProductType->range_id)}}" >
  @php 
  $ids=[];
  @endphp
  @foreach($product as $key=>$val)     

  <div class="table1">
        <div class="row">

    
        <div class="col-md-6">
            <div class="form-group mb-3">
            <label for="example-number">Item Name (Shade Name/Color)</label>
                <input  class="form-control" id="example-number" type="text" name="item[{{$key}}][color]"  value="{{$val->item_name}}">
            </div>
            </div>
                                                    
            <div class="col-md-6">
                <div class="form-group mb-3">
                <label for="example-number">Item No (Shade No)</label>
                    <input  class="form-control shade_get" id="example-number" type="text" name="item[{{$key}}][Shade]"  index="{{$key}}"  value="{{$val->item_no}}">
                </div>
            </div>

           
                                                    
            </div>
            <div class="form2">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                    <table class="table table-centered mb-0" id="inline-editable" >
                    <thead>
                        <tr>
                        <th></th>
                        <th>Item Code</th>
                        <th>Weight in ltrs</th>
                        <th>Purchase Price</th>
                        <th>Sale Price</th>
                                                                                  
                        </tr>
                    </thead>
                                                                            
                    <tbody>
                   
                    @php $ar=[] @endphp 
                    @foreach(@$val->related as $k=>$l)
                    @php $ar[] = $l; $ids[]=$l->id; @endphp 
                    @endforeach
                    @php
                    $collection=@collect($ar);
                    $keyed = $collection->keyBy('packaging_type');

                    @endphp 
                    
                    <tr>
                               <th scope="row">STIN</th>
                               <td><input  class="st_ltr"  type="text" step="any" name="item[{{$key}}][st_code]" value="{{@$keyed['small tin']->item_code}}" ></td>
                               <td><input  class="st_ltr"  type="number" step="any" name="item[{{$key}}][st_ltr]"  value="{{@$keyed['small tin']->packaging}}"   ></td>
                               <td><input  class="st_pp"  type="number" step="any" name="item[{{$key}}][st_pp]" value="{{@$keyed['small tin']->purchase_price}}"  ></td>
                               <td><input  class="st_sp"  type="number" step="any" name="item[{{$key}}][st_sp]" value="{{@$keyed['small tin']->sale_price}}" ></td>


                                                                                 
                        </tr>
                      <tr>
                               <th scope="row">QTR</th>
                               <td><input  class="qtr_ltr"  type="text" step="any" name="item[{{$key}}][qtr_code]"   value="{{@$keyed['quarter']->item_code}}"></td>
                                <td><input  class="qtr_ltr"  type="number" step="any" name="item[{{$key}}][qtr_ltr]"  value="{{@$keyed['quarter']->packaging}}" ></td>
                                <td><input  class="qtr_pp"  type="number" step="any" name="item[{{$key}}][qtr_pp]" value="{{@$keyed['quarter']->purchase_price}}"  ></td>
                                <td><input  class="qtr_sp"  type="number" step="any" name="item[{{$key}}][qtr_sp]"  value="{{@$keyed['quarter']->sale_price}}"  ></td>


                                                                                 
                        </tr>
                                 
                        <tr>
                             <th scope="row">GALLON</th>

                             <td><input  class="gln_ltr"  type="text" step="any" name="item[{{$key}}][gln_code]" value="{{@$keyed['gallon']->item_code}}" ></td>
                             <td><input  class="gln_ltr"  type="number" step="any" name="item[{{$key}}][gln_ltr]"   value="{{@$keyed['gallon']->packaging}}" ></td>
                            <td><input  class="gln_pp"  type="number" step="any" name="item[{{$key}}][gln_pp]"  value="{{@$keyed['gallon']->purchase_price}}" ></td>
                             <td><input  class="gln_sp"  type="number" step="any" name="item[{{$key}}][gln_sp]" value="{{@$keyed['gallon']->sale_price}}"  ></td>
                                                        
                                                                                       
                        </tr>
                   
                        <tr>
                        <th scope="row">DRUM</th>
                        <td><input  class="drm_ltr"  type="text" step="any" name="item[{{$key}}][drm_code]" value="{{@$keyed['drum']->item_code}}"  ></td>
                        <td><input  class="drm_ltr"  type="number" step="any" name="item[{{$key}}][drm_ltr]"  value="{{@$keyed['drum']->packaging}}" ></td>
                        <td><input   class="drm_pp"  type="number" step="any" name="item[{{$key}}][drm_pp]" value="{{@$keyed['drum']->purchase_price}}"   ></td>
                         <td><input  class="drm_sp"  type="number" step="any" name="item[{{$key}}][drm_sp]"  value="{{@$keyed['drum']->sale_price}}" ></td>
                                                                                 
                        </tr> 
                                                                         
                    </tbody>
                   </table>
                   </div>
               
              </div>
             </div>
             </div>
          </div>   
        </div>
     </div>
    
  @endforeach
  <input type="hidden" value="{{implode(',',$ids)}}" name="ids">
  @endif

 </div>
</div>
    </div>
</div>
    <button type="submit" class="btn btn-primary" name="">Submit</button>
</div>

</form>
@endsection

@section('page-scripts')
<script>
$count = 1;
  $(".add_details").click(function(){
  
    $(".panel-body").append(` <div class="table1">
        <div class="row">

    
            <div class="col-md-6">
            <div class="form-group mb-3">
                <label for="example-number">Item Name (Shade Name/Color)</label>
                <input  class="form-control" id="example-number" type="text" name="item[${$count}][color]" >
            </div>
            </div>
                                                    
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="example-number">Item No (Shade No)</label>
                    <input  class="form-control shade_get" id="example-number" type="text" name="item[${$count}][Shade]" index="${$count}" >
                </div>
            </div>

           
                                                    
            </div>
            <div class="form2">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                    <table class="table table-centered mb-0" id="inline-editable" >
                    <thead>
                        <tr>
                        <th></th>
                        <th>Item Code</th>
                        <th>Weight in ltrs</th>
                        <th>Purchase Price</th>
                        <th>Sale Price</th>
                                                                                  
                        </tr>
                    </thead>
                                                                            
                    <tbody>

                      <tr>
                               <th scope="row">STIN</th>
                               <td><input  class="st_ltr"  type="text" step="any" name="item[${$count}][st_code]" ></td>
                               <td><input  class="st_ltr"  type="number" step="any" name="item[${$count}][st_ltr]" ></td>
                               <td><input  class="st_pp"  type="number" step="any" name="item[${$count}][st_pp]" ></td>
                               <td><input  class="st_sp"  type="number" step="any" name="item[${$count}][st_sp]" ></td>


                                                                                 
                        </tr>

                     <tr>
                               <th scope="row">QTR</th>
                               <td><input  class="qtr_ltr"  type="text" step="any" name="item[${$count}][qtr_code]" ></td>
                                <td><input  class="qtr_ltr"  type="number" step="any" name="item[${$count}][qtr_ltr]" ></td>
                                <td><input  class="qtr_pp"  type="number" step="any" name="item[${$count}][qtr_pp]" ></td>
                                <td><input  class="qtr_sp"  type="number" step="any" name="item[${$count}][qtr_sp]" ></td>


                                                                                 
                        </tr>
                                 
                        <tr>
                             <th scope="row">GALLON</th>

                             <td><input  class="gln_ltr"  type="text" step="any" name="item[${$count}][gln_code]" ></td>
                             <td><input  class="gln_ltr"  type="number" step="any" name="item[${$count}][gln_ltr]" ></td>


                            <td><input  class="gln_pp"  type="number" step="any" name="item[${$count}][gln_pp]" ></td>
                             <td><input  class="gln_sp"  type="number" step="any" name="item[${$count}][gln_sp]" ></td>
                                                        
                                                                                       
                        </tr>
                   
                        <tr>
                        <th scope="row">DRUM</th>
                        <td><input  class="drm_ltr"  type="text" step="any" name="item[${$count}][drm_code]" ></td>
                        <td><input  class="drm_ltr"  type="number" step="any" name="item[${$count}][drm_ltr]" ></td>
                        <td><input   class="drm_pp"  type="number" step="any" name="item[${$count}][drm_pp]" ></td>



                                <td><input  class="drm_sp"  type="number" step="any" name="item[${$count}][drm_sp]" ></td>
                                                                                 
                        </tr>
                                                                         
                    </tbody>
                   </table>
                   </div>
               
              </div>
             </div>
             </div>
          </div>   
        </div>
     </div>`);

    $count = $count +1;
    // <tr><th scope="row">Margin %</th><td><input class="st_mg" type="number" step="any" name="st_mg[]"></td><td><input class="qtr_mg" type="number" step="any" name="qtr_mg[]"></td><td><input class="gln_mg" type="number" step="any" name="gln_mg[]"></td><td><input class="drm_mg" type="number" step="any" name="drm_mg[]"></td></tr>

});

$("body").delegate(".remove_btn", "click", function(){
    $(this).parent().remove();
    if($count>1){
     $count = $count -1;
    }else{
     $count = 1;
    }
});
$(document).on('keyup','.shade_get',function(){
   var index = $(this).attr('index');
   v = $(this).val();
   $(`input[name='item[${index}][st_code]']`).val('ST'+v);
   $(`input[name='item[${index}][qtr_code]']`).val('Q'+v);
   $(`input[name='item[${index}][gln_code]']`).val('G'+v);
   $(`input[name='item[${index}][drm_code]']`).val('D'+v);

})
$(document).ready(function() {
//         $(document).on('keyup','.st_mg, .st_pp',function() {
//             // $(".st_mg").keyup(function() {
//                 $("input[name='st_pp[]']").each(function (index) {
//                     var st_pp = $("input[name='st_pp[]']").eq(index).val();
//                     var st_mg = $("input[name='st_mg[]']").eq(index).val();
//                     var num= (parseInt(st_mg)/100) *parseInt(st_pp);
//                     var st_sp = parseInt(num) + parseInt(st_pp);
//                     if (!isNaN(st_sp)) {
//                         $("input[name='st_sp[]']").eq(index).val(st_sp);
//                     }
//                 });
//             });
        
      
//  $(document).on('keyup','.qtr_pp, .qtr_mg',function() {
//             // $(".qtr_mg").keyup(function() {
//         $("input[name='qtr_pp[]']").each(function (index) {
//             var qtr_pp = $("input[name='qtr_pp[]']").eq(index).val();
//             var qtr_mg = $("input[name='qtr_mg[]']").eq(index).val();
//             var num= (parseInt(qtr_mg)/100) *parseInt(qtr_pp);
//             var qtr_sp = parseInt(num) + parseInt(qtr_pp);
            
//             if (!isNaN(qtr_sp)) {
//                 $("input[name='qtr_sp[]']").eq(index).val(qtr_sp);
//             }
//         });
//     });


//     $(document).on('keyup','.gln_pp,.gln_mg',function() {
//             $("input[name='gln_pp[]']").each(function (index) {
//             var gln_pp = $("input[name='gln_pp[]']").eq(index).val();
//             var gln_mg = $("input[name='gln_mg[]']").eq(index).val();
//             var num= (parseInt(gln_mg)/100) *parseInt(gln_pp);
//             var gln_sp = parseInt(num) + parseInt(gln_pp);
            
//             if (!isNaN(gln_sp)) {
//                 $("input[name='gln_sp[]']").eq(index).val(gln_sp);
//             }
//         });
//     });


//     $(document).on('keyup','.drm_pp,.drm_mg',function() {
//     // $(".drm_mg").keyup(function() {
//         $("input[name='drm_pp[]']").each(function (index) {
//             var drm_pp = $("input[name='drm_pp[]']").eq(index).val();
//             var drm_mg = $("input[name='drm_mg[]']").eq(index).val();
//             var num= (parseInt(drm_mg)/100) *parseInt(drm_pp);
//             var drm_sp = parseInt(num) + parseInt(drm_pp);
            
//             if (!isNaN(drm_sp)) {
//                 $("input[name='drm_sp[]']").eq(index).val(drm_sp);
//             }
//         });
//     });
    // $(document).on('change','.get_pro_type',function() {
    //   id = $(this).val();
    //   $('#Product_Type').html(``);
    //   url = `{{route('products.get_product_type')}}`;
    //   query_string = `id=${id}`;
    //   getAjaxRequests(url,query_string,'POST',function(data){
    //     $('#Product_Type').html(data.html);
    //   },true)
    // });
    
});

</script>
@endsection
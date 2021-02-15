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

<form action=""> 
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Add Products</h4>

                    <div class="row">
                                            

        <div class="col-lg-12">
            
        
                <div class="form-group mb-3">
                    <label for="example-select">Category</label>
                    <select class="form-control" id="example-select">
                        <option>OVERALL RANGE</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label for="example-select">Product Type</label>
                    <select class="form-control" id="example-select">
                        <option>Diamond Overall Synthetic Enamel (Orange Packing) 9001</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>

        <div class="form-group mb-3">
            <label for="example-number">Product Name</label>
            <input class="form-control" id="prod-name" type="text" name="number">
        </div>

        <div>
        <button type="button" class="btn btn-success add_details">Add</button>                                                        
        </div>
        <br>

        <div class="form-main" id="addon">
        <div class="panel-body">
        <div class="table1">
        <div class="row">
            <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="example-number">Color</label>
            <input class="form-control" id="example-number" type="text" name="number">
        </div>
            </div>
                                                    
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label for="example-number">Shade</label>
                    <input class="form-control" id="example-number" type="text" name="number">
                </div>
                    </div>
                                                    
            </div>
            <div class="form2">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              <div class="table-responsive">
                                    <table class="table table-centered mb-0" id="inline-editable">
                                        <thead>
                        <tr>
                            <th></th>
                            <th>STIN</th>
                            <th>QTR</th>
                            <th>GALLON</th>
                            <th>DRUM</th>
                                                                                  
                        </tr>
                    </thead>
                                                                            
                    <tbody>

                           <tr>
                            <th scope="row">Weight in ltrs</th>
                            <td><input class="st_ltr"  type="number" step="any" name="st_ltr[]"></td>
                                <td><input class="qtr_ltr"  type="number" step="any" name="qtr_ltr[]"></td>
                                <td><input class="gln_ltr"  type="number" step="any" name="gln_ltr[]"></td>
                                <td><input class="drm_ltr"  type="number" step="any" name="drm_ltr[]"></td>
                                                                                 
                        </tr>
                                 
                        <tr>
                            <th scope="row">Purchase Price</th>
                            <td><input class="st_pp"  type="number" step="any" name="st_pp[]"></td>
                                <td><input class="qtr_pp"  type="number" step="any" name="qtr_pp[]"></td>
                                <td><input class="gln_pp"  type="number" step="any" name="gln_pp[]"></td>
                                <td><input  class="drm_pp"  type="number" step="any" name="drm_pp[]"></td>
                                                                                        
                                                                                       
                        </tr>
                         <tr>
                                
                                <th scope="row">Margin %</th>
                                <td><input class="st_mg"  type="number" step="any" name="st_mg[]"></td>
                                <td><input class="qtr_mg"  type="number" step="any" name="qtr_mg[]"></td>
                                <td><input class="gln_mg"  type="number" step="any" name="gln_mg[]"></td>
                                <td><input class="drm_mg"  type="number" step="any" name="drm_mg[]"></td>
                        </tr>
                        <tr>
                            <th scope="row">Sale Price</th>
                            <td><input class="st_sp"  type="number" step="any" name="st_sp[]"></td>
                                <td><input class="qtr_sp"  type="number" step="any" name="qtr_sp[]"></td>
                                <td><input class="gln_sp"  type="number" step="any" name="gln_sp[]"></td>
                                <td><input class="drm_sp"  type="number" step="any" name="drm_sp[]"></td>
                                                                                 
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
 </div>
</div>
    </div>
</div>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>

</form>
@endsection

@section('page-scripts')
<script>
  $(".add_details").click(function(){
    
   
    $(".panel-body").append('<div class="table1"><button type="button" class="btn btn-danger remove_btn">Remove</button><br><br><div class="row"><div class="col-md-6"><div class="form-group mb-3"><label for="example-number">Color</label><input class="form-control" id="example-number" type="number" step="any" name="number"></div></div><div class="col-md-6"><div class="form-group mb-3"><label for="example-number">Shade</label><input class="form-control" id="example-number" type="number" step="any" name="number"></div></div></div><div class="form2"><div class="row"><div class="col-12"><div class="card"><div class="card-body"><div class="table-responsive"><table class="table table-centered mb-0" id="inline-editable"><thead><tr><th></th><th>STIN</th><th>QTR</th><th>GALLON</th><th>DRUM</th></tr></thead><tbody><tr><th scope="row">Weight in ltrs</th><td><input class="st_ltr"  type="number" step="any" name="st_ltr[]"></td><td><input class="qtr_ltr"  type="number" step="any" name="qtr_ltr[]"></td><td><input class="gln_ltr"  type="number" step="any" name="gln_ltr[]"></td><td><input class="drm_ltr"  type="number" step="any" name="drm_ltr[]"></td>  </tr><tr><th scope="row">Purchase Price</th><td><input class="st_pp" type="number" step="any" name="st_pp[]"></td><td><input class="qtr_pp" type="number" step="any" name="qtr_pp[]"></td><td><input class="gln_pp" type="number" step="any" name="gln_pp[]"></td><td><input  class="drm_pp" type="number" step="any" name="drm_pp[]"></td></tr><tr><th scope="row">Margin %</th><td><input class="st_mg" type="number" step="any" name="st_mg[]"></td><td><input class="qtr_mg" type="number" step="any" name="qtr_mg[]"></td><td><input class="gln_mg" type="number" step="any" name="gln_mg[]"></td><td><input class="drm_mg" type="number" step="any" name="drm_mg[]"></td></tr><tr><th scope="row">Sale Price</th><td><input class="st_sp" type="number" step="any" name="st_sp[]"></td><td><input class="qtr_sp" type="number" step="any" name="qtr_sp[]"></td><td><input class="gln_sp" type="number" step="any" name="gln_sp[]"></td><td><input class="drm_sp" type="number" step="any" name="drm_sp[]"></td></tr></tbody></table></div></div></div></div></div></div></div></div>');

});

$("body").delegate(".remove_btn", "click", function(){
    $(this).parent().remove();
});

$(document).ready(function() {
        $(document).on('keyup','.st_mg, .st_pp',function() {
            // $(".st_mg").keyup(function() {
                $("input[name='st_pp[]']").each(function (index) {
                    var st_pp = $("input[name='st_pp[]']").eq(index).val();
                    var st_mg = $("input[name='st_mg[]']").eq(index).val();
                    var num= (parseInt(st_mg)/100) *parseInt(st_pp);
                    var st_sp = parseInt(num) + parseInt(st_pp);
                    if (!isNaN(st_sp)) {
                        $("input[name='st_sp[]']").eq(index).val(st_sp);
                    }
                });
            });
        
      
 $(document).on('keyup','.qtr_pp, .qtr_mg',function() {
            // $(".qtr_mg").keyup(function() {
        $("input[name='qtr_pp[]']").each(function (index) {
            var qtr_pp = $("input[name='qtr_pp[]']").eq(index).val();
            var qtr_mg = $("input[name='qtr_mg[]']").eq(index).val();
            var num= (parseInt(qtr_mg)/100) *parseInt(qtr_pp);
            var qtr_sp = parseInt(num) + parseInt(qtr_pp);
            
            if (!isNaN(qtr_sp)) {
                $("input[name='qtr_sp[]']").eq(index).val(qtr_sp);
            }
        });
    });


    $(document).on('keyup','.gln_pp,.gln_mg',function() {
            $("input[name='gln_pp[]']").each(function (index) {
            var gln_pp = $("input[name='gln_pp[]']").eq(index).val();
            var gln_mg = $("input[name='gln_mg[]']").eq(index).val();
            var num= (parseInt(gln_mg)/100) *parseInt(gln_pp);
            var gln_sp = parseInt(num) + parseInt(gln_pp);
            
            if (!isNaN(gln_sp)) {
                $("input[name='gln_sp[]']").eq(index).val(gln_sp);
            }
        });
    });


    $(document).on('keyup','.drm_pp,.drm_mg',function() {
    // $(".drm_mg").keyup(function() {
        $("input[name='drm_pp[]']").each(function (index) {
            var drm_pp = $("input[name='drm_pp[]']").eq(index).val();
            var drm_mg = $("input[name='drm_mg[]']").eq(index).val();
            var num= (parseInt(drm_mg)/100) *parseInt(drm_pp);
            var drm_sp = parseInt(num) + parseInt(drm_pp);
            
            if (!isNaN(drm_sp)) {
                $("input[name='drm_sp[]']").eq(index).val(drm_sp);
            }
        });
    });
});

</script>
@endsection
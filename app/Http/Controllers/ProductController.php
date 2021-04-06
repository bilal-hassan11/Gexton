<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductType;
use App\Services\Slug;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{

    public function index(Request $request)
    {
        $data = array(
            'title' => 'All Products',
            'products' => \App\Models\ProductType::with('range')->latest()->get(),
        );
        return view('admin.products.all_products')->with($data);
    }

    public function add()
    {
        $data = array(
            'title' => 'Add Product',
            'ranges' => \App\Models\ProductRange::all(),
        );
        return view('admin.products.add_product')->with($data);
    }

    public function edit(Request $request)
    {   
        
       
        $id = hashids_decode($request->product_id);
        $range_id = hashids_decode($request->range_id);
     
        $product = Product::with('related')->where('type_id',$id)->groupBy('item_no')->get();
        $data = array(
            'title' => 'Edit Product',
            'ProductType' => \App\Models\ProductType::where('id',@$id)->first(),
            'ranges' => \App\Models\ProductRange::all(),
            'product' => $product,
            'type_id'=> @$id ,
            'range_id'=>$range_id
        );
        return view('admin.products.add_product')->with($data);
    }
    
    public function view_shades(Request $request)
    {
        $productType = ProductType::with('items')->hashidOrFail($request->product_id);
       
        $data = array(
            'product' => $productType,
        );
        $html = view('admin.products.product_shades', $data)->render();
        return response()->json([
            'html' => $html
        ]);
    }

    public function save(Request $request, Slug $slug)
    {     
      
        $data = $request->all();
        unset($data['_token']);
        $arr=[];
        $product = new Product();

        if (isset($request->ids) && !empty($request->ids)) {
            $ids = explode(',',$request->ids);
            if (is_array($ids)) 
            {
                Product::destroy($ids);
            }
             
            $hash_id= hashids_decode($data['product_name']);
            $range_id= hashids_decode($data['range_id']);
            $product_type_id = $hash_id;
            $msg = [
                'success' => 'Product has been updated',
                'redirect' => route('products.edit',[$data['product_name'],$data['range_id']])
            ];
        } else {
            $ProductType = new \App\Models\ProductType();
            $ProductType->slug = $slug->createSlug('products_type', $request->product_name);
            $ProductType->name = $request->product_name;
            $ProductType->range_id = $data['range_id'];
            $ProductType->save();
            $product_type_id = $ProductType->id;
            $msg = [
                'success' => 'Product Range has been added',
                'redirect' => route('products'),
            ];
        }
          
        $sale_price =[];
        $purchase_price =[];

        foreach($data['item'] as $key=>$n){
            // foreach($val['item'] as $j=>$n){
              if(!empty($n['st_ltr'])){
                 $arr[]=['range_id'=>$data['range_id'],'type_id'=>$product_type_id,'item_code'=>$n['st_code'],'item_name'=>$n['color'],'item_no'=>$n['Shade'],'packaging'=>$n['st_ltr'],'packaging_type'=>'small tin','purchase_price'=>$n['st_pp'],'sale_price'=>$n['st_sp'],'created_at'=>date('Y-m-d H:i:s')];
                 $purchase_price['small tin']= $n['st_pp'];
                 $sale_price['small tin']=$n['st_pp'];

              }
              if(!empty($n['qtr_ltr'])){
                $arr[]=['range_id'=>$data['range_id'],'type_id'=>$product_type_id,'item_code'=>$n['qtr_code'],'item_name'=>$n['color'],'item_no'=>$n['Shade'],'packaging'=>$n['qtr_ltr'],'packaging_type'=>'quarter','purchase_price'=>$n['qtr_pp'],'sale_price'=>$n['qtr_sp'],'created_at'=>date('Y-m-d H:i:s')];
                $purchase_price['quarter']= $n['qtr_pp'];
                $sale_price['quarter']=$n['qtr_sp'];
              }

              if(!empty($n['gln_ltr'])){
                $arr[]=['range_id'=>$data['range_id'],'type_id'=>$product_type_id,'item_code'=>$n['gln_code'],'item_name'=>$n['color'],'item_no'=>$n['Shade'],'packaging'=>$n['gln_ltr'],'packaging_type'=>'gallon','purchase_price'=>$n['gln_pp'],'sale_price'=>$n['gln_sp'],'created_at'=>date('Y-m-d H:i:s')];
                $purchase_price['gallon']= $n['gln_pp'];
                $sale_price['gallon']=$n['gln_sp'];
              }
              if(!empty($n['drm_ltr'])){
                $arr[]=['range_id'=>$data['range_id'],'type_id'=>$product_type_id,'item_code'=>$n['drm_code'],'item_name'=>$n['color'],'item_no'=>$n['Shade'],'packaging'=>$n['drm_ltr'],'packaging_type'=>'drum','purchase_price'=>$n['drm_pp'],'sale_price'=>$n['drm_sp'],'created_at'=>date('Y-m-d H:i:s')];
                $purchase_price['drum']= $n['drm_pp'];
                $sale_price['drum']=$n['drm_sp'];
              }
            
        }
      
        $p= ProductType::find($product_type_id);
        $p->sale_price = $sale_price;
        $p->purchase_price= $purchase_price;
        $p->save();
        $product->insert($arr);
        return response()->json($msg);
    }


    public function all_product_range(Request $request)
    {  
        // return view('admin.ranges.add_range');
        $ProductRange = \App\Models\ProductRange::all();
        // dd($ProductRange);
        $data = array(
            'ProductRange' => $ProductRange,
        );
        return view('admin.products.all_product_ranges')->with($data);
    }


    public function product_range_save(Request $request, Slug $slug)
    {
        $rules = [
            'name' => ['required', 'string', 'max:80'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }


        if ($request->product_id) {
            $ProductRange = \App\Models\ProductRange::hashidFind($request->product_id);
            $ProductRange->slug = $slug->createSlug('products_ranges', $request->name, $ProductRange->id);
            $msg = [
                'success' => 'Product Range has been updated',
                'reload' => true,
            ];
        } else {
            $ProductRange = new \App\Models\ProductRange();
            $ProductRange->slug = $slug->createSlug('products_ranges', $request->name);
            $msg = [
                'success' => 'Product Range has been added',
                'redirect' => route('products.range'),
            ];
        }

        $ProductRange->name = $request->name;
        $ProductRange->save();

        return response()->json($msg);
    }


    public function get_product_type(Request $request)
    {
        $productType = ProductType::whereRangeId($request->id)->get();
        $html = '';
        foreach ($productType as $key => $value) {
            $html .="<option value=".$value->id.">".$value->name."</option>";
        }
        return response()->json([
            'html' => $html
        ]);
    }
}

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
            'products' => \App\Models\ProductType::with('range')->latest()->get()
        );
        return view('admin.products.all_products')->with($data);
    }

    public function add()
    {
        $data = array(
            'title' => 'Add Product',
            'permissions' => \App\Models\ProductType::all(),
            'ranges' => \App\Models\ProductRange::all(),
        );
        return view('admin.products.add_product')->with($data);
    }

    public function edit(Request $request)
    {
        $product = ProductType::with('products')->hashidOrFail($request->product_id);
        $data = array(
            'title' => 'Edit Product',
            'permissions' => \App\Models\ProductType::all(),
            'ranges' => \App\Models\ProductRange::all(),
            'product' => $product,
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
        $rules = [
            'item_code' => ['required', 'string', 'max:80'],
            'item_name' => ['required', 'string', 'max:80'],
            'item_no' => ['required', 'string', 'max:80'],
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }


        if ($request->user_id) {
            $product = Product::hashidFind($request->product_id);
            $msg = [
                'success' => 'Product has been updated',
                'reload' => true,
            ];
        } else {
            $product = new Product();

            $msg = [
                'success' => 'Product has been added',
                'redirect' => route('products'),
            ];
        }

        $product->item_name = '';
        $product->save();

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
}

<?php

namespace App\Http\Controllers;

use App\Services\Slug;
use Illuminate\Http\Request;

class HomeController extends Controller {

    public function index() {
        return view('admin.dashboard');
    }

    public function importCSV(Slug $slug){
        // $data = $this->csvToArray('Merging Stock.csv');

        // foreach($data as $k => $item){
            // $range = \App\Models\ProductRange::firstOrNew(['name' => $item['Range']]);
            // if($range->id == null){
            //     $range->slug = $slug->createSlug('products_ranges', $item['Range']);
            //     $range->save();
            // }

            // $type = \App\Models\ProductType::firstOrNew(['name' => $item['ITEM']]);
            // if($type->id == null){
            //     $price = $item['Rate'];
            //     $type->slug = $slug->createSlug('products_type', $item['ITEM']);
            //     $type->purchase_price = round($price - ($price * 0.1));
            //     $type->margin = 10;
            //     $type->range_id = \App\Models\ProductRange::whereName($item['Range'])->first()->id ?? null;
            //     $type->sale_price = $price;
            //     $type->save();
            // }

            // $product = \App\Models\Product::firstOrNew(['item_code' => $item['Code'], 'item_no' => $item['ShadeNo']]);
            // if($product->id == null){
            //     $product->item_name = $item['ShadeName'];
            //     $product->item_code = $item['Code'];
            //     $product->item_no = $item['ShadeNo'];
            //     $product->packaging = $item['Pckng'];
            //     $product->packaging_type = strtolower($item['Ptype']);
            //     $product->type_id = \App\Models\ProductType::whereName($item['ITEM'])->first()->id ?? null;
            //     $product->range_id = \App\Models\ProductRange::whereName($item['Range'])->first()->id ?? null;
            //     $product->save();
            // }

            // $product = \App\Models\Product::whereItemCode($item['Code'])->wherePackaging($item['Pckng'])
            // ->whereNull('sale_price')
            // ->first();
            // if($product && $product->id != null){
            //     $price = $item['Rate'];
            //     $product->purchase_price = round($price - ($price * 0.1));
            //     $product->sale_price = $price;
            //     $product->save();
            // }
        // }
        
        // $products = \App\Models\Product::all();
        // $arr = [];
        // foreach($products as $k => $v){
        //     $arr[$v->type_id]['sale_price'][$v->packaging_type] = $v->sale_price;
        //     $arr[$v->type_id]['purchase_price'][$v->packaging_type] = $v->purchase_price;
        // }
        // foreach($arr as $a => $b){
        //     $product_type = \App\Models\ProductType::find($a);
        //     $product_type->sale_price = $b['sale_price'];
        //     $product_type->purchase_price = $b['purchase_price'];
        //     $product_type->save();
        // }
        exit;
        // dd($data);
    }

    private function csvToArray($filename = '', $delimiter = ',')
    {
        if (!file_exists($filename) || !is_readable($filename))
            return false;
    
        $header = null;
        $data = array();
        if (($handle = fopen($filename, 'r')) !== false)
        {
            while (($row = fgetcsv($handle, 1000, $delimiter)) !== false)
            {
                if (!$header)
                    $header = $row;
                else
                    $data[] = array_combine($header, $row);
            }
            fclose($handle);
        }
    
        return $data;
    }

}
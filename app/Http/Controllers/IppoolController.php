<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ippool;
use App\Models\DBS;

class IppoolController extends Controller
{
    public function index(Request $request){

        $data = array(
            'title' => 'All IPPOOLS',
            'dbs' => DBS::get(),
            'ippools' => ippool::paginate(env('PAGINATION_PER_PAGE')),
        );
        if(isset($request['ippool_id'])){
            $data['update'] = true;
            $data['update_ippool'] = ippool::with('dbs')->where('id',hashids_decode($request['ippool_id']))->first();
        }

        
        return view('admin.ippool.all_ippools')->with($data);
    }

    public function save_ippool(Request $request){

        $data = $request->all();
        //return "DONE if";        
        if(isset($data['ippool_id']) && !empty($data['ippool_id'])){
            // return "DONME";
            $id = $data['ippool_id'];
            
            $ippool = ippool::find($id);
            $ippool->dbs_id = $data['dbs_name'];
            $ippool->nat = $data['nat'];
            $ippool->ip = $data['ip'];
            $ippool->type = $data['type'];
            $ippool->save();
           
            return response()->json([
                'success'  => 'IPPOOL has been updated',
                'redirect'  => route('ippool.show'),
            ]);

        }else{
            //return "DONE else";
            $ippool = new ippool;
            $ippool->dbs_id = $data['dbs_name'];
            $ippool->nat = $data['nat'];
            $ippool->ip = $data['ip'];
            $ippool->type = $data['type'];
            $ippool->save();

            return response()->json([
            'success'   => 'IPTOOL has been added',
            'reload'    => true,
            ]);
        }
    }

    public function search(Request $request){
        $data = array(
            'title'   => 'All ippool',
            'dbs'     => DBS::get(),
            'ippools'  => ippool::where('ip','like','%'.$request['search'].'%')
                            ->orWhere('type','like','%'.$request['search'].'%')
                            ->orWhere('nat','like','%'.$request['search'].'%')
                            ->orWhere('ip','like','%'.$request['search'].'%')
                            ->paginate(env('PAGINATION_PER_PAGE')),

        );
        return view('admin.ippool.all_ippools')->with($data);
      
    }

}

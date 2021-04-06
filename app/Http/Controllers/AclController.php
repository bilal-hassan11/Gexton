<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Acl;
use App\Models\User;
use DB;

class AclController extends Controller
{
    public function index(Request $request){

        $data = array(
            'title' => 'All Users',
            'users' => User::where('acl',1)->get(),
            'acls'  => Acl::with('users')->paginate(env('PAGINATION_PER_PAGE')),
        );
        // echo '<pre>';
        // print_r($data);
        // die();
        if(isset($request['user_id'])){
            $data['update'] = true;
            $data['update_acls'] = ACL::where('id',hashids_decode($request['user_id']))->first();
        }
        
        return view('admin.acl.all_acl_users')->with($data);
    }

    public function save_user(Request $request){
        //return "DONE";
        $data = $request->all();
        
        if(isset($data['user_id']) && !empty($data['user_id'])){
            $acl = Acl::find($data['user_id']);
            $acl->user_id = $data['user'];
            $acl->ips = $data['ip'];
            $acl->save();

            return response()->json([
                'success'  => 'User has been updated',
                'redirect'  => route('acl.users.show'),
            ]);
        }else{
            $acl = new ACL;
            $acl->user_id = $data['user'];
            $acl->ips = $data['ip'];
            $acl->save();

            return response()->json([
            'success'   => 'User IP has been added',
            'reload'    => true,
            ]);
        }
    }

    public function search(Request $request){
        $key = $request['search'];
        $data = array(
            'title' => 'All Users',
            'users' => Admin::where('enable_acl',1)->get(),
            'acls'  => Acl::where(function($query) use ($key){
                $query->where('ips', 'like', '%'.$key.'%')
                ->orWhereHas('users', function($q) use ($key){    
                    $q->where('username', 'like', "%$key%");
                });
            })->paginate(env('PAGINATION_PER_PAGE')),

        );
        return view('admin.acl.all_acl_users')->with($data);
    }

}

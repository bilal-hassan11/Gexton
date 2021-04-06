<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request){
        $data = array(
            'title' => 'Add User'
        );
        //user data for update
        if(isset($request['user_id'])){
            $data['update'] = true;
            $data['update_user'] = User::where('id',hashids_decode($request['user_id']))->first();
            $data['title']  = 'Update User';
        }

        return view('admin.users.add_user')->with($data);
    }

    public function save(Request $request){
        $data = $request;
        
        
        if(isset($data['user_id']) && !empty($data['user_id'])){
            //check if email is already in use or not except his id
            if(User::where('email',$data['email'])->where('id','!=',hashids_decode($request['user_id']))->first()){
                return response()->json([
                    'error'  => 'This email is already in use',
                ]);
            }
        //check email is already is use or not when use first register
        }elseif(User::where('email',$data['email'])->first()){
            return response()->json([
                'error' => 'Email already  exists',
                //'reload'  => 'true',
            ]);
        }

        if(isset($data['user_id']) && !empty($data['user_id'])){
            $user = User::find(hashids_decode($request['user_id']));
            $msg = 'User has been updated';
        }else{
            $user = new User;
            $msg = 'User has been added';
        }
        $user->first_name = $data['first_name'];
        $user->last_name  = $data['last_name'];
        $user->username   = $data['username'];
        $user->email      = $data['email'];
        $user->address    = $data['address'];
        $user->nic        = $data['nic'];
        $user->contact_number = $data['contact_number'];
        $user->acl = $data['acl'];
        $user->save();

        return response()->json([
            'success'   => $msg,
            'redirect'    => route('users.show'),
        ]);
    }

    public function all_users(){

        $data = array(
            'title' => 'All Users',
            'users' => User::paginate(env('PAGINATION_PER_PAGE')),
        );
        return view('admin.users.all_users')->with($data);
    }

    public function search(Request $request){
        // echo '<pre>';
        // print_r($request->all());
        // die();
    $key = $request['search'];
    $data = array(
        'title' => 'All Users',
        'users' => User::where('first_name','like','%'.$key.'%')
                        ->orWhere('last_name','like','%'.$key.'%')
                        ->orWhere('username','like','%'.$key.'%')
                        ->orWhere('email','like','%'.$key.'%')
                        ->orWhere('nic','like','%'.$key.'%')
                        ->orWhere('contact_number','like','%'.$key.'%')
                        ->paginate(env('PAGINATION_PER_PAGE')),

    );
    return view('admin.users.all_users')->with($data);
}
}

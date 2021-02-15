<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Helpers\Exception;

class CommonHelpers
{

    public static function send_email($view, $data, $to, $subject = 'Welcome !', $from_email = null, $from_name = null)
    {
        $from_name = $from_name ?? env('FROM_EMAIL', '');
        $from_email = $from_email ?? env('FROM_NAME', '');

        $data = (array) $data;
        $data['subject'] = $subject;
        $data['to'] = $to;
        $data['from_name'] = $from_name;
        $data['from_email'] = $from_email;

        $data['email_data'] = $data;
        try {
            Mail::send('emails.' . $view, $data, function ($message) use ($data) {
                $message->from($data['from_email'], $data['from_name']);
                $message->subject($data['subject']);
                $message->to($data['to']);
            });
            return true;
        } catch (Exception $ex) {
            return response()->json($ex);
        }
    }

    public static function uploadSingleFile($file, $path = 'uploads/images/', $types = "png,gif,csv,jpeg,jpg", $filesize = '20000', $rule_msgs = [])
    {
        $path = $path . date('Y') . '/';
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $rules = array('file' => 'required|mimes:' . $types . "|max:" . $filesize);
        $validator = \Validator::make(array('file' => $file), $rules, $rule_msgs);
        if ($validator->passes()) {
            $rand = time() . "_" . \Str::random(15) . "_";
            $f_name = $rand . $file->getClientOriginalName();
            $filename = $path . $f_name;
            //full size image
            $file->move($path, $f_name);
            return $filename;
        } else {
            return ['error' => $validator->errors()->first('file')];
        }
    }

    public static function createThumbnail($filepath, $width = 500, $height = 500)
    {
        $img = \Image::make($filepath);
        //this so name can be broken
        $path = explode('/', $filepath);
        $f_name = "thumbnail_".last($path);
        //sticting the name and path again
        $path = str_replace(last($path), '', $filepath);
        $filename = $path . $f_name;

        $img->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        })->save($filename, 80);
        return $filename;
    }

    public static function all_countries(){
        return \DB::table('countries')->get();
    }

    public static function get_new_lease_code(){
        $lastOrder = \DB::table('leasings')->where('code', '!=', '')->orderBy('id', 'desc')->first();
        if (empty($lastOrder)){
            $number = 30010000001;
        }else{
            $number = (int) $lastOrder->code + 1;
        }
        return (string) $number;
    }

    public static function get_new_payment_code(){
        $lastOrder = \DB::table('payments')->where('payment_code', '!=', '')->orderBy('id', 'desc')->first();
        if (empty($lastOrder)){
            $number = 80010000001;
        }else{
            $number = (int) $lastOrder->payment_code + 1;
        }
        return (string) $number;
    }
}

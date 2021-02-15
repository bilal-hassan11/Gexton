<?php

if (!function_exists('get_fulltime')) {

    function get_fulltime($date, $format = 'd, M Y @ h:i a')
    {
        $new_date = new \DateTime($date);
        return $new_date->format($format);
    }
}


if (!function_exists('get_date')) {

    function get_date($date)
    {
        return get_fulltime($date, 'F d, Y');
    }
}


if (!function_exists('get_time')) {

    function get_time($date, $format = 'h:i A')
    {
        $new_date = new \DateTime($date);
        return $new_date->format($format);
    }
}

if (!function_exists('get_date_differences')) {
    function get_date_differences($start, $end, $interval = '1 month')
    {
        $start    = new \DateTime($start); // Today date
        $end      = new \DateTime($end); // Create a datetime object from your Carbon object
        $interval = \DateInterval::createFromDateString($interval); // 1 month interval
        $period   = new DatePeriod($start, $interval, $end); // Get a set of date beetween the 2 period
        
        return $period;
    }
}

if (!function_exists('get_price')) {

    function get_price($price)
    {
        return 'PKR ' . number_format($price, 2);
    }
}

if (!function_exists("safeCount")) {

    function safeCount($array)
    {
        if (is_array($array) || is_object($array)) {
            return count($array);
        } else {
            return 0;
        }
    }
}

if (!function_exists('dummy_image')) {

    function dummy_image($type = null)
    {
        switch ($type) {
            case 'user':
                return asset('admin_assets/images/user-img-dummy.png');
            default:
                return asset('admin_assets/images/image-not-found.jpg');
        }
    }
}

if (!function_exists('check_file')) {

    function check_file($file = null, $type = null)
    {
        if ($file && $file != '' && file_exists($file)) {
            return asset($file);
        } else {
            return dummy_image($type);
        }
    }
}

if (!function_exists('hashids_encode')) {

    function hashids_encode($str)
    {
        return \Hashids::encode($str);
    }
}

if (!function_exists('hashids_decode')) {

    function hashids_decode($str)
    {
        try {
            return \Hashids::decode($str)[0];
        } catch (Exception $e) {
            return abort(404);
        }
    }
}

if (!function_exists('user_types')) {
    function user_types($index = null)
    {
        $arr = [
            "normal" => ['title' => 'Normal', 'class' => 'blue'],
            "admin" => ['title' => 'Admin', 'class' => 'danger'],
        ];
        if ($index) {
            return $arr[$index] ?? $arr['admin'];
        }
        return $arr;
    }
}

if (!function_exists('download_file')) {
    function download_file($file){
        if(file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="'.basename($file).'"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            flush(); // Flush system output buffer
            readfile($file);
            die();
        }
        abort(404);
    }
}

if (!function_exists('ordinal')) {
    function ordinal($number) {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if ((($number % 100) >= 11) && (($number%100) <= 13))
            return $number. 'th';
        else
            return $number. $ends[$number % 10];
    }
}
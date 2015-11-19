<?php

class Http {

    static function redirect($to, $permanent = false)
    {
        if ($permanent)
            header("HTTP/1.1 301 Moved Permanently");

        header('Location:' . $to);
        exit;
    }

    static function notFound($message = '')
    {
        header("HTTP/1.0 404 Not Found");

        $title = "404 Not Found";
        load_template('header', array('title' => $title));

        load_view('not_found');

        load_template('footer');
    }
    
    static function getRequest($url, $data = array()) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url . '?' . http_build_query($data)); 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch); 

        curl_close($ch);
        
        return $output;
    }
}
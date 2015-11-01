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
}
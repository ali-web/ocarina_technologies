<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 15-10-31
 * Time: 10:30 AM
 */

class StoryTime{

    static function titleGenerator()
    {
        $arr1 = array('pumpkin', 'carrot', 'potato', 'car', 'nose', 'monkey');
        $arr2 = array('smasher', 'monster', 'eater', 'salad maker', 'killer', 'dreamer');

        return "The " . $arr1[mt_rand(0,5)] . " " . $arr2[mt_rand(0,5)];
    }

    static function URIGenerator()
    {
        return chr( mt_rand( 97 ,122 ) ) .substr( md5( time( ) ) ,1, 10 );
    }
}
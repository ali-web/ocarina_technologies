<?php
/**
 * Created by PhpStorm.
 * User: ali
 * Date: 15-10-31
 * Time: 10:54 AM
 */

class ST_Model{
    public $db;

    function __construct(){
        $this->db = st_db_object();
    }
}
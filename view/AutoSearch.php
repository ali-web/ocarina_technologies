<?php

    define('ST_BASE_DIR', dirname(empty($_SERVER['SCRIPT_FILENAME']) ? dirname(__FILE__."/../") : $_SERVER['SCRIPT_FILENAME']).'/../');
    define('ST_INCLUDE_DIR', ST_BASE_DIR . 'include/');
    require ST_INCLUDE_DIR . 'st-index.php';

    //get search term
    $searchTerm = $_GET['term'];
    //get matched data from skills table
    $query = st_db_object()->rawQuery("SELECT * FROM user WHERE name LIKE '%".$searchTerm."%' ORDER BY name ASC");
    $data = [];
    foreach($query as $row) {
        $data[] = $row['name']; 
    }
    
    //return json data
    echo json_encode($data);
?>
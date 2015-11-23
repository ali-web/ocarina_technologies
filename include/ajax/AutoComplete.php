<?php
    function complete() {
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
    }
?>
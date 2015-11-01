<?php

if ( ST_APP_STATUS == 'deployed' ) {
    @ini_set("display_errors", 0);
} else {
    @ini_set("display_errors", 1);
}

st_bootstrap();



function st_bootstrap()
{
    date_default_timezone_set('America/Vancouver');

    global $db;
    require_once ST_LIB_DIR . 'MysqliDb.php';
    $db = new MysqliDb (ST_MYSQL_HOSTNAME, ST_MYSQL_USERNAME, ST_MYSQL_PASSWORD, ST_MYSQL_DATABASE);
}

function st_db_object()
{
    global $db;

    return $db;
}

<?php

// Check to see if we are running in the cloud 9 development environment.
// If we are, the C9_USER environment variable will be set.
$cloud9User = getenv("C9_USER");
if ($cloud9User) {
    define('ST_MYSQL_HOSTNAME', getenv('IP'));
    define('ST_MYSQL_USERNAME', $cloud9User);
    define('ST_MYSQL_PASSWORD', '');
    define('ST_MYSQL_DATABASE', 'c9');
} else {
    define('ST_MYSQL_HOSTNAME', 'localhost');
    define('ST_MYSQL_USERNAME', 'root');
    define('ST_MYSQL_PASSWORD', 'rootfdsf');
    define('ST_MYSQL_DATABASE', 'ST');
}


define('ST_APP_STATUS', 'developing'); // possible values: developing , deployed
define('ST_UNDER_MAINTENANCE', 0); // if 1, site will not be displayed

define('ST_BASE_DOMAIN', 'localhost:8888');

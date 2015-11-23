<?php

// Check to see if we are running in the cloud 9 development environment.
// If we are, the C9_USER environment variable will be set.
$cloud9User = getenv("C9_USER");
/*$fbClientId = getenv("FB_CLIENT_ID");
$fbSecretId = getenv("FB_SECRET_ID");
$fbAccessToken = getenv("FB_ACCESS_TOKEN");*/

$fbClientId = "616373461835997";
$fbSecretId = "2ce2fb48bbc2991b89a7750541d980f5";
$fbAccessToken = "0c18e5413201d15783f711858c855001";

if ($cloud9User) {
    define('ST_MYSQL_HOSTNAME', getenv('IP'));
    define('ST_MYSQL_USERNAME', $cloud9User);
    define('ST_MYSQL_PASSWORD', '');
    define('ST_MYSQL_DATABASE', 'c9');
    
    $siteHostName = getenv("C9_HOSTNAME");
    define('ST_AUTH_REDIRECT_URI', 'https://' . $siteHostName . '/User/auth/');
} else {
    define('ST_MYSQL_HOSTNAME', 'localhost');
    define('ST_MYSQL_USERNAME', 'root');
    define('ST_MYSQL_PASSWORD', 'root');
    define('ST_MYSQL_DATABASE', 'ST');
    $siteHostName = 'storytime.aliweb.ir';
    define('ST_AUTH_REDIRECT_URI', 'http://' . $siteHostName . '/User/auth/');
}


define('ST_APP_STATUS', 'developing'); // possible values: developing , deployed
define('ST_UNDER_MAINTENANCE', 0); // if 1, site will not be displayed
define('ST_FB_CLIENT_ID', $fbClientId);
define('ST_FB_SECRET_ID', $fbSecretId);
define('ST_FB_ACCESS_TOKEN', $fbAccessToken);

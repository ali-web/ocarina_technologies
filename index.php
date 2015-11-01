<?php

//echo "UNDER CONSTRUCTION for 5 MINUTES...";
//exit;

//@ini_set('display_errors', 0);

define('ST_BASE_DIR', dirname(empty($_SERVER['SCRIPT_FILENAME']) ? dirname(__FILE__) : $_SERVER['SCRIPT_FILENAME']).'/');
define('ST_INCLUDE_DIR', ST_BASE_DIR . 'include/');

require ST_INCLUDE_DIR . 'st-index.php';
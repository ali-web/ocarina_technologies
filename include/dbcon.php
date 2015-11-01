<?php

$db = new Mysqlidb(Array(
            'host' => ST_MYSQL_HOSTNAME,
            'username' => ST_MYSQL_USERNAME,
            'password' => ST_MYSQL_PASSWORD,
            'db'=> ST_MYSQL_DATABASE,
            'charset' => 'utf8')
        );
<?php
session_start();

$GLOBALS['config'] = array(

    'mysql' => array(
        'host' => '172.0.0.1',
        'username' => 'root',
        'password' => 'root',
        'db' => 'login_reg'
    ),
    'remember' => array(
        'cookie_name' => 'hash',
        'cookie_expity' => 604800
    ),
    'session' => array(
        'session_name' => 'user'
    )
);

spl_autoload_register(function ($cls_name){
    require_once "classes/{$cls_name}.php";
});

require_once "functions/senitize.php";

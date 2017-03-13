<?php

/**
 * Created by PhpStorm.
 * User: mehedi
 * Date: 1/2/17
 * Time: 6:53 PM
 */
class Config
{
    public static function get($path = null)
    {
        if ($path){
            $config = $GLOBALS['config'];
            $path = explode('/', $path);

            foreach ($path as $bit){
                if (isset($config[$bit])){
                    $config = $config[$bit];
                }
            }

            return $config;
        }

        return false;
    }
}
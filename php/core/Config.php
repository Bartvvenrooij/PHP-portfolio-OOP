<?php

/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 21-1-2015
 * Time: 10:52
 */
class Config
{

    public static function get($path)
    {
        if ($path) {
            $path = explode('/', $path);
            $config = $GLOBALS['config'];
            foreach ($path as $bit) {
                if (isset($config[$bit])) {
                    $config = $config[$bit];
                }
            }
            return $config;
        }
    }
}

?>
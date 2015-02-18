<?php

/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 29-1-2015
 * Time: 9:18
 */
class Input
{

    public static function exists($type = 'post')
    {
        switch ($type) {
            case 'post':
                return ! empty($_POST) ? true : false;
                break;
            case 'get':
                return ! empty($_GET) ? true : false;
                break;
            default:
                return false;
                break;
        }
    }

    public static function get($item)
    {
        if (isset($_POST[$item])) {
            return $_POST[$item];
        } elseif (isset($_GET[$item])) {
            return $_GET[$item];
        }
        return '';
    }

    public static function isEmpty($item)
    {
        if (isset($_POST[$item])) {
            return true;
        } elseif (isset($_GET[$item])) {
            return true;
        }
        return false;
    }
}

?>
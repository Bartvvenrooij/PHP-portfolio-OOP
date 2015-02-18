<?php

/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 21-1-2015
 * Time: 14:14
 */
class Session
{

    public static function make($name, $value)
    {
        $_SESSION[$name] = $value;
    }

    public static function get($name)
    {
        return $_SESSION[$name];
    }

    public static function exists($name)
    {
        if (isset($_SESSION[$name])) {
            return true;
        } else {
            return false;
        }
    }

    public static function destroy($name)
    {
        unset($_SESSION[$name]);
    }

    public static function unSerialize($name)
    {
        return unserialize($_SESSION[$name]);
    }
}
<?php

/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 26-1-2015
 * Time: 11:33
 */
class Redirect
{

    public static function to($string)
    {
        header('location: ' . $string);
    }
}
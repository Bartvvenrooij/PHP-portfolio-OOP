<?php

/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 21-1-2015
 * Time: 13:15
 */
class Hash
{

    public static function make($string)
    {
        $string = hash('sha256', $string);
        return $string;
    }

    public static function salt()
    {
        return mcrypt_create_iv(16, MCRYPT_DEV_RANDOM);
    }
}

?>
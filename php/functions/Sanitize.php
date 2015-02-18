<?php
/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 21-1-2015
 * Time: 9:15
 */

function escape($string)
{
    return htmlentities($string, ENT_QUOTES, 'UTF-8');
}

?>
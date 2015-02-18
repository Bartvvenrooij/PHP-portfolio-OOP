<?php

/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 26-1-2015
 * Time: 13:01
 */
class Admin extends User
{

    public function getGroup()
    {
        return 'Administrator';
    }
}
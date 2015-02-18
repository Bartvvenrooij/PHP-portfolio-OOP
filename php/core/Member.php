<?php

/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 28-1-2015
 * Time: 14:26
 */
class Member extends User
{

    public $name = 'test';

    public function getGroup()
    {
        $this->name = 'Member';
        return $this->name;
    }
}
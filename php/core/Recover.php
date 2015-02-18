<?php

/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 3-2-2015
 * Time: 8:37
 */
class Recover
{

    private $_db,
        $_user;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function existsEmail($email)
    {
        $result = $this->_db->get('users', array('email', '=', $email));
        if ($result->count() > 0) {
            return true;
        }
        return false;
    }

    public function getUser($email)
    {
        $this->_user = $this->_db->get('users', array('email', '=', $email));
        if ($this->_user->count() > 0) {
            return $this->_user->first();
        }
        return false;
    }
}

?>
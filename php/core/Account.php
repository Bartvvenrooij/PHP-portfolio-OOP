<?php

/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 21-1-2015
 * Time: 11:37
 */
class Account
{

    private $_db;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function create($fields = array())
    {
        if ( ! $this->_db->insert('users', $fields)) {
            throw new Exception('There was a problem creating an account');
        }
    }

    public function login($input, $password)
    {
        $user = $this->_db->get('users', array(
            'username', '=', $input
        ));
        if ($user->count() < 1) {
            $user = $this->_db->get('users', array(
                'email', '=', $input
            ));
        }
        if ($user->count() > 0) {
            if ($user->first()->email === $input || $user->first()->username === $input) {
                if ($user->first()->password === $password . $user->first()->salt) {
                    return $user->first();
                }

            }
        }
    }
}
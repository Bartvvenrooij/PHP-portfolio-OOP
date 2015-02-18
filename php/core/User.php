<?php

/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 26-1-2015
 * Time: 12:58
 */
abstract class User
{

    private $_user;

    public abstract function getGroup();

    public function __construct($user)
    {
        $this->_user = $user;
    }

    public function getUser()
    {
        return $this->_user;
    }

    public function getId()
    {
        return $this->getUser()->idusers;
    }

    public function getFirstName()
    {
        return $this->getUser()->firstName;
    }

    public function getSecondName()
    {
        return $this->getUser()->secondName;
    }

    public function getDateOfBirth()
    {
        return $this->getUser()->dateOfBirth;
    }

    public function getEmail()
    {
        return $this->getUser()->email;
    }

    public function setEmail($string)
    {
        DB::getInstance()->update('users', $this->getId(), array('email' => $string));
        $this->getUser()->email = $string;
        return;
    }

    public function getUsername()
    {
        return $this->getUser()->username;
    }

    public function setUsername($string)
    {
        DB::getInstance()->update('users', $this->getId(), array('username' => $string));
        $this->getUser()->username = $string;
        return;
    }

    public function getPassword()
    {
        return $this->getUser()->password . $this->getUser()->salt;
    }

    public function setPassword($string)
    {
        DB::getInstance()->update('users', $this->getId(), array('password' => $string . $this->getUser()->salt));
        return;
    }

    public function getSalt()
    {
        return $this->getUser()->salt;
    }


}
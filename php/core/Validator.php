<?php

/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 21-1-2015
 * Time: 8:58
 */
class Validator
{

    private $_passed = false,
        $_errors = array(),
        $_db = null;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function check($source, $items = array())
    {
        foreach ($items as $item => $rules) {
            $field = '';
            foreach ($rules as $rule => $rule_value) {
                $value = trim($source[$item]);
                $item = escape($item);
                if ($rule === 'name') {
                    $field = $rule_value;
                } elseif ($rule == 'required' && empty($value)) {
                    $this->addError("The {$field} is required");
                } else {
                    switch ($rule) {
                        case 'min':
                            if (strlen($value) < $rule_value) {
                                $this->addError("The {$field} must be more than $rule_value characters");
                            }
                            break;
                        case 'max':
                            if (strlen($value) > $rule_value) {
                                $this->addError("The {$field} must be less than $rule_value characters");
                            }
                            break;
                        case 'matches':
                            if ($value != $source[$rule_value]) {
                                $this->addError("{$field} doesn't match {$rule_value}");
                            }
                            break;
                        case 'unique':
                            $check = $this->_db->get($rule_value, array($item, '=', $value));
                            if ($check->count() > 0) {
                                $this->addError("The {$field} already exists");
                            }
                            break;
                        case 'banned':
                            $check = $this->_db->get('users', array($item, '=', $value));
                            if ($check->count() > 0) {
                                if ($check->first()->banned == true) {
                                    $this->addError("This account has been banned!");
                                }
                            }
                            break;
                        case 'available':
                            $check = $this->_db->get('users', array($item, '=', $value));
                            if ($check->count() <= 0) {
                                $this->addError("This {$field} doesn't exists");
                            }
                            break;
                        case 'age':
                            $age = floor(floor((time() - strtotime(Input::get('day') . '-' . Input::get('month') . '-' . Input::get('year'))) / 31556926));
                            if ($age < $rule_value) {
                                $this->addError("You must be {$rule_value} years old");
                            }
                            break;
                    }
                }
            }
        }
        if (empty($this->_errors)) {
            $this->_passed = true;
        }
        return $this;
    }

    public function addError($error)
    {
        $this->_errors[] = $error;
    }

    public function errors()
    {
        return $this->_errors;
    }

    public function passed()
    {
        return $this->_passed;
    }
}

?>
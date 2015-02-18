<?php
/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 29-1-2015
 * Time: 9:18
 */

spl_autoload_register(function ($class) {
    if ($class != 'SMTP') {
        require('php/core/' . $class . '.php');
    }
});
require('php/mail/class.phpmailer.php');
require('php/functions/Sanitize.php');

session_start();

$GLOBALS['config'] = array(
    'mysql' => array(
        'host' => '127.0.0.1',
        'username' => 'root',
        'password' => '',
        'dbname' => 'portfolio'
    )
);

?>
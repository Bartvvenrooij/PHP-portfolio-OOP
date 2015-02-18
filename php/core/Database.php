<?php

/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 29-1-2015
 * Time: 9:24
 */
interface Database
{

    public function __construct();

    public static function getInstance();

    public function query($sql, $params = array());

    public function action($action, $table, $where = array());

    public function get($table, $where = array());

    public function delete($table, $where = array());

    public function insert($table, $fields = array());

    public function update($table, $id, $fields);

    public function error();

    public function count();

    public function results();

    public function first();
}






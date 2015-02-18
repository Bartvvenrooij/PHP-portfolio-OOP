<?php
/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 30-1-2015
 * Time: 13:21
 */

if (Input::exists('get')) {
    if (Input::get('ban')) {
        $user = DB::getInstance()->get('users', array('username', '=', $_GET['ban']))->first();
        DB::getInstance()->update('users', $user->idusers, array('banned' => 1));
        Redirect::to('?link=7');
    }
    if (Input::get('delete')) {
        $user = DB::getInstance()->get('users', array('username', '=', $_GET['delete']))->first();
        DB::getInstance()->delete('comments', array('users_idusers', '=', $user->idusers));
        DB::getInstance()->delete('users', array('username', '=', $user->username));
        Redirect::to('?link=7');
    }
    if (Input::get('un-ban')) {
        $user = DB::getInstance()->get('users', array('username', '=', $_GET['un-ban']))->first();
        DB::getInstance()->update('users', $user->idusers, array('banned' => 0));
        Redirect::to('?link=7');
    }
    if (Input::get('setAdmin')) {
        $user = DB::getInstance()->get('users', array('username', '=', $_GET['setAdmin']))->first();
        DB::getInstance()->update('users', $user->idusers, array('group_idgroup' => 2));
        Redirect::to('?link=7');
    }
    if (Input::get('unsetAdmin')) {
        $user = DB::getInstance()->get('users', array('username', '=', $_GET['unsetAdmin']))->first();
        DB::getInstance()->update('users', $user->idusers, array('group_idgroup' => 1));
        Redirect::to('?link=7');
    }
    if (Input::get('deleteComment')) {
        DB::getInstance()->delete('comments', array('idcomments', '=', Input::get('deleteComment')));
        Redirect::to('?link=4&page=' . Input::get('page'));
    }
    if (Input::get('deleteCommentUser')) {
        DB::getInstance()->delete('comments', array('idcomments', '=', Input::get('deleteCommentUser')));
        Redirect::to('?link=6');
    }
    if (Input::get('deleteCommentAdmin')) {
        DB::getInstance()->delete('comments', array('idcomments', '=', Input::get('deleteCommentAdmin')));
        Redirect::to('?link=9&user=' . Input::get('user'));
    }
}

?>

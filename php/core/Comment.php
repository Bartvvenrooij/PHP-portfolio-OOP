<?php

/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 29-1-2015
 * Time: 17:41
 */
class Comment
{

    private $_db;

    public function __construct()
    {
        $this->_db = DB::getInstance();
    }

    public function create($fields = array())
    {
        if ( ! $this->_db->insert('comments', $fields)) {
            throw new Exception('There was a problem creating an account');
        }
    }

    public function getCommentsById($id)
    {
        $comment = $this->_db->get('comments', array('users_idusers', '=', $id), 'ORDER BY post_date DESC LIMIT 20');
        return $comment->results();
    }

    public function getCommentsByType($type)
    {
        $comment = $this->_db->get('comments', array('type', '=', $type), 'ORDER BY post_date DESC LIMIT 20');
        return $comment->results();
    }

    public function getCommentsByMessage($type, $input)
    {
        $comment = $this->_db->get("comments", array('message', 'LIKE', '%' . $input . '%'))->results();
        return $comment;
    }

    public function GetCommentsName($id)
    {
        $comment = $this->_db->get('users', array('idusers', '=', $id));
        return $comment->first()->username;
    }

    public function getAmountOfComments($id)
    {
        $comment = $this->_db->get('comments', array('users_idusers', '=', $id));
        return $comment->count();
    }

    public function getPostedName($id)
    {
        $user = $this->_db->get('users', array(
            'idusers', '=', $id
        ));
        return $user->first()->firstName;
    }
}
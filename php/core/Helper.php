<?php

/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 29-1-2015
 * Time: 9:18
 */
class Helper
{

    public static function getLink($link)
    {
        if (Session::exists('user')) {
            $user = serialize(Session::get('user'));
            $user = unserialize($user);
        }
        switch ($link) {
            case 1:
                include('views/page/home.php');
                break;
            case 2:
                include('views/page/register.php');
                break;
            case 3:
                include('views/page/about.php');
                break;
            case 4:
                include('views/page/projects.php');
                break;
            case 5:
                include('views/page/contact.php');
                break;
            case 6:
                if (Session::exists('user')) {
                    include('views/page/account-info.php');
                } else {
                    Redirect::to('?link=1');
                }
                break;
            case 7:
                if (Session::exists('user') && $user->getGroup() == 'Administrator') {
                    include('views/page/admin-page.php');
                } else {
                    Redirect::to('?link=1');
                }
                break;
            case 8:
                include('views/page/admin-edit-user.php');
                break;
            case 9:
                include('views/page/admin-user-account.php');
                break;
            case 10:
                include('views/page/forgot-password.php');
                break;
            default:
                include('views/page/home.php');
                break;
        }
    }

    public static function getPage($page)
    {
        switch ($page) {
            case 1:
                include('views/page/projects/html.php');
                break;
            case 2:
                include('views/page/projects/css.php');
                break;
            case 3:
                include('views/page/projects/php.php');
                break;
            case 4:
                include('views/page/projects/java.php');
                break;
            case 5:
                include('views/page/projects/minecraft.php');
                break;
            default:
                return;
                break;
        }
    }
}

?>
<?php
/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 29-1-2015
 * Time: 9:10
 */
?>

<div role="main">
    <aside>
        <?php
        if (Session::exists('user')) {
            include('views/widget/loggedin.php');
        } else {
            if (Input::get('link') != 2) {
                include('views/widget/login.php');
            }

        }
        include('views/widget/follow.php');
        ?>
    </aside>
    <div class="content">
        <?php
        if (Input::exists('get')) {
            Helper::getLink(Input::get('link'));
        } else {
            include('views/page/home.php');
        }
        ?>
    </div>
    <div class="clear"></div>

</div>
<?php
/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 29-1-2015
 * Time: 9:10
 */
if (Session::exists('user')) {
    $user = serialize(Session::get('user'));
    $user = unserialize($user);

}
?>
<header>
    <nav>
        <ul>
            <li><a href="?link=1" class="header_img"><img src="image/logovenrooij.png" alt="logo"/></a></li>
        </ul>
        <ul>
            <li><a href="?link=1">Home</a></li>
            <li><a href="?link=3">About</a></li>
            <li><a href="?link=4">Projects</a></li>
            <li><a href="?link=5">Contact</a></li>
            <?php
            if (Session::exists('user')) {
                echo '<li><a href="?link=6">Account info</a></li>';
                if ($user->getGroup() == 'Administrator') {
                    echo '<li><a href="?link=7">Administrator</a></li>';
                }
            } else {
                echo '<li><a href="?link=2">Register</a></li>';
            }
            ?>

        </ul>
    </nav>
</header>
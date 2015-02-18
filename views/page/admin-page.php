<?php
/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 29-1-2015
 * Time: 13:45
 */
?>
<section>
    <h1>Administrator page</h1>
</section>

<section class="size2 admin">
    <h2>Users</h2>
    <?php
    $users = DB::getInstance()->query("SELECT * FROM users");
    foreach ($users->results() as $user) {
        if ($user->banned == 1) {
            echo '<p class="banned"><a href="?link=9&user=' . $user->username . '">' . $user->username . '</a>';
        } else {
            echo '<p><a href="?link=9&user=' . $user->username . '">' . $user->username . '</a>';
            echo '<a href="?link=8&ban=' . $user->username . '">Ban user</a>';
        }
        echo '<a href="?link=8&delete=' . $user->username . '">Delete user</a>';
        echo '</p>';
        echo '<div class="clear"></div>';
    }
    echo '<p>Users:' . $users->count() . '</p>';
    ?>
</section>

<section class="size2 admin">
    <h2>Banned:</h2>
    <?php
    $users = DB::getInstance()->query("SELECT * FROM users");
    foreach ($users->results() as $user) {
        if ($user->banned == true) {
            echo '<p><a href="?link=9&user=' . $user->username . '">' . $user->username . '</a>';
            echo '<a href="?link=8&un-ban=' . $user->username . '">Unban user</a>';
            echo '</p>';
            echo '<div class="clear"></div>';
        }
    }
    ?>
</section>

<section class="size2">
    <h2>Admin:</h2>
    <?php
    $users = DB::getInstance()->query("SELECT * FROM users");
    foreach ($users->results() as $user) {
        if ($user->group_idgroup == 2) {
            echo '<p><a href="?link=9&user=' . $user->username . '">' . $user->username . '</a></p>';

        }
    }
    ?>
</section>
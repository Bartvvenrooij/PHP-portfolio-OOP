<?php
/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 29-1-2015
 * Time: 13:21
 */
if (Input::exists('post')) {
    if (Input::get('sign-out')) {
        Session::destroy('user');
        Redirect::to('index.php?link=1');
    }
}

if (Session::exists('user')) {
    $user = Session::get('user');
}

?>
<div class="widget">
    <h1>User</h1>

    <p><?php echo $user->getUsername(); ?></p>

    <p><?php echo $user->getGroup(); ?></p>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="submit" name="sign-out" value="Sign out"/>
    </form>
</div>
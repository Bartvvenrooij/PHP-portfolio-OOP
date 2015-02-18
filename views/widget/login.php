<?php
/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 29-1-2015
 * Time: 9:15
 */
$errors = false;
$password = null;
if (Input::exists('post')) {
    if (Input::get('login')) {
        $validator = new Validator();
        $validation = $validator->check($_POST, array(
            'username' => array(
                'name' => 'username',
                'required' => true,
                'min' => 2,
                'banned' => true,
                'available' => true
            ),
            'password' => array(
                'name' => 'password',
                'required' => true
            )
        ));

        if ($validation->passed()) {
            $account = new Account();
            if ( ! $firstuser = $account->login(Input::get('username'), (Hash::make(Input::get('password'))))) {
                $password = 'Wrong password';
            } else {
                if ($firstuser->group_idgroup == 2) {
                    $admin = new Admin($firstuser);
                    Session::make('user', $admin);
                    Redirect::to('index.php?link=1');

                } else {
                    $user = new Member($firstuser);
                    Session::make('user', $user);
                    Redirect::to('index.php?link=1');
                }
            }

        } else {
            $errors = true;
        }
    }
}

?>
<div class="widget">
    <h1>Login</h1>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
        <input type="text" name="username"
               value="<?php echo(Input::exists('post', 'username') ? Input::get('username') : ''); ?>"
               placeholder="Username" autofocus/>
        <?php
        if ($errors) {
            foreach ($validation->errors() as $error) {
                if (strpos($error, 'username') || strpos($error, 'banned')) {
                    echo '<p class="errors">' . $error . '</p>';
                }
            }
        }
        ?>

        <input type="password" name="password" placeholder="Password"/>
        <?php
        if ($errors) {
            foreach ($validation->errors() as $error) {
                if (strpos($error, 'password')) {
                    echo '<p class="errors">' . $error . '</p>';
                }
            }
        }
        if (isset($password)) {
            echo '<p class="errors">' . $password . '</p>';
        }
        ?>

        <input type="submit" id="submit" name="login" value="Sign in"/>
    </form>
    <a href="?link=10">Forgot password</a>
    <a href="?link=2">Register</a>

    <div class="clear"></div>
</div>
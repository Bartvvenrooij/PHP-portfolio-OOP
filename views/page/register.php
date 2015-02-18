<?php
/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 20-1-2015
 * Time: 9:05
 */

$errors = false;

if (Input::exists('post')) {
    $validator = new Validator();
    $validation = $validator->check($_POST, array(
        'first_name' => array(
            'name' => 'first name',
            'required' => true,
            'min' => 2,
            'max' => 20
        ),
        'second_name' => array(
            'name' => 'second name',
            'required' => true,
            'min' => 2,
            'max' => 40
        ),
        'email' => array(
            'name' => 'email',
            'required' => true,
            'min' => 2,
            'max' => 45,
            'unique' => 'users'
        ),
        'year' => array(
            'name' => 'year',
            'required' => true,
            'age' => 10
        ),
        'username' => array(
            'name' => 'username',
            'required' => true,
            'min' => 2,
            'max' => 20,
            'unique' => 'users'
        ),
        'password' => array(
            'name' => 'password',
            'required' => true,
            'min' => 2,
            'max' => 20,
        ),
        'password_again' => array(
            'name' => 'password again',
            'required' => true,
            'matches' => 'password'
        )
    ));

    if ($validation->passed()) {
        $newUser = new Account();
        $salt = Hash::salt();
        $newUser->create(array(
            'firstName' => Input::get('first_name'),
            'secondName' => Input::get('second_name'),
            'dateOfBirth' => Input::get('year') . '-' . Input::get('month') . '-' . Input::get('day'),
            'email' => Input::get('email'),
            'username' => Input::get('username'),
            'password' => Hash::make(Input::get('password')) . $salt,
            'salt' => $salt,
            'banned' => false,
            'group_idgroup' => 1
        ));

        $first = $newUser->login(Input::get('username'), Hash::make(Input::get('password')));
        $user = new Member($first);
        Session::make('user', $user);
        Redirect::to('?link=1');
    } else {
        $errors = true;
    }
}

?>
<h1>Register</h1>
<section>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="register">

        <input type="text" name="first_name"
               value="<?php echo(Input::exists('post', 'first_name') ? Input::get('first_name') : ''); ?>"
               placeholder="First Name" autofocus/>
        <?php
        if ($errors) {
            foreach ($validation->errors() as $error) {
                if (strpos($error, 'first name')) {
                    echo '<p class="errors">' . $error . '</p>';
                }
            }
        }
        ?>

        <input type="text" name="second_name"
               value="<?php echo(Input::exists('post', 'second_name') ? Input::get('second_name') : ''); ?>"
               placeholder="Second Name"/>
        <?php
        if ($errors) {
            foreach ($validation->errors() as $error) {
                if (strpos($error, 'second name')) {
                    echo '<p class="errors">' . $error . '</p>';
                }
            }
        }
        ?>

        <input type="email" name="email"
               value="<?php echo(Input::exists('post', 'email') ? Input::get('email') : ''); ?>" placeholder="Email"/>
        <?php
        if ($errors) {
            foreach ($validation->errors() as $error) {
                if (strpos($error, 'email')) {
                    echo '<p class="errors">' . $error . '</p>';
                }
            }
        }
        ?>

        <label for="day">Date of birth:</label>
        <select name="day" id="day">
            <?php
            for ($i = 1; $i <= 31; $i++) {
                echo '<option value="' . $i . '"';
                echo (Input::exists('post', 'day') ? (Input::get('day') == $i ? 'selected' : '') : '') . '>' . $i . '</option>';
            }
            ?>
        </select>

        <select name="month" id="month">
            <?php
            for ($i = 1; $i <= 12; $i++) {
                echo '<option value="' . $i . '"';
                echo (Input::exists('post', 'month') ? (Input::get('month') == $i ? 'selected' : '') : '') . '>' . $i . '</option>';
            }
            ?>
        </select>

        <select name="year" id="year">
            <?php
            for ($i = date('Y'); $i >= 1900; $i--) {
                echo '<option value="' . $i . '"';
                echo (Input::exists('post', 'year') ? (Input::get('year') == $i ? 'selected' : '') : '') . '>' . $i . '</option>';
            }
            ?>
        </select>
        <?php
        if ($errors) {
            foreach ($validation->errors() as $error) {
                if (strpos($error, 'years')) {
                    echo '<p class="errors">' . $error . '</p>';
                }
            }
        }
        ?>

        <input type="text" name="username"
               value="<?php echo(Input::exists('post', 'username') ? Input::get('username') : ''); ?>"
               placeholder="Username"/>
        <?php
        if ($errors) {
            foreach ($validation->errors() as $error) {
                if (strpos($error, 'username')) {
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
        ?>

        <input type="password" name="password_again" placeholder="Password again"/>
        <?php
        if ($errors) {
            foreach ($validation->errors() as $error) {
                if (strpos($error, 'match')) {
                    echo '<p class="errors">' . $error . '</p>';
                }
            }
        }
        ?>

        <input type="submit" id="submit" name="submit" value="Register"/>
    </form>
</section>
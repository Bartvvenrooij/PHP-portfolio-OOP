<?php
/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 29-1-2015
 * Time: 13:45
 */
$comment = new Comment();

if (Session::exists('user')) {
    $user = Session::get('user');
}

$errors = false;
if (Input::exists('post')) {
    if (Input::get('change')) {
        $validate = new Validator();
        $validation = $validate->check($_POST, array(
            'email' => array(
                'name' => 'email',
                'max' => 45
            ),
            'username' => array(
                'name' => 'username',
                'max' => 20
            ),
            'password' => array(
                'name' => 'password',
                'max' => 20
            ),
            'password_again' => array(
                'name' => 'password again',
                'matches' => 'password'
            )
        ));

        if ($validation->passed()) {
            if (strlen(Input::get('email')) > 2) {
                $user->setEmail(Input::get('email'));
            }
            if (strlen(Input::get('username')) > 2) {
                $user->setUsername(Input::get('username'));
            }
            if (strlen(Input::get('password')) > 2) {
                $user->setPassword(Hash::make(Input::get('password')));
            }
        } else {
            $errors = true;
        }
    }
}

?>
<h1>Account information</h1>

<section class="column">
    <p>First name:</p>

    <p>Second name:</p>

    <p>Email:</p>

    <p>Date of birth:</p>

    <p>Username:</p>

    <p>Password:</p>

    <p>Account status:</p>

    <p>Comments:</p>

    <?php
    echo '<p>' . $user->getFirstName() . '</p>';
    echo '<p>' . $user->getSecondName() . '</p>';
    echo '<p>' . $user->getEmail() . '</p>';
    echo '<p>' . $user->getDateOfBirth() . '</p>';
    echo '<p>' . $user->getUsername() . '</p>';
    echo '<p><span>••••••••</span></p>';
    echo '<p>' . $user->getGroup() . '</p>';
    echo '<p>' . $comment->getAmountOfComments($user->getId()) . '</p>';
    ?>
</section>

<section class="change">
    <h1>Change account information</h1>

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="register">
        <input type="email" name="email" placeholder="Email"/>
        <?php
        if ($errors) {
            foreach ($validation->errors() as $error) {
                if (strpos($error, 'email')) {
                    echo '<p class="errors">' . $error . '</p>';
                }
            }
        }
        ?>

        <input type="text" name="username" placeholder="Username"/>
        <?php
        if ($errors) {
            foreach ($validation->errors() as $error) {
                if (strpos($error, 'username')) {
                    echo '<p class="errors">' . $error . '</p>';
                }
            }
        }
        ?>
        <input type="password" name="password" placeholder="New password"/>
        <?php
        if ($errors) {
            foreach ($validation->errors() as $error) {
                if (strpos($error, 'password')) {
                    echo '<p class="errors">' . $error . '</p>';
                }
            }
        }
        ?>

        <input type="password" name="password_again" placeholder="New password again"/>
        <?php
        if ($errors) {
            foreach ($validation->errors() as $error) {
                if (strpos($error, 'match')) {
                    echo '<p class="errors">' . $error . '</p>';
                }
            }
        }
        ?>
        <input type="submit" name="change" id="submit" value="Change info"/>
    </form>
</section>

<section class="comment">
    <h1>Your comments:</h1>
    <?php
    if (count($comment->getCommentsById($user->getId())) > 0) {
        foreach ($comment->getCommentsById($user->getId()) as $com) {
            echo '<article>';
            echo '<p>At: ' . $com->type . '</p>';
            echo '<p>' . $com->message . '</p>';
            echo '<p>' . $comment->getPostedName($user->getId()) . '</p>';
            echo '<p>' . $com->post_date;
            echo '<a href="?link=8&page=2&deleteCommentUser=' . $com->idcomments . '"">Delete comment</a>';
            echo '</p></article>';
        }
    } else {
        echo '<p>No comments posted.</p>';
    }

    ?>
</section>
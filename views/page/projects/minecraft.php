<?php
/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 20-1-2015
 * Time: 15:02
 */

if (Session::exists('user')) {
    $user = Session::get('user');
}
$comment = new Comment();
$errors = $search = false;
if (Input::exists('post')) {
    if (strlen(Input::get('searchText')) > 0) {
        $search = true;

    } else {
        $search = false;
    }
    if (Input::get('submitcomment')) {
        $validate = new Validator();
        $validation = $validate->check($_POST, array(
            'comment' => array(
                'name' => 'comment',
                'required' => true,
                'min' => 6,
                'max' => 200
            )
        ));
        if ($validation->passed()) {
            $comment->create(array(
                'message' => '<pre>' . Input::get('comment') . '</pre>',
                'type' => 'Minecraft',
                'post_date' => date('Y-m-d h:i:s'),
                'users_idusers' => $user->getId()

            ));
            Redirect::to('?link=4&page=5');
        } else {
            $errors = true;
        }

    }
}
?>
    <section>
        <h2>Minecraft</h2>
    </section>

<?php
if (Session::exists('user')) {
    ?>
    <section class="comment">
        <h1>Add comment</h1>

        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <textarea name="comment" id="comment" cols="30" rows="10" placeholder="Enter your comment."></textarea>
            <?php
            if ($errors) {
                foreach ($validation->errors() as $error) {
                    if (strpos($error, 'comment')) {
                        echo '<p class="errors">' . $error . '</p>';
                    }
                }
            }
            ?>

            <input type="submit" name="submitcomment" value="Post"/>
        </form>
    </section>
<?php
} else {
    ?>
    <section>
        <p>Login to add a comment</p>
    </section>
<?php
}
?>
    <section>
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
            <input type="text" name="searchText" placeholder="Search comment"/>
            <input type="submit" name="search" value="Search"/>
        </form>
    </section>

    <section class="comment">
        <?php
        if ($search == false) {
            if (count($comment->getCommentsByType('Minecraft')) > 0) {
                foreach ($comment->getCommentsByType('Minecraft') as $com) {
                    echo '<article>';
                    echo '<p>At: ' . $com->type . '</p>';
                    echo '<p>' . $com->message . '</p>';
                    echo '<p>By: ' . $comment->GetCommentsName($com->users_idusers) . '</p>';
                    echo '<p>' . $com->post_date;
                    if (Session::exists('user')) {
                        if ($user->getGroup() == 'Administrator') {
                            echo '<a href="?link=8&page=5&deleteComment=' . $com->idcomments . '">Delete comment</a>';
                        }
                    }
                    echo '</p></article>';
                }
            } else {
                echo '<p>No comments</p>';
            }
        } else {
            $results = $comment->getCommentsByMessage('Minecraft', Input::get('searchText'));
            $counter = 0;
            foreach ($results as $result) {
                if ($result->type == 'Minecraft') {
                    echo '<article>';
                    echo '<p>At: ' . $result->type . '</p>';
                    echo '<p>' . $result->message . '</p>';
                    echo '<p>By: ' . $comment->GetCommentsName($result->users_idusers) . '</p>';
                    echo '<p>' . $result->post_date;
                    if (Session::exists('user')) {
                        if ($user->getGroup() == 'Administrator') {
                            echo '<a href="?link=8&page=1&deleteComment=' . $result->idcomments . '">Delete comment</a>';
                        }
                    }
                    echo '</p></article>';
                    $counter++;
                }
            }
            if ($counter == 0) {
                echo '<p>No comment found</p>';
            }
        }

        ?>
    </section>
<?php

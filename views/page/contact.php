<?php
/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 20-1-2015
 * Time: 12:05
 */


$errors = false;
if (Input::exists('post')) {
    if (Input::get('send_mail')) {

        $validate = new Validator();
        $validation = $validate->check($_POST, array(
            'name' => array(
                'name' => 'name',
                'required' => true,
                'min' => 2,
                'max' => 20
            ),
            'email' => array(
                'name' => 'email',
                'required' => true,
                'min' => 2,
                'max' => 45,
            ),
            'subject' => array(
                'name' => 'subject',
                'required' => true,
                'min' => 2,
                'max' => 100,
            ),
            'message' => array(
                'name' => 'message',
                'required' => true,
                'min' => 6,
                'max' => 400,
            )

        ));
        if ($validation->passed()) {
            $mail = new PHPMailer();
            $body = Input::get('name') . '<br><br>';
            $body .= Input::get('email') . '<br>';
            $body .= Input::get('subject') . '<br><br>';
            $body .= Input::get('message');

            $mail->isSMTP();
            $mail->Host = "ssl://smtp.gmail.com";
            $mail->SMTPDebug = 0;

            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "ssl";
            $mail->Host = "smtp.gmail.com";
            $mail->Port = 465;
            $mail->Username = "bartvvenrooij@gmail.com";
            $mail->Password = "mzgobxzyzuxxigle";

            $mail->SetFrom('bartvvenrooij@gmail.com', Input::get('subject'));

            $mail->Subject = "Contact";

            $mail->MsgHTML('<pre style="font-size: 15px; font-family: Arial, Helvetica, sans-serif">' . $body . '</pre>');

            $address = "bartvvenrooij@gmail.com";
            $mail->AddAddress($address, "user2");

            if ( ! $mail->Send()) {
                echo "Mailer Error: " . $mail->ErrorInfo;
            } else {
                Session::make('send', 'Your message has been send!');
            }

        } else {
            $errors = true;
        }

    }
}

?>
<h1>Contact</h1>

<section>
    <h1>Send mail</h1>
    <?php
    if (Session::exists('send')) {
        echo Session::get('send');
        Session::destroy('send');
    }

    ?>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST" class="contact">
        <input type="text" name="name"
               value="<?php echo(Session::exists('user') ? Session::get('user')->getFirstName() . ' ' . Session::get('user')->getSecondName() : ''); ?>"
               placeholder="Name" autofocus/>
        <?php
        if ($errors) {
            foreach ($validation->errors() as $error) {
                if (strpos($error, 'name')) {
                    echo '<p class="errors">' . $error . '</p>';
                }
            }
        }
        ?>

        <input type="email" name="email"
               value="<?php echo(Session::exists('user') ? Session::get('user')->getEmail() : ''); ?>"
               placeholder="Email"/>
        <?php
        if ($errors) {
            foreach ($validation->errors() as $error) {
                if (strpos($error, 'email')) {
                    echo '<p class="errors">' . $error . '</p>';
                }
            }
        }
        ?>

        <input type="text" name="subject" placeholder="Subject"/>
        <?php
        if ($errors) {
            foreach ($validation->errors() as $error) {
                if (strpos($error, 'subject')) {
                    echo '<p class="errors">' . $error . '</p>';
                }
            }
        }
        ?>

        <textarea name="message" id="" cols="30" rows="10"></textarea>
        <?php
        if ($errors) {
            foreach ($validation->errors() as $error) {
                if (strpos($error, 'message')) {
                    echo '<p class="errors">' . $error . '</p>';
                }
            }
        }
        ?>

        <input type="submit" name="send_mail" value="Send"/>
    </form>
</section>

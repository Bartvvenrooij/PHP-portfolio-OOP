<?php
/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 3-2-2015
 * Time: 8:33
 */
$errors = false;
if (Input::exists('post')) {
    if (Input::get('recover')) {
        $validator = new Validator();
        $validation = $validator->check($_POST, array(
            'email' => array(
                'name' => 'email',
                'required' => true,
                'min' => 2,
                'max' => 45
            )
        ));

        if ($validation->passed()) {
            $recover = new Recover();
            if ($recover->existsEmail(Input::get('email'))) {
                $user = new Member($recover->getUser(Input::get('email')));
                $random = substr(md5(rand(0, 5)), 0, 10);
                $user->setPassword(Hash::make($random));

                $mail = new PHPMailer();
                $body = 'You have requested a new password<br><br>';
                $body .= 'Your new password is: ';
                $body .= $random;

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

                $address = Input::get('email');
                $mail->AddAddress($address, "user2");

                if ( ! $mail->Send()) {
                    echo "Mailer Error: " . $mail->ErrorInfo;
                } else {
                    Session::make('send', 'Your new password has been send!');
                }
            } else {
                Session::make('send', "this email doesn't exist in the database");
            }
        } else {
            $errors = true;
        }
    }
}

?>
<section class="register">
    <?php
    if (Session::exists('send')) {
        echo Session::get('send');
        Session::destroy('send');
    }
    ?>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
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

        <input type="submit" name="recover" value="Recover password"/>
    </form>
</section>
<?php
/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 20-1-2015
 * Time: 9:05
 */

?>
<h1>Home</h1>
<section>
    <h2>Welcome,
        <?php

        if (Session::exists('user')) {
            echo Session::get('user')->getUsername();

        }
        ?>
    </h2>

    <p>This is the page of Bart van Venrooij.</p>

    <p>On this page, you can find information about me, and the projects i have finished.</p>
</section>
<section>
    <h2>Busy with:</h2>

    <p>At the moment i am busy with programming in HTML, CSS, PHP and Java.</p>

    <p>With HTML, CSS and PHP i am busy with creating little websites and Object Orientated Programming.</p>

    <p>With Java i am currently busy with creating a program for saving and loading recipes.</p>
</section>
<section>
    <h2>Recently finished.</h2>

    <h3>HTML:</h3>

    <p>Project 2: Form</p>

    <p>In this project i have made a simple HTML form.</p>

    <p>This was made to receive information.</p>

    <p>This was a exercise for my education course Application and Media developer.</p>

    <h3>CSS:</h3>

    <p>Project 1: Stars</p>

    <p>In this project i have made a animation with only CSS</p>

    <p>This animation contains twinkling stars on the background of the page.</p>

    <p>This animation is infinite.</p>

    <h3>PHP:</h3>

    <p>Project 1: Portfolio Website</p>

    <p>This website is actually the first big project i have created with PHP.</p>

    <p>The websites includes: A dynamic website, Login System, Blog System and many more.</p>

    <h3>JAVA:</h3>

    <p>Project 1: Minecraft Mods</p>

    <p>In this project i am creating a modpack for Minecraft.</p>

    <p>This is not a finished project but everything of the mod on this website is working.</p>
</section>
<?php
/**
 * Created by PhpStorm.
 * User: Bart van Venrooij
 * Date: 20-1-2015
 * Time: 13:50
 */
?>
    <h1>Projects</h1>
    <section>
        <nav>
            <ul>
                <li><a href="?link=4&page=1">HTML</a></li>
                <li><a href="?link=4&page=2">CSS</a></li>
                <li><a href="?link=4&page=3">PHP</a></li>
                <li><a href="?link=4&page=4">Java</a></li>
                <li><a href="?link=4&page=5">Minecraft</a></li>
            </ul>
        </nav>
    </section>
    <section>
        <h2>Projects</h2>

        <p>This page contains information about my projects</p>
    </section>
<?php
if (Input::exists('get')) {
    Helper::getPage(Input::get('page'));
}
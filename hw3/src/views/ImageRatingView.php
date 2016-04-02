<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * ImageRatingView.php is the entry point for the Image Rating System
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\views;
require_once "View.php";

class ImageRatingView extends View {

    /**
     * Draw the web page to the browser
     */
    public function render($data) {
    ?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <title>Image Rating</title>
                <link href="./src/resources/favicon.ico" rel="shortcut icon" type="image/x-icon" />
                <link rel="stylesheet" href="./src/styles/views.css" type="text/css"/>
                <meta charset="utf-8"/>
                <meta name="author" content="Tyler Jones"/>
                <meta name="description" content="Image Rating entry page for CS174 Hw3"/>
            </head>
            <body>
                <h1 class="centered"><img src="./src/resources/logo.png" alt="Image Rating" /></h1>
                <?php if(true) { //(!$SESSION['login']) {
                ?>
                    <form method="post" action="index.php">
                        <input type="submit" class="buttonLink" name="signIn" value="Sign-in/Sign-up"/>
                    </form>
                <?php
                } elseif(false) {//($_SESSION['login']) {
                ?>
                    <p class="signedIn"> User #<br><?=$_SESSION['id'] ?> </p>
                <?php
                }
                if(true) {
                ?>
                    <form class="centered" method="post" action="index.php">
                        <label for="uploadLink">Do you have any images you would like to submit?</label>
                        <input type="submit" id="uploadLink" name="uploadImage" value="Upload an Image">
                    </form>
                <?php
                }
                ?>


            <div>
            a bunch<br> more stuff<br>
            </div>
            </body>
        </html>
    <?php
    }
}

<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * SignInView.php is the view for the sign in screen
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\views;
require_once "View.php";

class SignInView extends View {
    /**
     * Draw the web page to the browser
     */
    public function render($data) {
    ?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <title>Image Rating Sign In</title>
                <link href="./src/resources/favicon.ico" rel="shortcut icon" type="image/x-icon" />
                <link rel="stylesheet" href="./src/styles/views.css" type="text/css"/>
                <meta charset="utf-8"/>
                <meta name="author" content="Tyler Jones"/>
                <meta name="description" content="Image Rating Sign In page for CS174 Hw3"/>
            </head>
            <body>
                <h1 class="centered"><img src="./src/resources/logo.png" alt="Image Rating" /></h1>
                <p><a href="./src/views/CreateAccountView.php">Dont have an account yet?</a></p>
            </body>
        </html>
    <?php
    }
}

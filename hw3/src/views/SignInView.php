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
                <meta name="description" content="Sign In page for the Image Rating System"/>
            </head>
            <body>
                <h1><img src="./src/resources/logo.png" alt="Image Rating" /></h1>
                <form class="centered" id="loginForm" method="post" action="index.php">
                    <p>Sign In form for Image Rating</p>
                    <p><label for="emailField">Email:</label>
                    <input id="emailField" type="text" name="loginEmail"></p>
                    <p><label for="passwordField">Password:</label>
                    <input id="passwordField" type="password" name="loginPassword"></p>
                    <p><input type="submit" name="signIn" value="Login">
                    <input type="submit" name="return" value="Cancel"></p>
                    <p><label for="createAccountLink">Don't have an account yet?</label>
                    <input type="submit" id="createAccountLink" name="createAccount" value="Create Account"></p>
                </form>
                <?php
                if(isset($data['LOGIN_FAIL'])) {
                ?>
                    <p class="centered"> Incorrect Email or Password!!! Please try again :) </p>
                <?php
                }
                ?>
            </body>
        </html>
    <?php
    }
}


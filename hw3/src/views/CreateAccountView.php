<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * CreateAccountView.php is the view for the create account screen
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\views;
require_once "View.php";

class CreateAccountView extends View {
    /**
     * Draw the web page to the browser
     */
    public function render($data) {
    ?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <title>Image Rating Create Account</title>
                <link href="./src/resources/favicon.ico" rel="shortcut icon" type="image/x-icon" />
                <link rel="stylesheet" href="./src/styles/views.css" type="text/css"/>
                <meta charset="utf-8"/>
                <meta name="author" content="Tyler Jones"/>
                <meta name="description" content="Create Account page for the Image Rating System"/>
            </head>
            <body>
                <h1><img src="./src/resources/logo.png" alt="Image Rating" /></h1>
                <form class="centered" id="createAccountForm" method="post" action="index.php">
                    <p>Create a new account for Image Rating</p>
                    <p><label for="userNameField">Username:</label>
                    <input id="userNameField" type="text" name="createUserName"></p>
                    <p><label for="emailField">Email:</label>
                    <input id="emailField" type="text" name="createEmail"></p>
                    <p><label for="passwordField">Password:</label>
                    <input id="passwordField" type="password" name="createPassword"></p>
                    <p><label for="confirmPasswordField">Confirm Password:</label>
                    <input id="confirmPasswordField" type="password" name="confirmPassword"></p>
                    <p><input type="submit" name="createAccount" value="Submit">
                    <input type="submit" name="return" value="Cancel"></p>
                </form>
                <?php 
                if(isset($data['ACCOUNT_EXISTS'])) {
                ?>
                    <form class="centered" method="post" action="index.php">
                        <p> You already have an account with Image Rating! </p>
                        <label for="returnSignIn">Done creating accounts?</label>
                        <input type="submit" id="returnSignIn" name="signIn" value="Login">
                    </form>
                <?php
                } elseif(isset($data['ACCOUNT_NOT_CREATED']) && $data['ACCOUNT_NOT_CREATED']) {
                ?>
                    <p class="centered"> Something went wrong, please try again. </p>
                <?php
                }
                ?>
            </body>
        </html>
    <?php
    }
}

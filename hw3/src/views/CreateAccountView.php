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
                <meta name="description" content="Image Rating Create Account page for CS174 Hw3"/>
            </head>
            <body>
                <h1 class="centered"><img src="./src/resources/logo.png" alt="Image Rating" /></h1>
                <p class="centered">Create a new account for Image Rating</p>
                <form class="centered" id="createAccountForm" method="post">
                    <label for="userNameField">Username:</label>
                    <input id="userNameField" type="text" name="createUserName"><br>
                    <label for="emailField">Email:</label>
                    <input id="emailField" type="text" name="createEmail"><br>
                    <label for="passwordField">Password:</label>
                    <input id="passwordField" type="password" name="createPassword"><br>
                    <label for="confirmPasswordField">Confirm Password:</label>
                    <input id="confirmPasswordField" type="password" name="confirmPassword"><br>
                    <input type="submit" name="submitCreateAccount" value="Submit">
                </form>
                <?php 
                if(isset($data['ACCOUNT_CREATED'])) {
                ?>
                    <p class="centered"><?=$data['ACCOUNT_CREATED'] ?></p>
                <?php
                } elseif(isset($data['ACCOUNT_EXISTS'])) {
                ?>
                    <p class="centered"><?=$data['ACCOUNT_EXISTS'] ?></p>
                    <form class="centered" method="post" action="index.php">
                        <label for="returnSignIn">Done creating accounts?</label>
                        <input type="submit" id="returnSignIn" name="returnSignIn" value="Login">
                    </form>
                <?php
                } elseif(isset($data['ACCOUNT_NOT_CREATED'])) {
                ?>
                    <p class="centered"><?=$data['ACCOUNT_NOT_CREATED'] ?></p>
                <?php
                }
                ?>
            </body>
        </html>
    <?php
    }
}

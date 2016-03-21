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
                <div class="centered">
                    <h1><img src="./src/resources/logo.png" alt="Image Rating" /></h1>
                </div>
                <form action="">
                    <label for="uploadLink">Do you have any images you would like to submit?</label>
                    <input type="submit" id="uploadLink" name="uploadImage" value="Upload an Image">
                </form>
                <?php
                if(isset($_POST["uploadImage"])) {
                    //soloRider\hw3\controllers\ImageRatingController->processRequest();
                }
                ?>


        <form>
        <p><label for="e-mail">Please Enter An Email Address:</label>
        <input type="text" id="e-mail" name="email" max-size="40"/>
        <button type="submit">Check Email</button>
        </p>
        </form>
        <?php
        if (!empty($data['PREVIOUS_EMAIL'])) {
            ?>
            <p>The last email entered was:</p>
            <p><?=$data['PREVIOUS_EMAIL'] ?></p>
            <?php
            if (isset($data['PREVIOUS_EMAIL_VALID']) &&
                $data['PREVIOUS_EMAIL_VALID'] == true) {
                ?>
                <p>It was valid!</p>
                <?php
            } else {
                ?>
                <p>It was not valid!</p>
                <?php
            }
        }
        ?>




                <div class="right">
                    <p class="link"><br><a href="./src/views/SignInView.php">Sign-in/Sign-up</a></p>
                </div>
            </body>
        </html>
    <?php
    }
}

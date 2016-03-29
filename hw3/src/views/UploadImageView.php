<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * UploadImageView.php is the view for the upload an image screen
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\views;
require_once "View.php";

class UploadImageView extends View {

    /**
     * Draw the web page to the browser
     */
    public function render($data) {
    ?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <title>Image Rating Upload</title>
                <link href="./src/resources/favicon.ico" rel="shortcut icon" type="image/x-icon" />
                <link rel="stylesheet" href="./src/styles/views.css" type="text/css"/>
                <meta charset="utf-8"/>
                <meta name="author" content="Tyler Jones"/>
                <meta name="description" content="Upload page for the Image Rating System"/>
            </head>
            <body>
                <h1 class="centered"><img src="./src/resources/logo.png" alt="Image Rating" /></h1>
                <form class="centered" id="fileUploadForm" action="index.php" method="POST"
                        enctype="multipart/form-data">
                    <label for="fileUploadForm">File:
                    <input type="file" name="image">
                    <input type="submit" value="UPLOAD">
                </form>
            </body>
        </html>
    <?php
    }
}

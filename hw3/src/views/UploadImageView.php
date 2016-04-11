<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * UploadImageView.php is the view for the upload an image screen
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\views;
use soloRider\hw3\views\elements as E;
require_once(realpath(dirname(__FILE__) . '/elements/LogoutElement.php'));
require_once "View.php";

class UploadImageView extends View {
    private $logoutElement;

    /**
     * Constructor for UploadImageView is used to instanciate 
     * a LogoutElement object
     */
    public function __construct() {
        $this->logoutElement = new E\LogoutElement();
    }
    /**
     * Draw the web page to the browser
     */
    public function render($data) {
    ?>
        <!DOCTYPE html>
        <html lang="en">
            <head>
                <title>Image Rating Upload Image</title>
                <link href="./src/resources/favicon.ico" rel="shortcut icon" type="image/x-icon" />
                <link rel="stylesheet" href="./src/styles/views.css" type="text/css"/>
                <meta charset="utf-8"/>
                <meta name="author" content="Tyler Jones"/>
                <meta name="description" content="Upload Image page for the Image Rating System"/>
            </head>
            <body>
                <h1><img src="./src/resources/logo.png" alt="Image Rating" /></h1>
                <?php 
                $this->logoutElement->render($data);
                ?>
                <form class="centered" id="fileUploadForm" method ="post" enctype="multipart/form-data" action="index.php">
                    <p><label for="fileUpload">Select a File to Upload:</label>
                    <input id="fileUpload" type="file" name="imageFile"></p>
                    <p><label for="captionUpload">Add a caption to your image:</label>
                    <input id="captionUpload" type="text" name="imageCaption" maxlength="100"></p>
                    <p><input type="submit" name="uploadImage" value="UPLOAD"></p>
                </form>
                <div class="centered">
                    <?php
                    if(isset($data['UPLOADED_FILE'])) {
                    ?>
                        <p>The image you selected was: <?=$data['UPLOADED_FILE'] ?></p>
                    <?php
                    } elseif(!empty($data['UPLOADED_FILE'])) {
                    ?>
                        <p>You did not select a valid file. Please try again.</p>
                    <?php
                    }
                    if(isset($data['UPLOAD_SUCCESS']) && ($data['UPLOAD_SUCCESS'])) {
                    ?>
                        <p>The uploaded file is a valid JPEG file and was successfully uploaded!</p>
                    <?php
                    } elseif(!empty($data['UPLOADED_FILE'])) {
                    ?>
                        <p>The uploaded file was not a valid JPEG file, please try again with a valid JPEG file.</p>
                    <?php
                    }
                    ?>
                    <br>
                    <form class="centered" method="post" action="index.php">
                        <p><label for="returnButton">Done uploading images?</label>
                        <input type="submit" id="returnButton" name="return" value="Return"></p>
                    </form>
                </div>
            </body>
        </html>
    <?php
    }
}

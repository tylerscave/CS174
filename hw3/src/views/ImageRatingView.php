<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * ImageRatingView.php is the entry point for the Image Rating System
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\views;
use soloRider\hw3\views\helpers as H;
use soloRider\hw3\views\elements as E;
require_once(realpath(dirname(__FILE__) . '/helpers/ImagesHelper.php'));
require_once(realpath(dirname(__FILE__) . '/elements/LogoutElement.php'));
require_once "View.php";

class ImageRatingView extends View {
    private $imagesHelper;
    private $logoutElement;

    /**
     * Constructor for ImageRatingView is used to instanciate 
     * an ImagesHelper object and LogoutElement object
     */
    public function __construct() {
        $this->imagesHelper = new H\ImagesHelper();
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
                <title>Image Rating</title>
                <link href="./src/resources/favicon.ico" rel="shortcut icon" type="image/x-icon" />
                <link rel="stylesheet" href="./src/styles/views.css" type="text/css"/>
                <meta charset="utf-8"/>
                <meta name="author" content="Tyler Jones"/>
                <meta name="description" content="Image Rating Home Page"/>
            </head>
            <body>
                <h1><img src="./src/resources/logo.png" alt="Image Rating" /></h1>
                <?php 
                if(isset($data['ID'])) {
                    $this->logoutElement->render($data);
                ?>
                    <form class="centered" method="post" action="index.php">
                        <label for="uploadLink">Do you have any images you would like to submit?</label>
                        <input type="submit" id="uploadLink" name="uploadImage" value="Upload an Image">
                    </form>
                <?php
                } else {
                ?>
                    <form method="post" action="index.php">
                        <input type="submit" class="buttonLink" name="signIn" value="Sign-in/Sign-up"/>
                    </form>
                <?php
                }
                ?>
                <div class="section">
                    <h2><img src="./src/resources/recentLogo.png" alt="Recent" /></h2>
                    <?php
                    $this->imagesHelper->getImages("recents", isset($data['ID']) ? $data['ID'] : null);
                    ?>
                </div>
                <div class="section">
                    <h2><img src="./src/resources/popularityLogo.png" alt="Popularity" /></h2>
                    <?php
                    $this->imagesHelper->getImages("popularity", isset($data['ID']) ? $data['ID'] : null);
                    ?>
                </div>
            </body>
        </html>
    <?php
    }
}

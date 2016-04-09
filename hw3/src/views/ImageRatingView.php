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
                <?php 
                if(isset($_SESSION['ID'])) {
                ?>
                    <form method="post" action="index.php">
                        <input type="submit" class="buttonLink" name="logout" value="Log Out"/>
                    </form>
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
                <div class="recent">
                    <h2 class="centered"><img src="./src/resources/recentLogo.png" alt="Recent" /></h1>
<?php
for ($i = 0; $i < sizeof($data); $i++) {
?>
                    <div class="framed">
                        <p><img src="./src/resources/images/<?=$data[$i]['FILE'] ?>" alt="image" /></p>
                        <p>Caption: <?=$data[$i]['CAPTION'] ?></p>
                        <p>Uploaded by: <?=$data[$i]['USERNAME'] ?></p>
                        <p>Uploaded: <?=$data[$i]['DATE'] ?></p>
                        <p>Rating: <?=$data[$i]['RATING'] ?></p>
                        <?php 
                        if(isset($_SESSION['ID'])) {
                        ?>
                            <label for="ratingDrop">Rate this image </lable>
                            <select name="ratingDrop">
                                <option value="5">5</option>
                                <option value="4">4</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select>
                        <?php
                        }
                        ?>
                    </div>
<?php
}
?>
                </div>
                <div class="popularity">
                    <h2 class="centered"><img src="./src/resources/popularityLogo.png" alt="Popularity" /></h1>
                </div>
            </body>
        </html>
    <?php
    }
}

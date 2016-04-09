<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * ImageDisplayHelper.php is the helper to dynamically display images and attributes
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\views\helpers;
use soloRider\hw3\models as B;
require_once(realpath(dirname(__FILE__) . '/../models/ImageModel.php'));
require_once(realpath(dirname(__FILE__) . '/../ImageRatingView.php'));
require_once "Helper.php";

class ImageDisplayHelper extends Helper {
    private view;
    private imageModel;

    public function __construct() {
        $this->view = new ImageRatingView();
        $this->imageModel = new B\ImageModel();
    }

    /**
     * Draw the web page to the browser
     */
    public function render($data) {
foreach($data as $image) {
?>
                        <p><img src="./src/resources/images/<?=$data['FILE'] ?>" alt="image" /></p>
                        <p>Caption: <?=$image['CAPTION'] ?></p>
                        <p>Uploaded by: <?=$image['USERNAME'] ?></p>
                        <p>Uploaded: <?=$image['DATE'] ?></p>
                        <p>Rating: <?=$image['RATING'] ?></p>
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
}
    }

    public function getRecents() {
        $recentImages = [];
        $allRecents = [];
        $recents = $this->imageModel->getRecentImages();
        $i = 1;
        foreach($recents as $imageData) {
            //$file = "FILE" . $i;
            //$caption = "CAPTION" . $i;
            //$userName = "USERNAME" . $i;
            //$rating = "RATING" . $i;
            //$date = "DATE" . $i;
            //$recentImages[$file] = $imageData['fileName'];
            //$recentImages[$caption] = $imageData['caption'];
            //$recentImages[$userName] = $imageData['userName'];
            //$recentImages[$rating] = $imageData['rating'];
            //$recentImages[$date] = $imageData['timeUploaded'];

            $recentImages['FILE'] = $imageData['fileName'];
            $recentImages['CAPTION'] = $imageData['caption'];
            $recentImages['USERNAME'] = $imageData['userName'];
            $recentImages['RATING'] = $imageData['rating'];
            $recentImages['DATE'] = $imageData['timeUploaded'];
$allRecents[$i] = $recentImages;
            $i++;
        }
        //return $allRecents;
$this->render($allRecents);
    }
}


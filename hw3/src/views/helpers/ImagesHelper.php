<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * ImagesHelper.php is the helper to dynamically display images and attributes
 * for the recents and popularity section
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\views\helpers;
use soloRider\hw3\models as B;
require_once "Helper.php";

class ImagesHelper extends Helper {
    private $imageModel;

    public function __construct() {
        $this->imageModel = new B\ImageModel();
    }

    /**
     * Draw the web page to the browser
     */
    public function render($data) {
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
    }

    public function getImages($type) {
        $data = [];
        if($type == "recents") {
            $images = $this->imageModel->getRecentImages();
        } elseif($type == "popularity") {
            $images = $this->imageModel->getPopularImages();
        }
        $i = 0;
        foreach($images as $imageData) {
            $allImages = [];
            $allImages['FILE'] = $imageData['fileName'];
            $allImages['CAPTION'] = $imageData['caption'];
            $allImages['USERNAME'] = $imageData['userName'];
            $allImages['RATING'] = $imageData['rating'];
            $allImages['DATE'] = $imageData['timeUploaded'];
            $data[$i] = $allImages;
            $i++;
        }
        $this->render($data);
    }
}


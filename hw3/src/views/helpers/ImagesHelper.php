<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * ImagesHelper.php is the helper to dynamically display images and attributes
 * for the recents and popularity section of the Image Rating System
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\views\helpers;
use soloRider\hw3\models as B;
require_once "Helper.php";

class ImagesHelper extends Helper {
    private $imageModel;

    /**
     * Constructor for ImagesHelper is used to instanciate 
     * a ImageModel object
     */
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
                if(isset($_SESSION['ID']) && !($data[$i]['VOTED'])) {
                ?>
                    <form name="dropDownForm" method="post">
                        <p><label for="dropDownForm">Rate this image </lable>
                        <select name="dropDown">
                            <option value="<?=$data[$i]['FILE'] ?>:5">5</option>
                            <option value="<?=$data[$i]['FILE'] ?>:4">4</option>
                            <option value="<?=$data[$i]['FILE'] ?>:3">3</option>
                            <option value="<?=$data[$i]['FILE'] ?>:2">2</option>
                            <option value="<?=$data[$i]['FILE'] ?>:1">1</option>
                        </select>
                        <input type="submit" name="rateImage" value="Submit Rating"></p>
                    </form>
                <?php
                } elseif(isset($_SESSION['ID'])) {
                ?>
                    <p>You've already rated this image </p>
                <?php
                }
                ?>
            </div>
        <?php
        }
    }

    /**
     * getImages is used to create session data for the stored
     * images and their attributes. This data is used to render
     * the images to the screen
     */
    public function getImages($type, $id) {
        $data = [];
        //determine if the request is for the recents or popularity section
        if($type == "recents") {
            $images = $this->imageModel->getRecentImages();
        } elseif($type == "popularity") {
            $images = $this->imageModel->getPopularImages();
        }
        
        //store stored data in the data array for use in this session
        $i = 0;
        foreach($images as $imageData) {
            $allImages = [];
            $fileName = $imageData['fileName'];
            $allImages['FILE'] = $fileName;
            $allImages['CAPTION'] = $imageData['caption'];
            $allImages['USERNAME'] = $imageData['userName'];
            $allImages['RATING'] = $imageData['rating'];
            $allImages['DATE'] = $imageData['timeUploaded'];
            $allImages['VOTED'] = $this->imageModel->checkVotes($id, $fileName);
            $data[$i] = $allImages;
            $i++;
        }
        // render the images to the correct view
        $this->render($data);
    }
}


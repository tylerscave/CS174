<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * LogoutElement.php is responsible for drawing only 
 * the logout form which may be found on multiple pages
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\views\elements;
require_once "Element.php";

class LogoutElement extends Element {

    /**
     * render will render the html to the screen
     */
    public function render($data) {
    ?>
        <form method="post" action="index.php">
           <input type="submit" class="buttonLink" name="logout" value="Log Out"/>
        </form>
    <?php
    }
}

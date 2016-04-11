<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * Helper.php is the base class for all Helpers used in
 * the Image Rating System
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\views\helpers;

/**
 * Base class for all helpers used in hw3
 */
abstract class Helper {
    /**
     * This method should be overriden
     */
    public abstract function render($data);
}

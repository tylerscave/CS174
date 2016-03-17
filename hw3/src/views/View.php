<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * View.php
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\views;

/**
 * Base class for all views used in hw3
 */
abstract class View
{
    /**
     * This method should be overriden to draw a web page to the browser
     */
    public abstract function render($data);
}

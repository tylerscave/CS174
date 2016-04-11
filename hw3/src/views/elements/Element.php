<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * Element.php is the base class for all Elements used in hw3
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\views\elements;

abstract class Element {

    /**
     * This method should be overriden
     */
    public abstract function render($data);
}

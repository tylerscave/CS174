<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * Helper.php
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\views\helpers;

/**
subclasses of Helper are used to output common widgets which may appear on views or elements and may require iterating over data in an array to output. For example, outputting a select tag dropdown with many options coming from a field in $data. Another example might be to output the rows of a table based on an field from $data. The Helper base class should also have an abstract method public abstract method render($data). Only views and elements are allowed to instantiate helpers. The render method of a helper is allowed to use looping.
*/ 

/**
 * Base class for all helpers used in hw3
 */
abstract class Helper
{
    /**
     * This method should be overriden
     */
    public abstract function render($data);
}

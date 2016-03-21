<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * Element.php
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3\views\elements;

/*
 A subclass Element is used to encapsulate a reusable fragment of a webpage (for example, a signin form) which might appear on multiple views. The base class should have a public field $view which is initialized in the base constructor to point to the view the element is currently on. The base Element class should also have an public abstract method render($data). A subclass of Controller is not allowed to directly instantiate a subclass of Element, but a subclass of View can. As with views, elements are allowed method calls and if-elseif-else constructs, but no looping.
*/

/**
 * Base class for all Elements used in hw3
 */
abstract class Element {

    public $view

    public function __construct(View $view) {
        $this->view = $view;
    }
    /**
     * This method should be overriden
     */
    public abstract function render($data);
}

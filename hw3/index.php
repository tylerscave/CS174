<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * index.php is the entry point for hw3
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3;
require_once "src/controllers/ImageRatingController.php";

// defines for various namespaces
define("NS_BASE", "soloRider\\hw3\\");
define(NS_BASE . "NS_CONTROLLERS", "soloRider\\hw3\\controllers\\");
define(NS_BASE . "NS_VIEWS", "soloRider\\hw3\\views\\");
define(NS_BASE . "NS_ELEMENTS", "soloRider\\hw3\\views\\elements\\");
define(NS_BASE . "NS_HELPERS", "soloRider\\hw3\\views\\helpers\\");
define(NS_BASE . "NS_MODELS", "soloRider\\hw3\\models\\");
define(NS_BASE . "NS_CONFIGS", "soloRider\\hw3\\configs\\");

$allowed_controllers = ["ImageRating"];
//determine controller for request
if (!empty($_REQUEST['c']) && in_array($_REQUEST['c'], $allowed_controllers)) {
    $controller_name = NS_CONTROLLERS . ucfirst($_REQUEST['c']). "Controller";
} else {
    $controller_name = NS_CONTROLLERS . "ImageRatingController";
}
//instatiate controller for request
$controller = new $controller_name();
//process request
$controller->processRequest();

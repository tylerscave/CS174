<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * index.php is the entry point for hw3
 * Solves CS174 Hw3
 * @author Tyler Jones
*/
namespace soloRider\hw3;
session_start();
require_once "src/controllers/ImageRatingController.php";
require_once "src/controllers/SignInController.php";
require_once "src/controllers/CreateAccountController.php";
require_once "src/controllers/UploadImageController.php";

// defines for various namespaces
define("NS_BASE", "soloRider\\hw3\\");
define(NS_BASE . "NS_CONTROLLERS", "soloRider\\hw3\\controllers\\");
define(NS_BASE . "NS_VIEWS", "soloRider\\hw3\\views\\");
define(NS_BASE . "NS_ELEMENTS", "soloRider\\hw3\\views\\elements\\");
define(NS_BASE . "NS_HELPERS", "soloRider\\hw3\\views\\helpers\\");
define(NS_BASE . "NS_MODELS", "soloRider\\hw3\\models\\");
define(NS_BASE . "NS_CONFIGS", "soloRider\\hw3\\configs\\");

$allowed_controllers = ["ImageRating", "UploadImage", "SignIn", "CreateAccount"];
//determine controller for request
if (!empty($_REQUEST['c']) && in_array($_REQUEST['c'], $allowed_controllers)) {
    $controller_name = NS_CONTROLLERS . ucfirst($_REQUEST['c']). "Controller";
} elseif (isset($_REQUEST['logout'])) {
    $controller_name = NS_CONTROLLERS . "ImageRatingController";
} elseif (isset($_SESSION['id']) && (isset($_REQUEST['login']))) {
    $controller_name = NS_CONTROLLERS . "ImageRatingController";
} elseif (isset($_REQUEST['signIn']) || (isset($_REQUEST['login']))) {
    $controller_name = NS_CONTROLLERS . "SignInController";
} elseif (isset($_REQUEST['createAccount']) || isset($_REQUEST['submitCreateAccount'])) {
    $controller_name = NS_CONTROLLERS . "CreateAccountController";
} elseif (isset($_REQUEST['uploadImage']) || isset($_REQUEST['imageFile'])) {
    $controller_name = NS_CONTROLLERS . "UploadImageController";
} else {
    $controller_name = NS_CONTROLLERS . "ImageRatingController";
}
//instatiate controller for request
$controller = new $controller_name();
//process request
$controller->processRequest();

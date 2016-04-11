<?php
/**
 *COPYRIGHT (C) 2016 Tyler Jones. All Rights Reserved.
 * Config.php has constants for things like database user, password, host, port, etc.
 * The owner of this software should fill in correct values for their specific server.
 * This currently defines default values based on system information
 * Solves CS174 Hw3
 * @author Tyler Jones
*/

define ('DB', 'imageRating');
define ('USER', ini_get("mysqli.default_user"));
define ('PWD', ini_get("mysqli.default_password"));
define ('HOST', ini_get("mysqli.default_host"));
define ('PORT', ini_get("mysqli.default_port"));


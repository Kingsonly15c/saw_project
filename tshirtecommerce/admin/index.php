<?php
/**
 * @author tshirtecommerce - www.tshirtecommerce.com
 * @date: 2015-01-10
 * 
 * @copyright  Copyright (C) 2015 tshirtecommerce.com. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 *
 */
error_reporting(0);
ini_set("memory_limit", -1);
date_default_timezone_set('America/Los_Angeles');
define('ROOT', dirname(__FILE__));
define('DS', DIRECTORY_SEPARATOR);
define( 'DEVELOPER', 0);

include_once ROOT .DS. 'includes' .DS. 'functions.php';
include_once ROOT .DS. 'includes' .DS. 'controllers.php';

if( file_exists(ROOT .DS. 'session.php') )
{
	include_once ROOT .DS. 'session.php';
}

$controller = new Controllers();
$controller->load();

?>
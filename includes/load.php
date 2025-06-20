<?php
$timezone_identifier = "Asia/Kolkata";
date_default_timezone_set($timezone_identifier);

defined('DS') ? null : define('DS', DIRECTORY_SEPARATOR);
defined('SITE_ROOT') ? null : define ('SITE_ROOT', $_SERVER['DOCUMENT_ROOT'].DS.'getwetfit_final/getwetfit');
defined('LIB_PATH') ? null : define ('LIB_PATH',SITE_ROOT.DS.'includes');

require_once(LIB_PATH.DS."config.php");
require_once(LIB_PATH.DS."function.php");
require_once(LIB_PATH.DS."session.php");

$session = new Session();
$msg = $session->getFlashMessage();

?>
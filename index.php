<?php
error_reporting(E_ALL & ~E_DEPRECATED & ~E_STRICT);
session_start();

require_once('./lib/liteframework/Application.php');

$app = Application::getInstance();
$app->setAppPath('./app');
$app->setLibPath('./lib');

require_once('DataAccessConfig.php');

$config = &DataAccessConfig::getInstance(); 
$config->setParams(array('host' => 'localhost',	'user' => 'root',	'password' => '',	'db' => 'wish'));

$app->processPost();

$app->run();


?>
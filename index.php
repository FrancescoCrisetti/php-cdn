<?php 

error_reporting(E_ALL);

try {

	define('BASE_PATH', __DIR__);
	define('APP_PATH', BASE_PATH . '/app');
	define('_EXEC', 1);

	include APP_PATH . "/config/register.php";
	
	$app = new Application();
	echo $app->render();
	
} catch (Exception $e) {
	echo $e->getMessage(), '<br>';
	echo nl2br(htmlentities($e->getTraceAsString()));
}
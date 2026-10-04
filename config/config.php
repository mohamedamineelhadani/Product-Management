<?php
define("ROOT",dirname(__DIR__));

define("IS_LOCALHOST", in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1']));
define("SSL", !IS_LOCALHOST);
define("DOMAIN", $_SERVER['HTTP_HOST']);

define("FILE_NAME", IS_LOCALHOST ? basename(ROOT) : "");

define("DEBUG", true);
ini_set("display_errors", DEBUG ? 1 : 0);
error_reporting(DEBUG ? E_ALL : 0);


$protocol = SSL ? "https" : "http";
$docRoot = str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']));
$projectRoot = str_replace('\\', '/', realpath(ROOT));
$basePath = str_replace($docRoot, '', $projectRoot);


define("START_URL", "$protocol://" . DOMAIN . $basePath . "/");
define("BASE_URL", "$protocol://" . DOMAIN . $basePath . "/products/index.php");
define("ASSETS_URL", "$protocol://" . DOMAIN . $basePath . "/assets/");


define("ADMIN_NAME", "Mohamed Amine El Hadani");
define("ADMIN_EMAIL", "elhadanimohamedamine@gmail.com");

?>
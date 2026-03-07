<?php
define("ROOT",dirname(__DIR__));

define("IS_LOCALHOST", in_array($_SERVER['HTTP_HOST'], ['localhost', '127.0.0.1']));
define("SSL", !IS_LOCALHOST);
define("DOMAIN", $_SERVER['HTTP_HOST']);

define("FILE_NAME", IS_LOCALHOST ? "product_mangment" : "");

define("DEBUG", true);
ini_set("display_errors", DEBUG ? 1 : 0);
error_reporting(DEBUG ? E_ALL : 0);


$protocol = SSL ? "https" : "http";
$basePath = IS_LOCALHOST ? "/" . FILE_NAME : "";

define("START_URL", "$protocol://" . DOMAIN . $basePath . "/");
define("BASE_URL", "$protocol://" . DOMAIN . $basePath . "/products/index.php");
define("ASSETS_URL", "$protocol://" . DOMAIN . $basePath . "/assets/");

define("ADMIN_NAME", "Mohamed Amine El Hadani");
define("ADMIN_EMAIL", "elhadanimohamedamine@gmail.com");

?>

<?php

require_once dirname(__DIR__)."/config/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = ucfirst($_POST["category"]);

    $file = file_get_contents(ASSETS_URL."json/categories.json");
    $json = json_decode($file,true);
    array_push($json["categories"],$name);

    file_put_contents(ASSETS_URL."json/categories.json",json_encode($json,JSON_PRETTY_PRINT));
    header("location:index.php");
}
?>
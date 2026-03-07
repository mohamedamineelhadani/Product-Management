<?php
$index = $_GET["index"];



$file = file_get_contents("categories.json");
$json = json_decode($file,true);
unset($json["categories"][$index]);

file_put_contents("categories.json",json_encode($json,JSON_PRETTY_PRINT));
header("location:index.php");
?>
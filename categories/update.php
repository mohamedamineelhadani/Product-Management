<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = $_POST["index"];
    $name = $_POST["name"];

    $file = file_get_contents("categories.json");
    $json = json_decode($file,true);
    $json["categories"][$index] = $name;

    file_put_contents("categories.json",json_encode($json,JSON_PRETTY_PRINT));
    header("location:index.php");
}
?>
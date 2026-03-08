<?php
require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/config/db.php";
require_once dirname(__DIR__)."/middleware/auth.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$name = ucfirst($_POST["name"]);
$categoryId = intval($_POST["categoryId"]);

$updateCategory = "UPDATE categories SET name ='$name' WHERE id ='$categoryId' AND user_id = '$id' ";

if (mysqli_query($conn, $updateCategory)) {
    header("location:index.php");
}
?>
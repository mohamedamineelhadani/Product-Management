<?php
require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/config/db.php";
require_once dirname(__DIR__)."/middleware/auth.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$name = ucfirst($_POST["category"]);
$addCategory = "INSERT INTO categories (user_id,name) VALUES ('$id','$name')";

if (mysqli_query($conn, $addCategory)) {
    header("location:index.php");
}
?>
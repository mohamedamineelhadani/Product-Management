<?php
require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/config/db.php";
require_once dirname(__DIR__)."/middleware/auth.php";

$categoryId = intval($_GET["categoryId"]);

if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    header("Location: index.php");
    exit;
}
$deleteCategory = "DELETE FROM categories WHERE  user_id = '$id' AND id ='$categoryId'";

if (mysqli_query($conn, $deleteCategory)) {
    header("location:index.php");
}
?>
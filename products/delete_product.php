<?php
require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/config/db.php";
require_once dirname(__DIR__)."/middleware/auth.php";


if (isset($_GET['productId'])) {
    $productId = intval($_GET['productId']);
    
    $uploadDir = ROOT."/assets/images/";
    $getImage = "SELECT image FROM products WHERE id = '$productId' AND user_id = '$id'";
    $resImage = mysqli_query($conn, $getImage);
    $image = mysqli_fetch_assoc($resImage);
    $imagePath = $uploadDir.$image["image"];

    if ($oldImage && file_exists($imagePath)) {
        unlink($imagePath);
    }
    

    $deleteProduct = "DELETE FROM products WHERE id = '$productId' AND user_id ='$id'";
    if (mysqli_query($conn, $deleteProduct)) {
        header("Location: index.php");
        exit;
    } else {
        die("Error deleting product: " . mysqli_error($conn));
    }
} else {
    header("Location: index.php");
    exit;
}
?>
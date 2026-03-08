<?php

require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/config/db.php";
require_once dirname(__DIR__)."/middleware/auth.php";

$uploadDir = ROOT."/assets/images/";
$getAllImages = "SELECT image FROM products WHERE user_id = '$id'";
$resAllImages = mysqli_query($conn, $getAllImages);
if($resAllImages){
    while($image = mysqli_fetch_assoc($resAllImages)){
        $imagePath = $uploadDir.$image["image"];
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
    };
};

$deleteUser = "DELETE FROM users WHERE id ='$id'";

if(mysqli_query($conn,$deleteUser)){
    session_unset();
    session_destroy();

    header("Location:".START_URL."auth/login.php");
    exit();
}
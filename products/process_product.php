<?php
require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/config/db.php";
require_once dirname(__DIR__)."/middleware/auth.php";


function safe($field){
    return htmlspecialchars(trim($field), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$productId   = intval($_POST['id'] ?? 0);
$name        = safe($_POST['name'] ?? '');
$name_ar     = safe($_POST['name_ar'] ?? '');
$other_names = safe($_POST['other-names'] ?? '');
$description = safe($_POST['description'] ?? '');
$post        = safe($_POST['post'] ?? '');
$price       = floatval($_POST['price'] ?? 0);
$category    = intval($_POST['category'] ?? 0);
$quantity    = intval($_POST['quantity'] ?? 0);
$status      = strtolower(str_replace(" ", "_", safe($_POST['status'] ?? '')));
$image = "default.png";



if (!empty($_FILES['image']['name']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {

    $uploadDir = ROOT."/assets/images/";

    $getOldImage = "SELECT image FROM products WHERE id = '$productId' AND user_id = '$id'";
    $resOldImage = mysqli_query($conn, $getOldImage);
    $oldImage = mysqli_fetch_assoc($resOldImage);
    $oldImagePath = $uploadDir.$oldImage["image"];

    if ($oldImage && file_exists($oldImagePath)) {
        unlink($oldImagePath);
    }

    $ext = strtolower(pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION));

    $check = getimagesize($_FILES['image']['tmp_name']);

    if ($check !== false) {

        $image = uniqid() . "." . $ext;

        move_uploaded_file(
            $_FILES['image']['tmp_name'],
            $uploadDir . $image
        );
    }

}


if ($productId > 0 && $image === "default.png") {

    $sql = "SELECT image FROM products WHERE id = '$productId'";
    $res = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($res)) {
        $image = $row['image'];
    }

}


if ($productId > 0) {

    $query = "
        UPDATE products SET
        category_id = '$category',
        name = '$name',
        name_ar = '$name_ar',
        other_names = '$other_names',
        description = '$description',
        price = $price,
        quantity = $quantity,
        status = '$status',
        post = '$post',
        image = '$image'
        WHERE id = '$productId'
    ";

} else {

    $query = "
        INSERT INTO products
        (category_id,user_id,name,name_ar,other_names,description,price,quantity,status,image,post)
        VALUES
        ('$category','$id','$name','$name_ar','$other_names','$description',$price,$quantity,'$status','$image','$post')
    ";

}


if (mysqli_query($conn, $query)) {

    $redirectId = $productId > 0
        ? $productId
        : mysqli_insert_id($conn);

    header("Location: view_product.php?productId=".$redirectId);
    exit;

}

die("Database Error: " . mysqli_error($conn));
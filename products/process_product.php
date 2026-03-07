<?php
include '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $name_fr = mysqli_real_escape_string($conn, $_POST['name_fr']);
    $name_ar = mysqli_real_escape_string($conn, $_POST['name_ar']);
    $other_names = mysqli_real_escape_string($conn, $_POST['other-names']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $price = floatval($_POST['price']);
    $category = mysqli_real_escape_string($conn, strtolower($_POST['category']));
    $quantity = intval($_POST['quantity']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $status = strtolower($status);
    $status = str_replace(" ","_",$status);
    $post = mysqli_real_escape_string($conn, $_POST['post']);
    
    $image = 'default.png';
    if (isset($_FILES['image']) && $_FILES['image']['error'] == UPLOAD_ERR_OK) {
        $target_dir = "../assets/images/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $image = uniqid() . '.' . $imageFileType;
            $target_file = $target_dir . $image;
            
            move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
        }
    } elseif ($id > 0) {
        $query = "SELECT image FROM products WHERE id = $id";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $image = $row['image'];
    }
    
    if ($id > 0) {
        $query = "UPDATE products SET 
                  name_fr = '$name_fr', 
                  name_ar = '$name_ar',
                  other_names ='$other_names',
                  description = '$description', 
                  price = $price, 
                  category = '$category', 
                  quantity = $quantity, 
                  status = '$status',
                  post = '$post',
                  image = '$image' 
                  WHERE id = $id";
    } else {
        $query = "INSERT INTO products (name_fr, name_ar,other_names, description, price, category, quantity, status, image,post) 
                  VALUES ('$name_fr', '$name_ar', '$other_names', '$description', $price, '$category', $quantity, '$status', '$image','$post')";
    }
    
    if (mysqli_query($conn, $query)) {
        $redirect_id = $id > 0 ? $id : mysqli_insert_id($conn);
        header("Location: view_product.php?id=$redirect_id");
        exit;
    } else {
        die("Error: " . mysqli_error($conn));
    }
} else {
    header("Location: index.php");
    exit;
}
?>
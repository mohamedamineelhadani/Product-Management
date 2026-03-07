<?php
include '../config/db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    
    $query = "SELECT image FROM products WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    
    if ($row && !empty($row['image'])) {
        $image_path = "../assets/images/" . $row['image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }
    }
    

    $query = "DELETE FROM products WHERE id = $id";
    if (mysqli_query($conn, $query)) {
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
<?php
require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/config/db.php";
require_once dirname(__DIR__)."/middleware/auth.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="<?= ASSETS_URL."css/style.css" ?>">
</head>
<body>
    <header>
        <div class="logo">
            <h1 onclick="window.location.href='<?= BASE_URL ?>'">Product Management</h1>
        </div>
        <nav>
            <ul class="dropdown-menu">
                <li>
                    <a href="#">Categories</a>
                    <ul class="submenu">
                        <li><a href="<?=BASE_URL."?category=all"?>">all</a></li>
                        <?php
                            $getCategories = "SELECT * FROM categories WHERE user_id = '$id'";
                            $resCategories = mysqli_query($conn,$getCategories);
                        ?>

                        <?php if(mysqli_num_rows($resCategories) >= 0) :?>
                            <?php while($category = mysqli_fetch_assoc($resCategories)) :?>
                                <li><a href="<?=BASE_URL."?category={$category["name"]}"?>"><?= $category["name"] ?></a></li>
                            <?php endwhile ;?>
                        <?php endif; ?>
                    </ul>
                </li>
                <li><a href="<?= START_URL."categories/index.php" ?>">Edit Categories</a></li>
                <li><a href="<?= START_URL."products/add_product.php" ?>">Add Product</a></li>
                <li><a href="<?= START_URL."profile/index.php" ?>">Profile</a></li>
                <li><a href="<?= START_URL."auth/logout.php" ?>">Logout</a></li>
            </ul>
        </nav>
    </header>
    <main>
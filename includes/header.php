<?php
require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/middleware/auth.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href=<?= ASSETS_URL."css/style.css" ?>>
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
                        <?php
                            $file = file_get_contents(ASSETS_URL."json/categories.json");
                            $json = json_decode($file,true);
                            $categories = $json["categories"];
                            foreach ($categories as $index => $value) {
                                echo "<li title=\"$index\"><a href=\"".BASE_URL."?category=$value\">$value</a></li>";
                            }
                        ?>
                    </ul>
                </li>
                <li><a href=<?= START_URL."categories/index.php" ?>>Edit Categories</a></li>
                <li><a href=<?= START_URL."products/add_product.php" ?>>Add Product</a></li>
                <li><a href=<?= START_URL."orders/index.php" ?>>Orders</a></li>
            </ul>
        </nav>
    </header>
    <main>
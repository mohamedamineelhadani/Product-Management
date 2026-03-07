<?php require_once "../config/db.php" ; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering System</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .container {
            display: flex;
            max-width: 1200px;
            margin: 0 auto;
            gap: 20px;
            padding: 20px;
        }

        /* Left Side - Menu */
        .menu-section {
            flex: 2;
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .menu-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
        }

        .menu-header h2 {
            background: #f0f0f0;
            padding: 8px 15px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: normal;
        }

        /* Category Tabs */
        .category-tabs {
            display: flex;
            gap: 10px;
            margin-bottom: 30px;
            flex-wrap: wrap;
        }

        .tab {
            background: #007bff;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.3s;
        }

        .tab:hover {
            background: #0056b3;
        }

        .tab.active {
            background: #0056b3;
        }

        /* Menu Grid */
        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 20px;
        }

        .menu-item {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s;
        }

        .menu-item:hover {
            transform: translateY(-2px);
        }

        .menu-item img {
            width: 100%;
            height: 120px;
            object-fit: cover;
        }

        .item-info {
            padding: 10px;
            text-align: center;
        }

        .item-name {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        .availability {
            background: #28a745;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            display: inline-block;
        }
        .none {
            background: #f30f0fff;
            color: white;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 12px;
            display: inline-block;
        }

        /* Right Side - Order Summary */
        .order-section {
            flex: 1;
            min-width: 300px;
        }

        .order-card {
            background: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }


        .order-card h3 {
            font-size: 18px;
            color: #333;
        }


        .order-item {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr auto;
            gap: 10px;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .order-item-name {
            font-size: 14px;
            color: #333;
        }

        .qty-input {
            width: 40px;
            padding: 4px;
            border: 1px solid #ddd;
            border-radius: 3px;
            text-align: center;
        }

        .price {
            font-size: 14px;
            color: #333;
        }

        .remove-btn {
            background: #dc3545;
            color: white;
            border: none;
            width: 20px;
            height: 20px;
            border-radius: 3px;
            cursor: pointer;
            font-size: 12px;
        }



        .pay-btn {
            width: 100%;
            background: #28a745;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 5px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 20px;
        }

        .pay-btn:hover {
            background: #218838;
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
            }
            
            .menu-grid {
                grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="menu-section">
            <div class="menu-header">
                <h2>Category</h2>
            </div>

            <div class="category-tabs">
                <?php 
                    $category = $_GET["category"] ?? null;
                    $file = file_get_contents("../assets/json/categories.json");
                    $json = json_decode($file,true);
                    $categories = $json["categories"];
                    foreach ($categories as $index => $value) {
                        echo "<a href=\"index.php?category=$value\" class=\"tab ".(($category == $value && $_GET["category"] != null ) ? "active" : "" )."\">$value</a>";
                    }
                ?>
            </div>

            <div class="menu-grid">
                <?php
                    $query = "SELECT * FROM products WHERE 1=1";
                    if ($category != 'All' && $category != null) {
                        $query .= " AND category = '$category'";
                    }
                    $result = mysqli_query($conn, $query);
                ?>

                <?php if (mysqli_num_rows($result) > 0): ?>
                    <?php while($row = mysqli_fetch_assoc($result)):?>
                        <div class="menu-item">
                            <img src="../assets/images/<?= $row['image'] ?: 'default.png'; ?>" alt="<?=$row['name_fr'];?>">
                            <div class="item-info">
                                <div class="item-name"><?=$row['name_fr'];?></div>
                                <div class="item-name"><?=$row['name_ar'];?></div>
                                <?php if((float)$row['quantity'] > 0):?>
                                    <span class="availability">Available</span>
                                <?php else:?>
                                    <span class="none">none</span>
                                <?php endif;?>
                            </div>
                        </div>
                    <?php endwhile;?>
                <?php else:?>
                    <p>there is no product</p>
                <?php endif;?>
            </div>
        </div>

        <!-- Right Side - Order Summary -->
        <div class="order-section">
            <div class="order-card">
                <h3>Bon</h3>
                <div class="order-item">
                    <div class="order-item-name">Item Name</div>
                    <div style="text-align: center; font-weight: bold;">Qty</div>
                    <div style="text-align: center; font-weight: bold;">Type</div>
                    <div style="text-align: center; font-weight: bold;">Remove</div>
                </div>
                <form action="" method="post">
                                        
                    <div class="order-item">
                        <div class="order-item-name">Citron Confit</div>
                        <input name="name" type="text" value="Citron Confit" hidden>
                        <input name="qty" type="number" class="qty-input" value="1" min="1">
                        <div class="price">
                            <select name="type">
                                <option value="">select</option>
                                <option value="pc">pc</option>
                                <option value="kg">kg</option>
                                <option value="g">g</option>
                                <option value="l">l</option>
                            </select>
                        </div>
                        <button class="remove-btn">×</button>
                    </div>
                    <button class="pay-btn">Send to Economa</button>
        
                </form>
            </div>
        </div>
    </div>
</body>
</html>
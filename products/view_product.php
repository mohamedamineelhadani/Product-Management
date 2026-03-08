<?php
require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/config/db.php";
require_once dirname(__DIR__)."/middleware/auth.php";

if (!isset($_GET['productId'])) {
    header("Location: index.php");
    exit;
}
$productId = $_GET['productId'];
$getProduct = "SELECT
            C.name as category,
            P.id,
            P.name, 
            P.name_ar,
            P.other_names,
            P.description,
            P.post,
            P.price,
            P.quantity,
            P.image,
            P.status,
            P.created_at,
            P.updated_at
        FROM products P INNER JOIN categories C ON P.category_id = C.id
        WHERE P.user_id = '$id' AND C.user_id = '$id' AND P.id = '$productId'
    ";
$resProduct = mysqli_query($conn, $getProduct);
$product = mysqli_fetch_assoc($resProduct);

if (!$product) {
    header("Location: index.php");
    exit;
}


?>
<?php require_once dirname(__DIR__)."/includes/header.php"; ?>
<div class="product-view">
    <div class="product-image-large">
        <img src=<?= ASSETS_URL."images/".($product['image'] ?: 'default.png'); ?> alt=<?= $product['name']; ?>>
    </div>
    <div class="product-details">
        <h2 class="name"><?= $product['name']; ?></h2>
        <h3 class="name-ar"><?= $product['name_ar']; ?></h3>
        <p class="price">Price: <?= $product['price']; ?> DH</p>
        <p class="category">Category: <?= $product['category']; ?></p>
        <p class="quantity">Quantity: <?= $product['quantity']; ?></p>
        <p class="status <?= $product['status']; ?>">Status: <?= str_replace('_', ' ', $product['status']); ?></p>

        <div class="other-names">
            <h4>Other names :</h4>
            <p><?= nl2br($product['other_names']); ?></p>
        </div>

        <div class="post-details">
            <h4>Post :</h4>
            <p><?= nl2br($product['post']); ?></p>
        </div>

        <div class="description">
            <h4>Description:</h4>
            <p><?= nl2br($product['description']); ?></p>
        </div>

        <div class="actions">
            <a href="edit_product.php?productId=<?= $product['id']; ?>" class="btn edit">Edit</a>
            <a href="index.php" class="btn back">Back to List</a>
        </div>
    </div>
</div>

<?php require_once dirname(__DIR__)."/includes/footer.php"; ?>
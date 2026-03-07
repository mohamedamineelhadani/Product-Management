<?php
require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/config/db.php";
require_once dirname(__DIR__)."/middleware/auth.php";

if (!isset($_GET['productId'])) {
    header("Location: index.php");
    exit;
}

$id = $_GET['id'];
$query = "SELECT * FROM products WHERE id = $id";
$result = mysqli_query($conn, $query);
$product = mysqli_fetch_assoc($result);

if (!$product) {
    header("Location: index.php");
    exit;
}
?>
<?php require_once dirname(__DIR__)."/includes/header.php"; ?>
<div class="product-view">
    <div class="product-image-large">
        <img src="../assets/images/<?= $product['image'] ?: 'placeholder.jpg'; ?>" alt="<?= $product['name_fr']; ?>">
    </div>
    <div class="product-details">
        <h2><?= $product['name_fr']; ?></h2>
        <h3><?= $product['name_ar']; ?></h3>
        <p class="price">Price: <?= $product['price']; ?> DH</p>
        <p class="category">Category: <?= $product['category']; ?></p>
        <p class="quantity">Quantity: <?= $product['quantity']; ?></p>
        <p class="status <?= $product['status']; ?>">Status: <?= str_replace('_', ' ', $product['status']); ?></p>
        <div class="other-names">
            <h4>Other names :</h4>
            <p><?= nl2br($product['other_names']); ?></p>
        </div>

        <div class="post">
            <h4>Post :</h4>
            <p><?= nl2br($product['post']); ?></p>
        </div>

        <div class="description">
            <h4>Description:</h4>
            <p><?= nl2br($product['description']); ?></p>
        </div>

        <div class="actions">
            <a href="edit_product.php?id=<?= $product['id']; ?>" class="btn edit">Edit</a>
            <a href="index.php" class="btn back">Back to List</a>
        </div>
    </div>
</div>

<?php require_once dirname(__DIR__)."/includes/footer.php"; ?>
<?php
require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/config/db.php";
require_once dirname(__DIR__)."/middleware/auth.php";


if (isset($_GET['productId'])) {
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
}
?>

<?php require_once dirname(__DIR__)."/includes/header.php"; ?>
<div class="product-form">
    <h2>Edit Product</h2>
    <form action="process_product.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product['id']; ?>">
        
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required value="<?= $product['name']; ?>">
        </div>
        
        <div class="form-group">
            <label for="name_ar">Arabic Name:</label>
            <input type="text" id="name_ar" name="name_ar" required value="<?= $product['name_ar']; ?>">
        </div>
        
        <div class="form-group">
            <label for="other-names">Other names:</label>
            <input type="text" id="other-names" name="other-names" required value="<?= $product['other_names']; ?>">
        </div>

        <div class="form-group">
            <label for="post">Post :</label>
            <input type="text" id="post" name="post" required value="<?= $product['post']; ?>">
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?= $product['description']; ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required value="<?= $product['price']; ?>">
        </div>
        
        <div class="form-group">
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <?php
                    $getCategories = "SELECT * FROM categories WHERE user_id = '$id'";
                    $resCategories = mysqli_query($conn,$getCategories);
                ?>

                <?php if(mysqli_num_rows($resCategories) >= 0) :?>
                    <?php while($category = mysqli_fetch_assoc($resCategories)) :?>
                        <option value="<?=$category["id"]?>" <?= $product['category'] == $category["name"] ? 'selected' : ''; ?>><?= $category["name"] ;?></option>
                    <?php endwhile ;?>
                <?php endif; ?>
                <option value="other" <?= $product['category'] == 'other' ? 'selected' : ''; ?>>Other</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" required value="<?= $product['quantity']; ?>">
        </div>
        
        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" id="status" name="status" readonly value="<?= $product['status'] == 'out_of_stock' ? "Out of Stock" : "available" ; ?>">
        </div>
        
        <div class="form-group">
            <label for="image">Product Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
            <?php if (!empty($product['image'])): ?>
                <p>Current image: <?= $product['image']; ?></p>
            <?php endif; ?>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn submit">Update Product</button>
            <a href="<?= 'view_product.php?productId='.$product['id'] ?>" class="btn cancel">Cancel</a>
        </div>
    </form>
</div>


<script>
const quantity = document.getElementById('quantity');
const status = document.getElementById('status');
quantity.addEventListener("input",function(){
    const quantityValue =Number(quantity.value);
    if(quantityValue > 0){
        status.value="available";
    }else if(quantityValue == 0){
        status.value="Out of Stock";
    }else{
        quantity.value=0;
        alert("It cannot be below zero");
    }
});
</script>

<?php require_once dirname(__DIR__)."/includes/footer.php"; ?>
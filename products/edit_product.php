<?php
include '../config/db.php';
include '../includes/header.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM products WHERE id = $id";
    $result = mysqli_query($conn, $query);
    $product = mysqli_fetch_assoc($result);
    
    if (!$product) {
        header("Location: index.php");
        exit;
    }
}
?>

<div class="product-form">
    <h2>Add New Product</h2>
    <form action="process_product.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $product['id']; ?>">
        
        <div class="form-group">
            <label for="name_fr">French Name:</label>
            <input type="text" id="name_fr" name="name_fr" required value="<?= htmlspecialchars($product['name_fr']); ?>">
        </div>
        
        <div class="form-group">
            <label for="name_ar">Arabic Name:</label>
            <input type="text" id="name_ar" name="name_ar" required value="<?= htmlspecialchars($product['name_ar']); ?>">
        </div>
        
        <div class="form-group">
            <label for="other-names">Other names:</label>
            <input type="text" id="other-names" name="other-names" required value="<?= htmlspecialchars($product['other_names']); ?>">
        </div>

        <div class="form-group">
            <label for="post">Post :</label>
            <input type="text" id="post" name="post" required value="<?= htmlspecialchars($product['post']); ?>">
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description"><?= htmlspecialchars($product['description']); ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required value="<?= $product['price']; ?>">
        </div>
        
        <div class="form-group">
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <?php
                    $file= file_get_contents("../assets/json/categories.json");
                    $json =json_decode($file,true);
                    $categories = $json["categories"];
                ?>
                <?php foreach($categories as $index => $value) :?>
                    <option value="<?=$value?>" <?= $product['category'] == $value ? 'selected' : ''; ?>><?=$value?></option>
                <?php endforeach; ?>
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
            <input type="file" id="image" name="image">
            <?php if (!empty($product['image'])): ?>
                <p>Current image: <?= $product['image']; ?></p>
            <?php endif; ?>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn submit">Update Product</button>
            <a href="<?= 'view_product.php?id='.$product['id'] ?>" class="btn cancel">Cancel</a>
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
    }else if(quantityValue <= 0){
        status.value="Out of Stock";
    }
});
</script>

<?php include '../includes/footer.php'; ?>
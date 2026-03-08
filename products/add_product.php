<?php
require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/config/db.php";
require_once dirname(__DIR__)."/middleware/auth.php";
?>

<?php require_once dirname(__DIR__)."/includes/header.php"; ?>
<div class="product-form">
    <h2>Add New Product</h2>
    <form class="add-form" action="process_product.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        
        <div class="form-group">
            <label for="name_ar">Arabic Name:</label>
            <input type="text" id="name_ar" name="name_ar" required>
        </div>

        <div class="form-group">
            <label for="other-names">other names :</label>
            <input type="text" id="other-names" name="other-names" required>
        </div>

        <div class="form-group">
            <label for="post">Post :</label>
            <input type="text" id="post" name="post" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="price">Price (DH):</label>
            <input type="number" id="price" name="price" step="0.01" min="0" required>
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
                        <option value="<?=$category["id"]?>"><?= $category["name"] ;?></option>
                    <?php endwhile ;?>
                <?php endif; ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity"  required>
        </div>
        
        <div class="form-group">
            <label for="status">Status:</label>
            <input type="text" id="status" name="status" readonly>
        </div>
        
        <div class="form-group">
            <label for="image">Product Image:</label>
            <input type="file" id="image" name="image" accept="image/*">
            <small>Maximum size: 2MB. Allowed types: JPG, PNG, JPEG</small>
        </div>
        
        <div class="form-actions">
            <?php
                $check = mysqli_query($conn,"SELECT * FROM categories WHERE user_id = '$id'");
            ?>
            <?php if(mysqli_num_rows($check) > 0) :?>
              <button type="submit" class="btn submit">Add Product</button>
            <?php else :?>
                <a href=<?= START_URL."categories/index.php"?> class="btn submit">Create Categories</a>
            <?php endif ;?>            
            <a href="index.php" class="btn cancel">Cancel</a>
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
<?php
include '../config/db.php';
include '../includes/header.php';
?>

<div class="product-form">
    <h2>Add New Product</h2>
    <form action="process_product.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name_fr">French Name:</label>
            <input type="text" id="name_fr" name="name_fr" required>
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
            <textarea id="description" name="description"></textarea>
        </div>
        
        <div class="form-group">
            <label for="price">Price (DH):</label>
            <input type="number" id="price" name="price" step="0.01" min="0" required>
        </div>
        
        <div class="form-group">
            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="">Select a category</option>
                <?php
                    $file= file_get_contents("../assets/json/categories.json");
                    $json =json_decode($file,true);
                    $categories = $json["categories"];
                ?>
                <?php foreach($categories as $index => $value) :?>
                    <option value="<?=$value?>" title="<?=$index?>"><?=$value?></option>
                <?php endforeach; ?>
                <option value="other">Other</option>
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
            <button type="submit" class="btn submit">Add Product</button>
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
    }else if(quantityValue <= 0){
        status.value="Out of Stock";
    }
});

document.addEventListener('DOMContentLoaded', function() {

    const form = document.querySelector('.product-form form');
    form.addEventListener('submit', function(e) {
        const nameFr = document.getElementById('name_fr').value.trim();
        const nameAr = document.getElementById('name_ar').value.trim();
        const price = document.getElementById('price').value;
        const category = document.getElementById('category').value;
        const quantity = document.getElementById('quantity').value;
        const image = document.getElementById('image').files[0];


        if (!nameFr || !nameAr) {
            alert('Both French and Arabic names are required');
            e.preventDefault();
            return;
        }
        

        if (isNaN(price) || parseFloat(price) <= 0) {
            alert('Please enter a valid price');
            e.preventDefault();
            return;
        }
        
        if (!category) {
            alert('Please select a category');
            e.preventDefault();
            return;
        }
        

        if (isNaN(quantity) || parseInt(quantity) < 0) {
            alert('Please enter a valid quantity');
            e.preventDefault();
            return;
        }
        
        if (image) {
            const validTypes = ['image/jpeg', 'image/png', 'image/jpg'];
            const maxSize = 2 * 1024 * 1024;
            
            if (!validTypes.includes(image.type)) {
                alert('Only JPG, PNG, and JPEG images are allowed');
                e.preventDefault();
                return;
            }
            
            if (image.size > maxSize) {
                alert('Image size must be less than 2MB');
                e.preventDefault();
                return;
            }
        }
    });
});
</script>

<?php include '../includes/footer.php'; ?>
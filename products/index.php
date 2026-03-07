<?php
require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/config/db.php";
require_once dirname(__DIR__)."/middleware/auth.php";



$category = isset($_GET['category']) ? strtolower($_GET['category']) : 'all';
$query = "SELECT
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
        WHERE P.user_id = '$id' AND C.user_id = '$id'
    ";

if ($category != 'all') {
    $query .= " AND C.name = '$category'";
}

$result = mysqli_query($conn, $query);
?>

<?php require_once dirname(__DIR__)."/includes/header.php"; ?>
<div class="search-container">
    <input type="text" id="search" placeholder="Search by name or post or nick name" oninput="search()">
</div>

<div class="products-grid">
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <div class="product-card">
                <div class="product-image">
                    <img src=<?= ASSETS_URL."images/".($row['image'] ?: 'default.png'); ?> alt=<?= $row['name']; ?>>
                    <span class="category"><?= ucfirst($row['category']) ?></span>
                </div>

                <div class="product-body">
                    <h3 class="product-title"><?= $row['name']; ?></h3>
                    <p class="product-ar"><?= $row['name_ar']; ?></p>

                    <div class="product-info">
                        <p>Other Names: <span class="names"><?= $row['other_names']; ?></span></p>
                        <p>Description: <span><?= $row['description']; ?></span></p>
                        <p>Post: <span class="post"><?= $row['post']; ?></span></p>
                    </div>

                    <div class="product-meta">
                        <span class="price"><?= $row['price']; ?> DH</span>
                        <span class="quantity">Stock: <?= $row['quantity']; ?></span>
                    </div>

                    <div class="status <?= $row['status']; ?>">
                        <?= str_replace('_',' ',$row['status']); ?>
                    </div>
        
                    <div class="product-actions">
                        <a href="view_product.php?productId=<?= $row['id']; ?>" class="btn view">View</a>
                        <a href="edit_product.php?productId=<?= $row['id']; ?>" class="btn edit">Edit</a>
                        <a href="delete_product.php?productId=<?= $row['id']; ?>" class="btn delete"
                           onclick="return confirm('Are you sure?')">Delete</a>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p class="no-products">No products found.</p>
    <?php endif; ?>
</div>

<script>
function search(){
    const inputSearch = document.getElementById("search");
    const cards = document.querySelectorAll(".product-card");
    const keyword = inputSearch.value.toUpperCase().trim();
    if(keyword !== ""){
        cards.forEach(card => {
            const title =card.querySelector(".product-title").textContent.toUpperCase().trim();
            const titleAr =card.querySelector(".product-ar").textContent.toUpperCase().trim();
            const names =card.querySelector(".names").textContent.toUpperCase().trim();
            const post =card.querySelector(".post").textContent.toUpperCase().trim();
            if(
                title.includes(keyword) ||
                titleAr.includes(keyword) ||
                names.includes(keyword) ||
                post.includes(keyword)
            ){
                card.style.display="";
            }else{
                card.style.display="none";
            }
        });
    }else{
        cards.forEach(card => {
            card.style.display="";
        });
    }
}
</script>
<?php require_once dirname(__DIR__)."/includes/footer.php"; ?>
<?php
require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/config/db.php";
require_once dirname(__DIR__)."/middleware/auth.php";
?>


<?php require_once dirname(__DIR__)."/includes/header.php"; ?>
  <div class="container-categories">
    <h1>Category Manager</h1>
    <table>
      <thead>
        <tr>
          <th>Category Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $getCategories = "SELECT * FROM categories WHERE user_id = '$id'";
          $resCategories = mysqli_query($conn,$getCategories);
        ?>
        <?php if(mysqli_num_rows($resCategories) >= 0) :?>
          <?php while($category = mysqli_fetch_assoc($resCategories)) :?>
            <tr>
              <td><?= $category["name"]?></td>
              <td class="actions">
                <a href="edit.php?categoryId=<?= $category["id"] ?>" class="edit">EDIT</a>
                <?php
                  $check = mysqli_query($conn,"SELECT COUNT(*) AS num FROM products WHERE category_id = '{$category["id"]}' AND user_id = '$id'");
                  $count = mysqli_fetch_assoc($check)["num"];
                ?>
                <?php if($check && $count <= 0) :?>
                  <a href="delete.php?categoryId=<?= $category["id"] ?>" class="delete">DELETE</a>
                <?php endif;?>
              </td>
            </tr>
          <?php endwhile ;?>
        <?php else : ?>
          <tr>
            <td>please add category !</td>
            <td></td>
          </tr>
        <?php endif?>
      </tbody>
    </table>

    <form action="add.php" method="post">
      <input type="text" name="category" placeholder="Add new category..." required>
      <input type="submit" value="Add">
    </form>
  </div>
<?php require_once dirname(__DIR__)."/includes/footer.php"; ?>
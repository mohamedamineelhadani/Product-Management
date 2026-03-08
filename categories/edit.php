<?php
require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/config/db.php";
require_once dirname(__DIR__)."/middleware/auth.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Category</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #2c3e50;
      padding: 40px;
    }

    .container {
      max-width: 500px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    h2 {
      text-align: center;
      color: #333;
    }

    form {
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-top: 20px;
    }

    input[type="text"] {
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 16px;
    }

    input[type="submit"] {
      padding: 10px;
      background-color: #2c3e50;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      cursor: pointer;
    }

    .back {
      display: block;
      text-align: center;
      margin-top: 15px;
      text-decoration: none;
      color: #2c3e50;
    }

    .back:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Edit Category</h2>
    <?php
        $categoryId = $_GET['categoryId'];
        $getCategorie = "SELECT * FROM categories WHERE user_id = '$id' AND id ='$categoryId'";
        $resCategorie = mysqli_query($conn,$getCategorie);
        $category = mysqli_fetch_assoc($resCategorie);
    ?>

    <form action="update.php" method="post">
      <input hidden type="number" name="categoryId" value="<?= $category["id"] ?>">
      <input type="text" name="name" value="<?= $category["name"] ?>" required>
      <input type="submit" value="Update Category">
    </form>

    <a href="index.php" class="back">← Back to Categories</a>
  </div>

</body>
</html>

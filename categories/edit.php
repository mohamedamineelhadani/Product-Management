<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Category</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f2f5;
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
      background-color: #4CAF50;
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
      color: #2196F3;
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
        $index = $_GET['index'];
        $file = file_get_contents("categories.json");
        $json = json_decode($file,true);
        $categories = $json["categories"];
        foreach($categories as $ind => $value){
            if($ind == $index){
                $name =$value;
            }
        }
    ?>

    <form action="update.php" method="post">
      <input hidden type="number" name="index" value="<?= $index ?>">
      <input type="text" name="name" value="<?= $name ?>" required>
      <input type="submit" value="Update Category">
    </form>

    <a href="index.php" class="back">← Back to Categories</a>
  </div>

</body>
</html>

<?php
// require_once dirname(__DIR__)."/config/config.php";
// require_once dirname(__DIR__)."/config/db.php";

// $sql = "SELECT * FROM categories";
// $categories = mysqli_query($conn,$sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Categories</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9f9;
      padding: 40px;
    }

    h1 {
      text-align: center;
      color: #333;
    }

    .container {
      max-width: 800px;
      margin: auto;
      background: #fff;
      padding: 20px;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th, td {
      padding: 12px 16px;
      border-bottom: 1px solid #ccc;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    .actions button {
      margin-right: 5px;
      padding: 5px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .edit {
      background-color: #4CAF50;
      color: white;
    }

    .delete {
      background-color: #f44336;
      color: white;
    }

    form {
      margin-top: 20px;
      display: flex;
      gap: 10px;
    }

    input[type="text"] {
      flex: 1;
      padding: 8px;
      border-radius: 6px;
      border: 1px solid #ccc;
    }

    input[type="submit"] {
      background-color: #2196F3;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
    }
    .back-link{
      text-decoration: none;
      padding: 8px 16px;
      border: none;
      border-radius: 6px;
      font-family: system-ui;
      color: black;
      background: gainsboro;
      font-weight: bold;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <div class="container">
        <a class="back-link" href=<?= BASE_URL ?>>back to app</a>
    <h1>Category Manager</h1>
    <table>
      <thead>
        <tr>
          <th>#</th>
          <th>Category Name</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php if($categories):?>

        <?php else :?>

        <?php endif?>
      <?php
        // $file = file_get_contents(ASSETS_URL."json/categories.json");
        // $json = json_decode($file,true);
        // $categories = $json["categories"];
      ?>
      <?php foreach ($categories as $index => $value) : ?>
        <tr>
          <td><?= $index ?></td>
          <td><?= $value?></td>
          <td class="actions">
            <button class="edit" onclick="location.href='edit.php?index=<?= $index ?>'">Edit</button>
            <button class="delete" onclick="location.href='delete.php?index=<?= $index ?>'" >Delete</button>
          </td>
        </tr>
      <?php endforeach;?>
      </tbody>
    </table>

    <form action="add.php" method="post">
      <input type="text" name="category" placeholder="Add new category..." required>
      <input type="submit" value="Add">
    </form>
  </div>

</body>
</html>

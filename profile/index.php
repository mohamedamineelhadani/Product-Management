<?php
require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/config/db.php";
require_once dirname(__DIR__)."/middleware/auth.php";



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $username = htmlspecialchars(trim($_POST['username']));
    $email    = htmlspecialchars(trim($_POST['email']));
    $phone    = htmlspecialchars(trim($_POST['phone']));

    $updateUser = "UPDATE users SET username='$username', email='$email', phone='$phone' WHERE id='$id'";
    $resUpUser = mysqli_query($conn,$updateUser); 
    if($resUpUser){
      $success = "Profile updated successfully";
    }else{
      $error = "Update failed";
    }
}


$getUser = "SELECT * FROM users WHERE id='$id'"; 
$resUser = mysqli_query($conn,$getUser); 
$user = mysqli_fetch_assoc($resUser); 
?>

<?php require_once dirname(__DIR__)."/includes/header.php"; ?>
    <div class="profile-card">
      <h2>User Profile</h2>
      <?php if(isset($success)) echo "<p class='success'>$success</p>"; ?>
      <?php if(isset($error)) echo "<p class='error'>$error</p>"; ?>

      <form method="POST">

        <div class="form-group">
          <label>Username</label>
          <input
            type="text"
            name="username"
            value="<?= $user['username'] ?>"
            required
          />
        </div>

        <div class="form-group">
          <label>Email</label>
          <input
            type="email"
            name="email"
            value="<?= $user['email'] ?>"
            required
          />
        </div>

        <div class="form-group">
          <label>Phone</label>
          <input
            type="text"
            name="phone"
            value="<?= $user['phone'] ?>"
            required
          />
        </div>

        <button class="btn edit profile-btn" type="submit" name="update">Update Profile</button>
      </form>
       <a href="delete.php" class="btn delete profile-btn">Delete Profile</a>
</div>
<?php require_once dirname(__DIR__)."/includes/footer.php"; ?>

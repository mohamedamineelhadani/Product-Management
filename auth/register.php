<?php
require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/config/db.php";

$title = "Register";

function safe_data($field) {
    $field = trim($field);
    $field = stripslashes($field);
    $field = htmlspecialchars($field);
    return $field;
}

function checkPass($pass) {
    global $error;
    if (strlen($pass) < 8) {
        $error ="The number of characters must be 8 or more in password !";
        return false;
    }elseif(!preg_match('/[A-Z]/', $pass)) {
        $error ="Please use capital letter in password !";
        return false;
    }elseif(!preg_match('/[a-z]/', $pass)) {
        $error ="Please use small letter in password !";
        return false;
    }elseif(!preg_match('/[0-9]/', $pass)) {
        $error ="Please use numbers in password !";
        return false;
    }elseif(!preg_match('/[^\w]/', $pass)) {
        $error ="please use symbols in password !";
        return false;
    }else{
        return true;
    }
};



if($_SERVER["REQUEST_METHOD"]=="POST"){
    $username =safe_data($_POST["username"] ?? "");
    $password =safe_data($_POST["password"] ?? "");
    $email =safe_data($_POST["email"] ?? "");
    $phone = safe_data($_POST["phone"] ?? "");

    if(empty($username) || empty($email) || empty($phone)  || empty($password)){
        $error = "all field is required !";
    }elseif(strlen($username) < 8 || !preg_match("/^[a-zA-Z ]+$/",$username)){
        $error = "Please enter correct user name";
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "Please enter correct email";
    }elseif(!checkPass($password)){
        // message error from function
    }else{
        $check ="SELECT * FROM users WHERE username = '$username' OR email = '$email'";
        $resultChe =mysqli_query($conn,$check);
        if (mysqli_num_rows($resultChe) > 0) {
            $error= "username or email is already exists ";
        }else {
            $password = password_hash($password, PASSWORD_DEFAULT);
            $insertUser = "INSERT INTO users (username, email ,password , phone) VALUES ('$username','$email' ,'$password', '$phone')";
            if (mysqli_query($conn,$insertUser)) {
                header("location:login.php");
            }else{
                $error =  "error try again";
            }
        }
    }
    mysqli_close($conn);
};

?>

<?php require_once __DIR__."/authHeader.php"; ?>
<form id="registerForm" action="<?= $_SERVER["PHP_SELF"] ?>" method="post">

    <?php if (isset($error)): ?>
        <div class="error"><?= $error ?></div>
    <?php endif; ?>

    <div class="input-group">
        <input name="username" type="text" id="username" placeholder="Username" >
    </div>
    <div class="input-group">
        <input name="email" type="email" id="email" placeholder="Email" >
    </div>
    <div class="input-group">
        <input name="phone" type="tel" id="phone" placeholder="phone" >
    </div>
    <div class="input-group">
        <input name="password" type="password" id="password" placeholder="Password" >
    </div>
    <button type="submit"><?= $title ?></button>
    <div class="links">
        <a href="login.php">Login ?</a>
    </div>
</form>
<?php require_once __DIR__."/authFooter.php";?> 
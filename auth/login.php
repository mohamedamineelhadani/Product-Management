<?php
require_once dirname(__DIR__)."/config/config.php";
require_once dirname(__DIR__)."/config/db.php";

$title = "Login";
session_start();


function safe_data($field) {
    $field = trim($field);
    $field = stripslashes($field);
    $field = htmlspecialchars($field);
    return $field;
}

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $email = safe_data($_POST['email'] ?? '');
    $password = safe_data($_POST['password'] ?? '');

    if(empty($email) || empty($password)){
        $error = "all field is required";
    }elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error = "enter correct email forma";
    }else{
        $getUser = "SELECT id, username, password FROM users WHERE email = '$email'";
        $resUser =mysqli_query($conn,$getUser);
        if($resUser && mysqli_num_rows($resUser) > 0){
            $user =mysqli_fetch_assoc($resUser);
            if (password_verify($password, $user['password'])) {
                $_SESSION['id_user'] = $user['id'];
                $_SESSION['is_login'] =true;
                $_SESSION['username'] = $user['username'];

                if(isset($_POST["remember"])){
                    setcookie("email", $email, time() + 86400, "/");
                    setcookie("password", $password, time() + 86400, "/");
                };
                    
                header("location:".BASE_URL);
            } else {
                $error= "Incorrect  password";
            }
        }else{
            $error ="Incorrect email";
        }
    }
}


?>

<?php require_once __DIR__."/authHeader.php"; ?>
        <form id="loginForm" action="<?= $_SERVER["PHP_SELF"] ?>" method="post">

            <?php if (isset($error)): ?>
                <div class="error"><?= $error ?></div>
            <?php endif; ?>

            <div class="input-group">
                <input name="email" type="email" id="email" placeholder="Email" >
            </div>
            <div class="input-group">
                <input name="password" type="password" id="password" placeholder="Password" >
            </div>
            <div class="remember-me">
                <label class="remember">Remember me </label>
                <input name="remember" type="checkbox" id="remember"> 
            </div>
            <button type="submit"><?= $title ?></button>
            <div class="links">
                <a href="register.php">Create account ?</a>
            </div>
        </form>
<?php require_once __DIR__."/authFooter.php";?> 
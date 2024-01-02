<?php
require_once '../php/config_session.php'; //we need a session to output the messages
require_once '../php/login.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<div class="main">
    <header>
        <?php
        require_once '../php/topnav.php';
        ?>
    </header>

    <div class="register-msg">
        <?php
        display_regster_msg();
        ?>
    </div>

    <div class="login">
        <h2>Login</h2>
        <form class="login-form" action="../php/login.php" method="post">
            <div class="login-content">
                <label>
                    <input type="email" class="textbox" name="email" placeholder="Email">
                </label>
                <label>
                    <input type="password" class="textbox" name="password" placeholder="Password">
                </label>
            </div>
            <button type="submit" name="submit" class="button">Login</button>
        </form>
        <a href="forgot_password_view.php" class="forgot">Forgot your password?</a>
        <div class="or-register">
            <hr>
            <span>Don't have an account?</span>
            <a href="../views/register_view.php">
                <button class="register-button">Register</button>
            </a>
        </div>
        <?php
        check_login_errors();
        ?>
    </div>
</div>
<?php
require_once "../php/footer.php";
?>
</body>


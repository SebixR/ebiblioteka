<?php
require_once '../php/config_session.php'; //we need a session to output the messages
require_once '../php/register.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Register</title>
    <link rel="stylesheet" type="text/css" href="../css/register.css">
</head>
<body>

<div class="main">
    <header>
        <?php
        require_once '../php/topnav.php';
        ?>
    </header>

    <div class="register">
        <h2>Register</h2>
        <form action="../php/register.php" method="post" class="register-form">
            <div class="register-content">
                <label>
                    <input type="text" class="textbox" name="name" placeholder="Name" required>
                </label>
                <label>
                    <input type="text" class="textbox" name="lastname" placeholder="Last Name" required>
                </label>
                <label>
                    <input type="email" class="textbox" name="email" placeholder="Email" required>
                </label>
                <label>
                    <input type="password" class="textbox" name="password" placeholder="Password" required>
                </label>
                <label>
                    <input type="password" class="textbox" name="password_repeat" placeholder="Password" required>
                </label>
            </div>
            <button name="submit" class="register-button">Register</button>
        </form>
        <div class="or-login">
            <hr>
            <span>Already have an account?</span>
            <a href="login_view.php">
                <button class="login-button">Login</button>
            </a>
        </div>
        <?php
        check_register_error();
        ?>
    </div>

</div>
<?php
require_once "../php/footer.php";
?>
</body>

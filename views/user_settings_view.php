<?php
require_once '../php/config_session.php';
require_once '../php/user_settings.php';
require_once '../php/user_settings_contr.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Settings</title>
    <link rel="stylesheet" type="text/css" href="../css/user_settings.css">
</head>
<body>

<header>
    <?php
    require_once '../php/topnav.php';
    ?>
</header>

<div class="main">
    <?php
    if (isset($_SESSION["user_id"])) {
        $user_id = (int)$_SESSION["user_id"];
    ?>

    <div class="register">
        <h3>Edit account information</h3>
        <form action="../php/user_settings.php" method="post" class="register-form">
            <div class="register-content">
                <?php
                get_user_info($user_id);
                echo "<input type='hidden' value='$user_id' name='user_id'>"
                ?>
                <label> New Password
                    <input type="password" class="textbox" name="password" placeholder="Password">
                </label>
                <label> Confirm New Password
                    <input type="password" class="textbox" name="password_confirm" placeholder="Password">
                </label>
            </div>
            <button name="submit" class="register-button">Apply</button>
        </form>
        <?php
        check_settings_error();
        ?>
    </div>

        <?php
    }
    ?>

</div>
<?php
require_once "../php/footer.php";
?>
</body>

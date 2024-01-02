<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="../css/forgot_password.css">
</head>
<body>

<div class="main">
    <header>
        <?php
        require_once '../php/topnav.php';
        ?>
    </header>

    <script>
        function displayNotification()
        {
            const content = document.getElementById("notification");
            content.style.display = "flex";
            const emailValue = document.getElementById("email").value;
            if (emailValue.trim() === "") {
                document.getElementById("notification").innerHTML = "No email submitted";
            }
            else
            {
                document.getElementById("notification").innerHTML = "We will send you a password recovery link to the submitted email, if it is in our database.";
            }
        }
    </script>

    <div class="login">
        <h2>Retrieve Password</h2>
        <div class="login-form">
            <div class="login-content">
                <label> Email
                    <input type="email" class="textbox" id="email" placeholder="Email">
                </label>
            </div>
            <button onclick="displayNotification()" class="button">Submit</button>
        </div>
        <p class="notification" id="notification"></p>
    </div>
</div>
<?php
require_once "../php/footer.php";
?>
</body>

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
        <nav class="topnav">
            <a class="home" href="../index.php">Home</a>
            <?php
            if (isset($_SESSION["user_id"])) { ?>
                <a class="my-books" style="float:right" href="../views/my_books_view.php">My Books</a>
            <?php } else { ?>
                <a class="my-books" style="float:right" href="../views/login_view.php">My Books</a>
            <?php } ?>

            <div class="search-wrap">
                <form>
                    <input type="text" class="search" placeholder="Search">
                    <button type="submit" class="search-button">Go</button>
                </form>
            </div>
            <?php
            if (isset($_SESSION["user_id"])) { ?>
                <div class="dropdown" onclick="dropDown()">
                    <button class="settings">Test</button>
                    <div class="dropdown-content" id="dropdown">
                        <a href="#">
                            <button class="settings-button">Settings</button>
                        </a>
                        <form action="../php/logout.php" method="post" class="log-out">
                            <button class="log-out-button">Log out</button>
                        </form>
                    </div>
                </div>
                <script>
                    function dropDown() {
                        document.getElementById("dropdown").classList.toggle("show-dropdown");
                    }

                    window.onclick = function(event) {
                        if (!event.target.matches('.settings')) {
                            var dropdowns = document.getElementsByClassName("dropdown-content");
                            var i;
                            for (i = 0; i < dropdowns.length; i++) {
                                var openDropdown = dropdowns[i];
                                if (openDropdown.classList.contains('show-dropdown')) {
                                    openDropdown.classList.remove('show-dropdown');
                                }
                            }
                        }
                    }
                </script>
            <?php } else { ?>
                <a href="../views/login_view.php">
                    <button class="log-in-button">Log in</button>
                </a>
            <?php }
            ?>
        </nav>
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
</body>

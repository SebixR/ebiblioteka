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
        <nav class="topnav">
            <a class="home" href="../index.php">Home</a>
            <a class="my-books" style="float:right" href="../views/my_books_view.php">My Books</a>
            <div class="search-wrap">
                <form>
                    <input type="text" class="search" placeholder="Search">
                    <button type="submit" class="search-button">Go</button>
                </form>
            </div>
            <div class="dropdown" onclick="dropDown()">
                <button class="settings">Test</button>
                <div class="dropdown-content" id="dropdown">
                    <a href="#">Settings</a>
                    <a href="#">Log out</a>
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
        </nav>
    </header>

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
        <a href="#Password_change" class="forgot">Forgot your password?</a>
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
</body>


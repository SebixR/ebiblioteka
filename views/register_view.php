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
    <link rel="stylesheet" href="../css/register.css">
</head>
<body>

<div class="main">
    <header>
        <nav class="topnav">
            <a class="home" href="../index.php">Home</a>
            <a class="my-books" style="float:right" href="../php/my_books.php">My Books</a>
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
                        const dropdowns = document.getElementsByClassName("dropdown-content");
                        let i;
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
            <button type="submit" name="submit" class="register-button">Register</button>
        </form>
        <?php
        check_register_error();
        ?>
        <div class="or-login">
            <hr>
            <span>Already have an account?</span>
            <a href="../php/login.php">
                <button class="login-button">Login</button>
            </a>
        </div>

    </div>
</div>
</body>

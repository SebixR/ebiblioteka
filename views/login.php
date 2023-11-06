<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Website</title>
    <link rel="stylesheet" href="../css/login.css">
</head>
<body>

<div class="main">
    <header>
        <nav class="topnav">
            <a class="home" href="../index.php">Home</a>
            <a class="my-books" style="float:right" href="my_books.php">My Books</a>
            <div class="search-wrap">
                <form>
                    <input type="text" class="search" placeholder="Search">
                    <button type="submit" class="search-button">Go</button>
                </form>
            </div>
            <div class="dropdown">
                <button class="settings">Test</button>
                <div class="dropdown-content">
                    <a href="#">Settings</a>
                    <a href="#">Log out</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="login">
        <h2>Login</h2>
        <form class="login-form">
            <div class="login-content">
                <label>
                    <input type="email" class="textbox" placeholder="Email">
                </label>
                <label>
                    <input type="password" class="textbox" placeholder="Password">
                </label>
            </div>
            <button type="submit" class="button">Login</button>
        </form>
        <a href="#Password_change" class="forgot">Forgot your password?</a>
        <div class="or-register">
            <hr>
            <span>Don't have an account?</span>
            <a href="register.php">
                <button class="register-button">Register</button>
            </a>
        </div>
    </div>
</div>
</body>


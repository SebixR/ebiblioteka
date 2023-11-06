<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Website</title>
    <link rel="stylesheet" href="../css/register.css">
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

    <div class="register">
        <h2>Register</h2>
        <form class="register-form">
            <div class="register-content">
                <label>
                    <input type="text" class="textbox" placeholder="Name">
                </label>
                <label>
                    <input type="text" class="textbox" placeholder="Last Name">
                </label>
                <label>
                    <input type="email" class="textbox" placeholder="Email">
                </label>
                <label>
                    <input type="password" class="textbox" placeholder="Password">
                </label>
                <label>
                    <input type="password" class="textbox" placeholder="Password">
                </label>
            </div>
            <button type="submit" class="register-button">Register</button>
        </form>
        <div class="or-login">
            <hr>
            <span>Already have an account?</span>
            <a href="login.php">
                <button class="login-button">Login</button>
            </a>
        </div>

    </div>
</div>
</body>

<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Website</title>
    <link rel="stylesheet" href="../css/book.css">
</head>
<body>

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

<div class="left-wrap">
    <div class="img-wrap">
        <img src="../images/lotr_cover.jpg" alt="Book Title" class="cover">
    </div>
</div>

<div class="right-wrap">
    <div class="book-info">
        <div class="info">
            <label>Title:</label>
            <label>Author:</label>
            <label>Publisher:</label>
            <label>Release Date:</label>
            <label>Pages:</label>
        </div>
        <hr>
        <div class="options">
            <div class="option">
                <label>Price:</label>
                <button>Borrow</button>
            </div>
            <div class="option">
                <label>Price:</label>
                <button>Purchase</button>
            </div>
        </div>
    </div>
    <article class="summary">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </article>
</div>

</body>
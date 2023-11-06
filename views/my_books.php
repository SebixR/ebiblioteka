<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Website</title>
    <link rel="stylesheet" href="../css/my_books.css">
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

<div class="borrowed-h">
    <h2>Borrowed</h2>
</div>
<div class="borrowed-wrap">
    <div class="borrowed-imgs">
        <div class="item">
            <a href="#Book">
                <img src="../images/lotr_cover.jpg" class="img" alt="Book">
            </a>
            <label class="time-label">Time left</label>
        </div>
        <div class="item">
            <a href="#Book">
                <img src="../images/hp_cover.jpg" class="img" alt="Book">
            </a>
            <label class="time-label">Time left</label>
        </div>
        <div class="item">
            <a href="#Book">
                <img src="../images/lotr_cover.jpg" class="img" alt="Book">
            </a>
            <label class="time-label">Time left</label>
        </div>
        <div class="item">
            <a href="#Book">
                <img src="../images/hp_cover.jpg" class="img" alt="Book">
            </a>
            <label class="time-label">Time left</label>
        </div>
    </div>
</div>

<div class="purchased-h">
    <h2>Purchased</h2>
</div>
<div class="purchased-wrap">
    <div class="row">
        <div class="row-item">
            <a href="#Book">
                <img src="../images/lotr_cover.jpg" alt="Book">
            </a>
        </div>
        <div class="row-item">
            <a href="#Book">
                <img src="../images/lotr_cover.jpg" alt="Book">
            </a>
        </div>
        <div class="row-item">
            <a href="#Book">
                <img src="../images/hp_cover.jpg" alt="Book">
            </a>
        </div>
        <div class="row-item">
            <a href="#Book">
                <img src="../images/hp_cover.jpg" alt="Book">
            </a>
        </div>
        <div class="row-item">
            <a href="#Book">
                <img src="../images/lotr_cover.jpg" alt="Book">
            </a>
        </div>
        <div class="row-item">
            <a href="#Book">
                <img src="../images/lotr_cover.jpg" alt="Book">
            </a>
        </div>
        <div class="row-item">
            <a href="#Book">
                <img src="../images/hp_cover.jpg" alt="Book">
            </a>
        </div>
        <div class="row-item">
            <a href="#Book">
                <img src="../images/hp_cover.jpg" alt="Book">
            </a>
        </div>

    </div>
</div>


</body>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Books</title>
    <link rel="stylesheet" href="../css/my_books.css">
</head>
<body>

<header>
    <?php
    require_once '../php/topnav.php';
    ?>
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

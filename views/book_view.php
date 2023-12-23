<?php
require_once '../php/config_session.php';
require_once '../php/book_view_contr.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Book</title>
    <link rel="stylesheet" href="../css/book.css">
</head>
<body>

<header>
    <?php
    require_once '../php/topnav.php';
    ?>
</header>

<?php
$book_id = $_GET['id'] ?? null;
?>

<div class="left-wrap">
    <div class="img-wrap">
        <?php
        get_cover_image($book_id);
        ?>
    </div>
</div>

<div class="right-wrap">
    <div class="book-info">
        <div class="info">
            <?php
            get_book_info($book_id);
            ?>
            <label>Authors:</label>

        </div>
        <hr>
        <div class="options">
            <div class="option">
                <label>Price</label>
                <button>Borrow</button>
            </div>
            <div class="option">
                <label>Price</label>
                <button>Purchase</button>
            </div>
        </div>
    </div>
    <article class="summary">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
    </article>
</div>

</body>
<?php
require_once '../php/config_session.php';
require_once '../php/basket.php';
require_once '../php/topnav_contr.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Basket</title>
    <link rel="stylesheet" href="../css/basket.css">
</head>
<body>

<div class="main">
    <header>
        <?php
        require_once '../php/topnav.php';
        ?>
    </header>

    <h2>
        Basket
    </h2>

    <form class="basket-form">

        <div class="items">
            <div class="item-wrap">
                <label class='item-content' style='width: 25%'>Title: </label>
                <label class='item-content' style='width: 25%'>Price: </label>
                <label class='item-content' style='width: 25%'>Time Period: </label>
                <button type='submit' name='delete_item'>Delete</button>
            </div>
            <div class="item-wrap">
                <label class='item-content' style='width: 25%'>Title: </label>
                <label class='item-content' style='width: 25%'>Price: </label>
                <label class='item-content' style='width: 25%'>Time Period: </label>
                <button type='submit' name='delete_item'>Delete</button>
            </div>
        </div>

        <button class="basket-submit" type="submit">Continue</button>

    </form>

</div>
</body>

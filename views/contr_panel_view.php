<?php
require_once '../php/config_session.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Control Panel</title>
    <link rel="stylesheet" href="../css/contr_panel.css">
</head>
<body>

<div class="main">
    <header>
        <?php
        require_once '../php/topnav.php';
        ?>
    </header>

    <div class="panels-wrap">
        <div class="panel-left">
            <form class="panel-left-section" action="../php/contr_panel.php" method="post">
                <input type="text" placeholder="Genre" name="add-genre">
                <button name="submit-genre" type="submit">Add Genre</button>
            </form>
            <form class="panel-left-section" action="../php/contr_panel.php" method="post">
                <input type="text" placeholder="Author's Name" name="add-name">
                <input type="text" placeholder="Author's Last Name" name="add-lastname">
                <button name="submit-author" type="submit">Add Author</button>
            </form>
            <form class="panel-left-section">
                <input type="text" placeholder="Publisher">
                <button>Add Publisher</button>
            </form>
        </div>

        <form class="panel-right">
            <div class="panel-right-half">
                <input class="small-input" type="text" placeholder="Title">
                <input class="small-input" type="text" placeholder="Author's Name">
                <input class="small-input" type="text" placeholder="Author's Last Name">
                <input class="small-input" type="text" placeholder="Release Date">
                <input class="small-input" type="text" placeholder="Publisher">
                <input class="small-input" type="text" placeholder="Purchase Price">
                <input class="small-input" type="text" placeholder="Borrow Price">
                <input class="small-input" type="text" placeholder="Page Number">
                <input class="small-input" type="text" placeholder="Cover">
            </div>
            <div class="panel-right-half">
                <textarea maxlength="250" class="summary">Summary goes here</textarea>
                <button type="submit">Add Book</button>
            </div>
        </form>
    </div>


</div>
</body>

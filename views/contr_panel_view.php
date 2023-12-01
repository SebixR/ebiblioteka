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
            <form class="panel-left-section" action="../php/contr_panel.php" method="post">
                <input type="text" placeholder="Publisher" name="add-publisher">
                <button name="submit-publisher" type="submit">Add Publisher</button>
            </form>
        </div>

        <form class="panel-right" enctype="multipart/form-data" action="../php/contr_panel.php" method="post">
            <div class="panel-right-half">
                <input class="small-input" type="text" name="title" placeholder="Title">
                <div class="add-authors">
                    <input class="small-input" type="text" name="name" placeholder="Author's Name">
                    <input class="small-input" type="text" name="lastname" placeholder="Author's Last Name">
                </div>
                <input class="small-input" type="text" name="date" placeholder="Release Date">
                <input class="small-input" type="text" name="publisher" placeholder="Publisher">
                <input class="small-input" type="text" name="purchase" placeholder="Purchase Price">
                <input class="small-input" type="text" name="borrow" placeholder="Borrow Price">
                <input class="small-input" type="text" name="pages" placeholder="Page Number">
            </div>
            <div class="panel-right-half">
                <input class="small-input" type="file" name="choosefile" value="" placeholder="Cover">
                <textarea maxlength="250" class="summary" name="summary">Summary goes here</textarea>
                <button type="submit" name="submit-book">Add Book</button>
            </div>
        </form>
    </div>


</div>
</body>

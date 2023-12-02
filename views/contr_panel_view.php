<?php
require_once '../php/config_session.php';
require_once '../php/contr_panel.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Control Panel</title>
    <link rel="stylesheet" href="../css/contr_panel.css?15">
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
                <button name="delete-genre" type="submit">Delete Genre</button>
                <?php
                check_genre_error();
                ?>
            </form>
            <form class="panel-left-section" action="../php/contr_panel.php" method="post">
                <input type="text" placeholder="Author's Name" name="add-name">
                <input type="text" placeholder="Author's Last Name" name="add-lastname">
                <button name="submit-author" type="submit">Add Author</button>
                <button name="delete-author" type="submit">Delete Author</button>
                <?php
                check_author_error();
                ?>
            </form>
            <form class="panel-left-section" action="../php/contr_panel.php" method="post">
                <input type="text" placeholder="Publisher" name="add-publisher">
                <button name="submit-publisher" type="submit">Add Publisher</button>
                <button name="delete-publisher" type="submit">Delete Publisher</button>
                <?php
                check_publisher_error();
                ?>
            </form>

        </div>

        <form class="panel-right" enctype="multipart/form-data" action="../php/contr_panel.php" method="post">
            <div class="panel-right-half">
                <input class="small-input" type="text" name="title" placeholder="Title">

                <div class="genre-wrap">
                    <ul class="genre-list">
                        <?php
                        get_genres();
                        ?>
                    </ul>
                </div>

                <div class="add-authors">
                    <div id="author-parent">
                        <div class="author-data" id="author-data">
                            <input class="small-input" type="text" name="authors[0][name]" placeholder="Author's Name">
                            <input class="small-input" type="text" name="authors[0][lastname]" placeholder="Author's Last Name">
                        </div>
                    </div>

                    <button class="add-author-button" type="button" onclick="add_author()">+</button>
                    <button class="remove-author-button" type="button" onclick="remove_author()">-</button>

                    <script>
                        let author_counter = 1;
                        function add_author(){
                            if (author_counter < 10)
                            {
                                let parent = document.querySelector('#author-parent');
                                let elem = parent.querySelector('.author-data');

                                let clone = elem.cloneNode(true);
                                clone.children[0].name = "authors[" + author_counter + "][name]";
                                clone.children[1].name = "authors[" + author_counter + "][lastname]"
                                author_counter++;
                                parent.appendChild(clone);
                            }
                        }

                        function remove_author(){
                            const elem = document.getElementById("author-parent");
                            if (elem.childElementCount > 1)
                            {
                                elem.removeChild(elem.lastChild)
                                author_counter--;
                            }
                        }
                    </script>
                </div>
                <input class="small-input" type="date" name="date" placeholder="Release Date">
                <input class="small-input" type="text" name="publisher" placeholder="Publisher">
                <div class="prices-wrap">
                    <input class="small-input" type="text" name="purchase" placeholder="Purchase Price">
                    <input class="small-input" type="text" name="borrow" placeholder="Borrow Price">
                </div>
                <input class="small-input" type="text" name="pages" placeholder="Page Number">
            </div>
            <div class="panel-right-half">
                <label class="file-input">
                    <input type="file" name="choosefile" value="" placeholder="Cover">
                    Upload Cover Image
                </label>
                <textarea maxlength="250" class="summary" name="summary">Summary goes here</textarea>
                <button type="submit" name="submit-book">Add Book</button>
                <div class="notifications-wrap-add">
                    <?php
                    check_add_error();
                    ?>
                </div>
            </div>
        </form>
    </div>


</div>
</body>

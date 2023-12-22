<?php
require_once '../php/config_session.php';
require_once '../php/contr_panel_edit.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Control Panel</title>
    <link rel="stylesheet" href="../css/contr_panel_add.css">
</head>
<body>

<div class="main">
    <header>
        <?php
        require_once '../php/topnav.php';
        ?>
    </header>

    <div class="control-panel-menu">
        <a class="panel-menu-button-active" href="contr_panel_books_view.php">View Books</a>
        <a class="panel-menu-button" href="contr_panel_add_view.php">Add Entry</a>
        <a class="panel-menu-button" href="contr_panel_users_view.php" style="float:right">View Users</a>
    </div>

    <div class="panels-wrap">
        <form class="panel-right" enctype="multipart/form-data" action="../php/contr_panel_edit.php" method="post">

            <?php
            $book_id = $_GET['id'] ?? null; //get id or set to null otherwise
            $book_info = get_book_info($book_id);
            $title = $book_info['title'];
            $publisher = get_publisher_name($book_info['publisher_id']);
            $purchase_price = $book_info['purchase_price'];
            $borrow_price = $book_info['borrow_price'];
            $page_number = $book_info['page_number'];
            $cover = $book_info['cover_img'];
            $summary = $book_info['summary'];
            ?>

            <div class="panel-right-half">
                <?php
                echo "<input value='$title' class='small-input' type='text' name='title' placeholder='Title'>";
                ?>

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
                <?php
                echo "<input value='$publisher' class='small-input' type='text' name='publisher' placeholder='Publisher'>";
                ?>
                <div class="prices-wrap">
                    <?php
                    echo "<input value='$purchase_price' class='small-input' type='text' name='purchase' placeholder='Purchase Price'>";
                    echo "<input value='$borrow_price' class='small-input' type='text' name='borrow' placeholder='Borrow Price'>";
                    ?>
                </div>
                <?php
                echo "<input value='$page_number' class='small-input' type='text' name='pages' placeholder='Page Number'>";
                ?>

            </div>
            <div class="panel-right-half">
                <label class="file-input">
                    <input type="file" name="choosefile" value="" placeholder="Cover">
                    Upload Cover Image
                    <br>
                    <?php
                    echo "<label>$cover</label>";
                    ?>
                </label>
                <?php
                echo "<textarea maxlength='250' class='summary' name='summary'>$summary</textarea>";
                ?>

                <button type="submit" name="submit-book">Add Book</button>
                <div class="notifications-wrap-add">
                    <?php
                    //TODO
                    //check_edit_error();
                    ?>
                </div>
            </div>
        </form>
    </div>


</div>
</body>

<?php
require_once 'php/config_session.php';
require_once 'php/index_contr.php';
require_once 'php/topnav_contr.php'
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Library</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>
<body>

<div class="main">
    <header>
        <nav class="topnav">
            <a class="home" href="index.php">Home</a>
            <?php
            if (isset($_SESSION["user_id"])) { ?>
                <a class="my-books" style="float:right" href="views/my_books_view.php">My Books</a>
            <?php } else { ?>
                <a class="my-books" style="float:right" href="views/login_view.php">My Books</a>
            <?php } ?>

            <div class="search-wrap">
                <form>
                    <input type="text" class="search" placeholder="Search">
                    <button type="submit" class="search-button">Go</button>
                </form>
            </div>
            <?php
            if (isset($_SESSION["user_id"])) { ?>
                <div class="dropdown" onclick="dropDown()">
                    <button class="settings"></button>
                    <div class="dropdown-content" id="dropdown">
                        <a href="#">
                            <button class="settings-button">Settings</button>
                        </a>
                        <form action="php/logout.php" method="post" class="log-out">
                            <button class="log-out-button">Log out</button>
                        </form>
                    </div>
                </div>
                <script>
                    function dropDown() {
                        document.getElementById("dropdown").classList.toggle("show-dropdown");
                    }

                    window.onclick = function(event) {
                        if (!event.target.matches('.settings')) {
                            var dropdowns = document.getElementsByClassName("dropdown-content");
                            var i;
                            for (i = 0; i < dropdowns.length; i++) {
                                var openDropdown = dropdowns[i];
                                if (openDropdown.classList.contains('show-dropdown')) {
                                    openDropdown.classList.remove('show-dropdown');
                                }
                            }
                        }
                    }
                </script>
            <?php } else { ?>
                <div class="dropdown" onclick="dropDown()">
                    <button class="settings"></button>
                    <div class="dropdown-content" id="dropdown">
                        <a href="views/register_view.php">
                            <button class="settings-button">Register</button>
                        </a>
                        <a href="views/login_view.php">
                            <button class="settings-button">Log in</button>
                        </a>
                    </div>
                </div>
                <script>
                    function dropDown() {
                        document.getElementById("dropdown").classList.toggle("show-dropdown");
                    }

                    window.onclick = function(event) {
                        if (!event.target.matches('.settings')) {
                            var dropdowns = document.getElementsByClassName("dropdown-content");
                            var i;
                            for (i = 0; i < dropdowns.length; i++) {
                                var openDropdown = dropdowns[i];
                                if (openDropdown.classList.contains('show-dropdown')) {
                                    openDropdown.classList.remove('show-dropdown');
                                }
                            }
                        }
                    }
                </script>
            <?php }
            ?>

            <?php
            if (isset($_SESSION["user_id"])) {
                if (get_user_role($_SESSION["user_id"]) === 'admin') {
                    echo "<a class='control-panel-button' href='views/contr_panel_books_view.php'>Control Panel</a>";
                }
            }
            ?>

        </nav>
    </header>

    <div class="slider-wrap">
        <div class="my-slides">
            <img src="images/banner.jpg" class="slide-img fade">
        </div>

        <div class="my-slides">
            <img src="images/banner1.jpg" class="slide-img fade">
        </div>

        <div class="my-slides">
            <img src="images/banner.jpg" class="slide-img fade">
        </div>

        <a class="prev" onclick="plusSlides(-2)">&#10094;</a>
        <a class="next" onclick="plusSlides(0)">&#10095;</a>
    </div>
    <div style="text-align:center">
        <span class="dot" onclick="currentSlide(1)"></span>
        <span class="dot" onclick="currentSlide(2)"></span>
        <span class="dot" onclick="currentSlide(3)"></span>

        <script>
            let slideIndex = 1;
            showSlides();
            let timer = setInterval(showSlides, 5000);

            function plusSlides(n) {
                clearInterval(timer);
                timer = setInterval(showSlides, 5000);
                showSlides(slideIndex += n);
            }

            function currentSlide(n) {
                clearInterval(timer);
                timer = setInterval(showSlides, 5000);
                showSlides(slideIndex = n);
            }

            function showSlides() {
                let i;
                let slides = document.getElementsByClassName("my-slides");
                let dots = document.getElementsByClassName("dot");
                if (slideIndex > slides.length) {slideIndex = 1}
                if (slideIndex < 1) {slideIndex = slides.length}
                for (i = 0; i < slides.length; i++) {
                    slides[i].style.display = "none";
                }
                for (i = 0; i < dots.length; i++) {
                    dots[i].className = dots[i].className.replace(" active", "");
                }
                slides[slideIndex - 1].style.display = "flex";
                dots[slideIndex - 1].className += " active";
                slideIndex++;
            }
        </script>
    </div>

    <section>
        <nav class="sidenav">
            <div class="genre-wrap">
                <label>Genres</label>
                <div class="list-wrap">
                    <ul class="genre-list">
                        <?php
                        get_genres();
                        ?>
                    </ul>
                </div>

            </div>
            <hr>
            <div class="author-wrap">
                <label>Author</label>
                <input class="textbox" type="text" placeholder="Author's name">
            </div>
            <hr>
            <div class="publisher-wrap">
                <label>Publisher</label>
                <input class="textbox" type="text" placeholder="Publisher's name">
            </div>
            <button type="submit">Apply</button>
        </nav>

        <div class="main-content">

            <?php
            get_books_main();
            ?>

        </div>
    </section>

</div>


</body>
</html>


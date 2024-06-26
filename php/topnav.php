<?php
require_once 'config_session.php';
require_once 'login.php';
require_once 'topnav_contr.php'
?>

<nav class="topnav">
    <a class="home" href="../index.php">Home</a>
    <?php
    if (isset($_SESSION["user_id"])) { ?>
        <a class="my-books" style="float:right" href="../views/my_books_view.php">My Books</a>
    <?php } else { ?>
        <a class="my-books" style="float:right" href="../views/login_view.php">My Books</a>
    <?php } ?>

    <div class="search-wrap">
        <form method="get" action="../index.php">
            <input type="text" class="search" name="search_value" placeholder="Search">
            <button type="submit" class="search-button">Go</button>
        </form>
    </div>
    <?php
    if (isset($_SESSION["user_id"])) { ?>
        <div class="dropdown" onclick="dropDown()">
            <button class="settings"></button>
            <a href="../views/basket_view.php" class="basket"></a>
            <div class="dropdown-content" id="dropdown">
                <a href="../views/user_settings_view.php">
                    <button class="settings-button">Settings</button>
                </a>
                <form action="../php/logout.php" method="post" class="log-out">
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
            <a href="../views/basket_view.php" class="basket"></a>
            <div class="dropdown-content" id="dropdown">
                <a href="../views/register_view.php">
                    <button class="settings-button">Register</button>
                </a>
                <a href="../views/login_view.php">
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
            echo "<a class='control-panel-button' href='../views/contr_panel_books_view.php'>Control Panel</a>";
        }
    }
    ?>

</nav>

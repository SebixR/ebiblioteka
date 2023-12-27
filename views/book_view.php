<?php
require_once '../php/config_session.php';
require_once '../php/book_contr.php';
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
        </div>
        <hr>
        <div class="options">
            <div class="option">
                <?php
                get_borrow_prices($book_id);
                ?>

                <button type="submit">Borrow</button>
            </div>
            <form class="option">
                <?php
                get_purchase_price($book_id);
                ?>
                <button type="submit">Purchase</button>
            </form>

            <script>
                function showPrices() {
                    document.getElementById("dropdown-prices").classList.toggle("show");
                }

                window.onclick = function(event) {
                    if (!event.target.matches('.borrow-drop')) {
                        const dropdowns = document.getElementsByClassName("borrow-options");
                        let i;
                        for (i = 0; i < dropdowns.length; i++) {
                            const openDropdown = dropdowns[i];
                            if (openDropdown.classList.contains('show')) {
                                openDropdown.classList.remove('show');
                            }
                        }
                    }
                }

                function get_current_price()
                {
                    let price = document.querySelector('input[name="prices"]:checked').value;
                    document.getElementById("borrow_price_label").textContent = price + " $";

                    const radio1Selected = document.getElementById('price1').checked;
                    const radio2Selected = document.getElementById('price2').checked;
                    const radio3Selected = document.getElementById('price3').checked;

                    if (radio1Selected) {
                        document.getElementById("borrow_button").textContent = "30 Days";
                    } else if (radio2Selected) {
                        document.getElementById("borrow_button").textContent = "7 Days";
                    } else if (radio3Selected) {
                        document.getElementById("borrow_button").textContent = "24 Hours";
                    } else {
                        document.getElementById("borrow_button").textContent = "Pick time";
                    }
                }
            </script>

        </div>
        <button type="submit">Add to Basket</button>
    </div>
</div>

<div class="summary-wrap">
    <h3>
        Summary:
    </h3>
    <?php
    get_summary($book_id);
    ?>
</div>


</body>
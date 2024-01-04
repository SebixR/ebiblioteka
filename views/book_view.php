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

<div class="main">
    <div class="notification-wrap" id="notifications"></div>

    <?php
    $book_id = $_GET['id'] ?? null;

    if ($book_id){
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
                        <button onclick="addBorrowedToLocalStorage()">Borrow</button>
                    </div>
                    <div class="option">
                        <?php
                        get_purchase_price($book_id);
                        ?>
                        <button onclick="addPurchasedToLocalStorage()">Purchase</button>
                    </div>

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

        <script>
            function addBorrowedToLocalStorage() {
                // Get input values
                const itemName = document.getElementById("title").value;
                const itemId = document.getElementById("id").value;
                const itemPrice = document.querySelector('input[name="prices"]:checked').value;

                const radio1Selected = document.getElementById('price1').checked;
                const radio2Selected = document.getElementById('price2').checked;
                const radio3Selected = document.getElementById('price3').checked;
                let itemTime = 30; //time is 30 by default
                if (radio1Selected) {
                    itemTime = 30;
                } else if (radio2Selected) {
                    itemTime = 7;
                } else if (radio3Selected) {
                    itemTime = 24;
                }

                // Create an object to represent the cart item
                const cartItem = {
                    title: itemName,
                    id: parseInt(itemId),
                    price: parseFloat(itemPrice),
                    time: itemTime
                };

                // Retrieve existing items from localStorage
                const existingItems = JSON.parse(localStorage.getItem("cartItems")) || [];

                // Add the new item to the array
                existingItems.push(cartItem);

                // Save the updated array back to localStorage
                localStorage.setItem("cartItems", JSON.stringify(existingItems));

                let notification = "<div class='notification-wrap'>";
                notification += "<p class='notification'>Added " +  cartItem.title + " to the basket</p>"
                notification += "</div>";
                document.getElementById("notifications").innerHTML = notification;

                //displayItems();
                //localStorage.clear();
            }

            function addPurchasedToLocalStorage() {
                // Get input values
                const itemName = document.getElementById("title").value;
                const itemId = document.getElementById("id").value;
                const itemPrice = document.getElementById("price").value;

                let itemTime = 0;

                // Create an object to represent the cart item
                const cartItem = {
                    title: itemName,
                    id: parseInt(itemId),
                    price: parseFloat(itemPrice),
                    time: itemTime
                };

                // Retrieve existing items from localStorage
                const existingItems = JSON.parse(localStorage.getItem("cartItems")) || [];

                // Add the new item to the array
                existingItems.push(cartItem);

                // Save the updated array back to localStorage
                localStorage.setItem("cartItems", JSON.stringify(existingItems));

                let notification = "<div class='notification-wrap'>";
                notification += "<p class='notification'>Added " +  cartItem.title + " to the basket</p>"
                notification += "</div>";
                document.getElementById("notifications").innerHTML = notification;

                //displayItems();
                //localStorage.clear();
            }

            function displayItems() {
                // Retrieve items from localStorage
                const items = JSON.parse(localStorage.getItem("cartItems")) || [];

                // Display items in a list
                let list = "<ul>";
                items.forEach(function(item) {
                    list += "<li>" + item.title + " - $" + item.price.toFixed(2) + " - Time: " + item.time + "</li>";
                });
                list += "</ul>";

                // Display the list in the HTML
                document.getElementById("notifications").innerHTML = list;
            }
        </script>
</div>

<?php
    }
    require_once "../php/footer.php";
    ?>

</body>
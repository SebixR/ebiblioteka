<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Checkout</title>
    <link rel="stylesheet" href="../css/checkout.css">
</head>
<body>

<div class="main">
    <header>
        <?php
        require_once '../php/topnav.php';
        ?>
    </header>

    <?php
    if (isset($_SESSION["user_id"])) {
    $user_id = $_SESSION["user_id"];
    ?>

    <form method="post" action="../php/checkout.php">
        <?php
        echo "<input name='user_id' type='hidden' value=$user_id>";
        ?>
        <script>
            function displayTotalPrice()
            {
                const items = JSON.parse(localStorage.getItem("cartItems")) || [];
                let price = 0;
                items.forEach(function(item) {
                    price += item.price;
                });

                price = price.toFixed(2);

                document.getElementById("total").innerHTML = "Total: " + price + " $";
            }

            function changeButtonText(labelId) {
                const labelText = document.getElementById(labelId).textContent;

                const button = document.getElementById("choose_bank");

                if (button && labelText) {
                    button.textContent = labelText;
                }
            }
        </script>

        <div class="methods">
            <label class="radio-inputs">
                <input type="radio" name="methods" value="1" checked="checked">
                <span class="radio-indicator"></span>
            </label>

            <div class="online-transfer">
                <h3>Online Transfer</h3>
                <label>Choose your bank: </label>
                <button type="button" class="dropdown-button" id="choose_bank">Choose bank</button>
                <div class="dropdown-content">
                    <label id="label1" onclick="changeButtonText('label1')">Bank 1</label>
                    <label id="label2" onclick="changeButtonText('label2')">Bank 2</label>
                    <label id="label3" onclick="changeButtonText('label3')">Bank 3</label>
                    <label id="label4" onclick="changeButtonText('label4')">Bank 4</label>
                    <label id="label5" onclick="changeButtonText('label5')">Bank 5</label>
                </div>
            </div>

            <hr>

            <script>
                const coll = document.getElementsByClassName("dropdown-button");
                let i;

                for (i = 0; i < coll.length; i++) {
                    coll[i].addEventListener("click", function() {
                        this.classList.toggle("active");
                        const content = this.nextElementSibling;
                        if (content.style.display === "flex") {
                            content.style.display = "none";
                        } else {
                            content.style.display = "flex";
                        }
                    });
                }
            </script>

            <label class="radio-inputs">
                <input type="radio" name="methods" value="2">
                <span class="radio-indicator"></span>
            </label>

            <div class="card">
                <h3>Debit/Credit Card</h3>
                <label>Fill in the fields: </label>
                <div class="card-inputs">
                    <div class="card-inputs-row">
                        <input type="text" name="name_lastname" placeholder="Full Name">
                        <input type="text" name="card_number" placeholder="Card Number">
                    </div>

                    <div class="card-inputs-row">
                        <input type="text" name="exp_date" placeholder="Expiration date (MM/YY)">
                        <input type="text" name="safety_number" placeholder="Security Code">
                    </div>
                </div>
            </div>


            <hr>

            <label class="radio-inputs">
                <input type="radio" name="methods" value="3">
                <span class="radio-indicator"></span>
            </label>
            <div class="paypal">
                <h3>PayPal</h3>
                <label>Enter you email: </label>
                <input type="text" name="email" placeholder="Email">
            </div>

            <hr>

            <div class="bottom">
                <label id="total"></label>
                <button type="submit" name="pay" class="pay">Pay</button>

                <script>
                    displayTotalPrice()
                </script>
            </div>

        </div>

        <script>
            function displayItems() {
                // Retrieve items from localStorage
                const items = JSON.parse(localStorage.getItem("cartItems")) || [];

                // Display items in a list
                let list = "<div class='items'>";
                items.forEach(function(item) {
                    list += "<div class='item-wrap'>";
                    list += "<label class='item-content' style='width: 33%'>" + item.title + " </label>";
                    list += "<label class='item-content' style='width: 33%'>" + item.price.toFixed(2) + " $</label>"
                    if (parseInt(item.time) === 0)
                    {
                        list += "<label class='item-content' style='width: 33%'>Forever</label>"
                    }
                    else if (parseInt(item.time) === 30 || parseInt(item.time) === 7)
                    {
                        list += "<label class='item-content' style='width: 33%'>" + item.time + " Days</label>"
                    }
                    else list += "<label class='item-content' style='width: 33%'>" + item.time + " Hours</label>"
                    list += "</div>";
                    list += "<input name='book_id[]' type='hidden' value=" + item.id + ">";
                    list += "<input name='book_price[]' type='hidden' value=" + item.price + ">";
                    list += "<input name='book_time[]' type='hidden' value=" + item.time + ">";
                });
                list += "</div>";

                // Display the list in the HTML
                document.getElementById("basket-wrap").innerHTML = list;
            }
        </script>

        <div class="basket-reminder" id="basket">
            <h3>
                Your Order:
            </h3>

            <div id="basket-wrap">
                <script>
                    displayItems();
                </script>
            </div>
        </div>
    </form>

        <?php
    }
    ?>
</div>
<?php
require_once "../php/footer.php";
?>

</body>

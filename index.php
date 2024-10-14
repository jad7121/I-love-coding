<?php
session_name('customer_session');
session_start();
include ('conn.php');

$query = "SELECT * FROM food_items";
$result = $conn->query($query);

function displayCart() {
    if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
        echo "<p>Cart is empty.</p>";
    } else {
        $total = 0;
        foreach ($_SESSION['cart'] as $index => $item) {
            echo "
            <li class='cart-item'>
            {$item['name']} - {$item['quantity']} x GH₵{$item['price']} 
            <button class='remove-button' onclick='removeFromCart({$index})'>X</button>
            </li>";
            $total += $item['price'] * $item['quantity'];
        }
        echo "<p>Total: GH₵ {$total}</p>";
        echo "<p>Items: " . count($_SESSION['cart']) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title>WoWFood | HOME</title>
        <?php include('nav.php');?>
    </head>
<body>
   

    <!-- Food search section starts here -->
    <section class="food-search text-center">
        <div class="container">
            <form action="index.php" method="get">
                <input type="search" name="search" placeholder="Search for food ...">
                <input type="submit" name="submit" value="search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!-- Food search section ends here -->

    <!-- Categories section starts here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">EXPLORE FOOD</h2>
            <a href="#"><div class="box-3 float container"><img src="Images/pizza.jpg" alt="pizza" class="img-responsive img-curve"><h3 class="float-text text white">PIZZA</h3></div></a>
            <a href="#"><div class="box-3 float container"><img src="Images/burger.jpg" alt="burger" class="img-responsive img-curve"><h3 class="float-text text white">BURGER</h3></div></a>
            <a href="#"><div class="box-3 float container"><img src="Images/menu-momo.jpg" alt="momo" class="img-responsive img-curve"><h3 class="float-text text white">DUMPLINGS</h3></div></a>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories section ends here -->

    <!-- Food menu section starts here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">FOOD MENU</h2>
            <?php while($row = $result->fetch_assoc()): ?>
            <div class="food-menu-box">
                <div class="food-menu-img">
                    <img src="Images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" class="img-responsive img-curve" class="food_image">
                </div>
                <div class="food-menu-description">
                    <h4><?php echo $row['name']; ?></h4>
                    <p class="food-detail"><?php echo $row['description']; ?></p>
                    <br>
                    <p class="food-prices">GH₵ <?php echo $row['price']; ?></p>
                    <br>
                    <button onclick="addToCart(<?php echo $row['id']; ?>)">Add to Cart</button>
                </div>
            </div>
            <?php endwhile; ?>
            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Food menu section ends here -->

    <!-- Cart section starts here -->
    <div class="cart">
        <button class="minimize-button" onclick="toggleCart()">Hide Cart</button>
        <div id="cart-content">
            <h2>Cart</h2>
            <hr>
            <ul id="cart-items">
                <?php displayCart(); ?>
            </ul>
            <button onclick="clearCart()">Clear Cart</button>
            <button onclick="showPaymentOptions()">Proceed to Payment</button>
            <button onclick="placeOrder()">Place Order</button>
        </div>
    </div>

    <div id="payment-modal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closePaymentOptions()">&times;</span>
            <h2>Payment Options</h2>
            <button onclick="payWithMoMo()">Pay with Mobile Money</button>
            <button onclick="payWithPayPal()">Pay with PayPal</button>
        </div>
    </div>
    <!-- Cart section ends here -->

    <!-- Social section starts here -->
    <section class="social">
        <div class="container text-center">
            <ul>
                <li><a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a></li>
                <li><a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a></li>
                <li><a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a></li>
            </ul>
        </div>
    </section>
    <!-- Social section ends here -->

    <!-- Footer section starts here -->
    <section class="footer">
        <div class="container text-center">
            <p> All rights reserved. Designed by <a href="#">Group 4 members</a></p>
        </div>
    </section>
    <!-- Footer section ends here -->

    <script>
        function toggleCart() {
            var cartContent = document.getElementById("cart-content");
            if (cartContent.classList.contains("minimized")) {
                cartContent.classList.remove("minimized");
                document.querySelector(".minimize-button").innerText = "Minimize Cart";
            } else {
                cartContent.classList.add("minimized");
                document.querySelector(".minimize-button").innerText = "Show Cart";
            }
        }

    </script>
     <script src="js/script.js"></script>
</body>
</html>

<?php $conn->close(); ?>

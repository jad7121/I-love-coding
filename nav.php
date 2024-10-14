<?php
echo'
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/custom.css">

        <div class="container">
            <div class="logo">
                <a href="index.php">
                    <img src="Images/logo.png" alt="Restaurant logo" class="img-responsive">
                </a>
            </div>
            <div class="menu text-right">
                <ul>
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="faq.php">FAQ</a></li>
                    <li><a href="contact.php">CONTACT</a></li>';
                  
                    //Check for logged in session of Customer
                    if (!isset($_SESSION['customer_id'])) {
                        echo'<li><a href="login.php"> LOGIN</a></li>';
                        echo'<li><a href="register.php"> REGISTER</a></li>';
                    }else{
                        echo'<li><a href="dashboard.php"> DASHBOARD</a></li>
                        <li><a href="logout.php"> LOGOUT</a></li>';
                    }
                  
               echo'</ul>
            </div>
            <div class="clearfix"></div>
        </div>';
    ?>
<?php

echo'
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/custom.css">

        <div class="container">
            <div class="logo">
                <a href="index.php">
                    <img src="../Images/logo.png" alt="Restaurant logo" class="img-responsive">
                </a>
            </div>
            <div class="menu text-right">
                <ul>';
                    //Check for logged in session of Customer
                    if (!isset($_SESSION['admin_id'])) {
                        echo'<li><a href="admin_login.php"> LOGIN</a></li>';
                        
                        
                    }else{
                            switch ($_SESSION['role']) {
                                case 'kitchen':
                                    echo'<li><a href="kitchen_dashboard.php"> DASHBOARD</a></li>';
                                    break;
                                case 'rider':
                                    echo'<li><a href="rider_dashboard.php"> DASHBOARD</a></li>';
                                    break;
                                default:
                                echo'<li><a href="management_dashboard.php"> DASHBOARD</a></li>';
                            }
                         
                        
                        if ($_SESSION['role'] == 'management') {
                            echo'<li><a href="admin_register.php"> ADD USER</a></li>';
                            }
                       echo'<li><a href="logout.php"> LOGOUT</a></li>';
                    }
                  
               echo'</ul>
            </div>
            <div class="clearfix"></div>
        </div>';
    ?>
<?php
session_name('customer_session');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('nav.php'); ?>
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
     
    <div class="contact-us-section">
        <h1>Contact Us</h1>
        <form id="contactForm">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Message</label>
                <textarea id="message" name="message" rows="4" required></textarea>
            </div>
            <button type="submit">Submit</button>
        </form>
        <div id="confirmationMessage" class="hidden">
            <p>Thank you for contacting us! We will get back to you shortly.</p>
        </div>
    </div>
     <!--social section starts here -->
   <section class="social">
    <div class="container text-center">
        
        <ul>
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/50/000000/facebook-new.png"/></a>
            </li>
    
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/instagram-new.png"/></a>
            </li>
    
            <li>
                <a href="#"><img src="https://img.icons8.com/fluent/48/000000/twitter.png"/></a>
            </li>
        </ul>
    </div>
       </section>
       
       <!--social section ends here -->
    
    
          <!--footer section starts here -->
    <section class="footer">
    <div class="container text-center">
        <p> All rights reserved. Designed by <a href="#">Group 4 members</a></p>
    </div>
    </section>
    
    <!--footer section ends here -->
    <script src="script.js"></script>
</body>
</html>

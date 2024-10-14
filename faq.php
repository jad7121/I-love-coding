<?php
session_name('customer_session');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<?php include('nav.php'); ?>
    <title>FAQ Section</title>

</head>
<body>
     
    <div class="faq-section">
        <h1>Frequently Asked Questions</h1>
        <div class="faq-item">
            <div class="faq-question">How do I place an order?</div>
            <div class="faq-answer">To place an order, browse our menu, select your desired items, and add them to your cart. Once you're ready, proceed to checkout and follow the instructions to complete your order.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">What payment methods do you accept?</div>
            <div class="faq-answer">We accept various payment methods including credit cards, debit cards, and online payment options like PayPal and Apple Pay.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">What should I do if there is a delivery delay?</div>
            <div class="faq-answer">If there is a delivery delay, please contact our customer service team with your order details. We will investigate the issue and provide you with an update as soon as possible.</div>
        </div>
        <div class="faq-item">
            <div class="faq-question">Can I order for takeaway?</div>
            <div class="faq-answer">Yes, you can order for takeaway. Select the takeaway option during checkout and choose your preferred pickup time.</div>
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

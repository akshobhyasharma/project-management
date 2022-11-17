<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BYSAP: Contact Form</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" href="scss/main.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <link rel="shortcut icon" href="images/logo/logo1.svg" type="image/x-icon">
</head>

<body>
  <!--<body class="checkout-body">-->
  <!-- primary-navigation-bar -->
  <?php
  include 'nav-bar.php';
  ?>
  <?php include 'secondary-nav.php'; ?>
  <?php include 'sidebar.php' ?>


  <!-- slider-integrated-with-secondary-navigation -->
  <div class="slide-row">
    <div id="carouselExampleControls" class="carousel slide h-100" data-bs-ride="carousel">
      <div class="carousel-inner contact-banner">
        <div class="carousel-item active h-100">
          <img src="images/banner/contact.jpg" alt="Contact-Banner">
        </div>
      </div>
    </div>
  </div>

  <!-- Entire page container starts here -->
  <div class="container contact-container">

    <div class="row">
      <div class="col-lg-6 col-12 pe-lg-5 contact-icon">
        <h2 class="mb-5">How to Find us?</h2>
        <p><strong>If you have any questions, just fill in the contact form and we will answer you shortly.</strong></p>
        <i class='fas fa-map-marker-alt fa-2x pe-4 mt-4'></i>Cleckhuddersfax<br></br>
        <i class='fas fa-phone fa-2x pe-3'></i>+44 7911 2536<br></br>
        <i class="fa fa-envelope fa-2x pe-3"></i>bysap21@gmail.com<br></br>
      </div>

      <div class="col-lg-6 col-12 mt-lg-0 mt-5">
        <h2>Get In Touch</h2>

        <!-- Display error message if query fails to send -->
        <?php
        if (isset($_SESSION['query-failed'])) {
          echo '<p style = "color: red; text-align: center; ">' . $_SESSION["query-failed"] . '</p>';
        }

        else if(isset($_SESSION['query-pass'])){
          echo '<p style = "color:green; text-align:center;">'.$_SESSION["query-pass"].'</p>';
        }

        ?>
        <!-- Form to store and send the customer query -->
        <form class="contact-form" id="contact-form" method="post" action="contact_process.php">

          <input class="contact-input border border-2 border-top-0 border-start-0 border-end-0" type="text" id="name" name="name" placeholder="Full Name" required>

          <input class="contact-input border border-2 border-top-0 border-start-0 border-end-0" type="email" id="email" name="email" placeholder="Email Address" required>

          <textarea class="contact-textarea border border-2 border-top-0 border-start-0 border-end-0" rows="6" placeholder="Message" id="message" name="message" required></textarea>

          <input type="checkbox" required> I accept all the Terms of Service
          <br>
          <button class="contact-button mt-3" type="submit" id="submit" name="contactsubmit">Send</button>
        </form>
      </div>
    </div>
    <h2 class="mt-5 mb-4"> Meet Us</h2>
  </div>

  <div class="w-100 mt-2">
    <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d2965.0824050173574!2d-93.63905729999999!3d41.998507000000004!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sWebFilings%2C+University+Boulevard%2C+Ames%2C+IA!5e0!3m2!1sen!2sus!4v1390839289319" width="100%" height="450px" frameborder="0"></iframe>
  </div>
  <?php
  include 'footer.php';
  ?>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

  <script src="js/tooltip.js"></script>
  <?php
  unset($_SESSION['query-failed']);
  ?>
</body>

</html>
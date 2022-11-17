<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="scss/main.css?v=<?php echo time(); ?>">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="scss/main.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="images/logo/logo1.svg" type="image/x-icon">


    <title>Bysap: HELP</title>
</head>

<body>
    <?php include 'nav-bar.php' ?>
    <?php include 'secondary-nav.php' ?>
    <?php include 'sidebar.php' ?>

    <section class="services py-5 bg-light">
        <div class="container">
            <h3 class="pb-3">Hello. What can we help with you?</h3>
            <hr class="serviceshr">
            <h4 class="pb-5">Some things you can do here.</h4>

            <div class="row pb-3 ">
                <div class="col-lg-4 mb-3">
                    <div class="cardbody text-center">
                        <div class="card-body  card-service">
                            <div class="circle">
                                <span><a href="contact.php"><i class="fas fa-phone-alt"></i></a></span>
                            </div>
                            <h4 class="font-weight-bold pb-2">Contact</h4>
                            <p>Contact us for any Queries.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="cardbody text-center">
                        <div class="card-body  card-service">
                            <div class="circle">
                                <span><i class="fas fa-code"></i></span>
                            </div>
                            <h4 class="font-weight-bold pb-2">Responsive Design</h4>
                            <p>Shop and search for products from anywhere using any devices.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="cardbody text-center">
                        <div class="card-body  card-service">
                            <div class="circle">
                                <span><a><i class="fas fa-boxes"></i></a></span>
                            </div>
                            <h4 class="font-weight-bold pb-2">Your Orders</h4>
                            <p>Track Packages. Edit or Cancel Order.</p>
                        </div>
                    </div>
                </div>


            </div>
            <div class="row pb-3 ">
                <div class="col-lg-4 mb-3">
                    <div class="cardbody text-center">
                        <div class="card-body  card-service">
                            <div class="circle">
                                <span><a><i class="fas fa-users"></i></a></span>
                            </div>
                            <h4 class="font-weight-bold pb-2">Your Account</h4>
                            <p>Manage your account preferences
                            </p>

                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="cardbody text-center">
                        <div class="card-body  card-service">
                            <div class="circle">
                                <span><i class="fas fa-map-marker-alt"></i></span>
                            </div>
                            <h4 class="font-weight-bold pb-2">Collection Point</h4>
                            <p>Collect your ordered items at our collection spot.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-3">
                    <div class="cardbody text-center">
                        <div class="card-body  card-service">
                            <div class="circle">
                                <span><a href="https://www.paypal.com/np/home" target="_blank"><i class="fa fa-paypal"></i></a></span>
                            </div>
                            <h4 class="font-weight-bold pb-2">Safe Payment</h4>
                            <p>Make your Payment through PayPal.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

    </section>

    <?php include 'footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/04614f4329.js" crossorigin="anonymous"></script>
</body>

</html>
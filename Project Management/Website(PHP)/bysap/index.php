<?php
session_start();
include 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BYSAP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="scss/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" href="images/logo/logo1.svg" type="image/x-icon">
</head>

<body>
    <!-- primary-navigation-bar -->
    <?php
    include 'nav-bar.php';

    //Check if the session or cookie stored is of Customer or Trader
    if (isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'Trader') {
            header('location: trader_interface.php');
        }
    } else if (isset($_COOKIE['role'])) {
        if ($_COOKIE['role'] == 'Trader') {
            header('location: trader_interface.php');
        }
    }

    ?>

    <!-- slider-integrated-with-secondary-navigation -->
    <div class="slide-row">
        <div id="carouselExampleControls" class="carousel slide h-100" data-bs-ride="carousel">
            <div class="carousel-inner h-100">
                <div class="carousel-item active h-100">

                    <img src="images/banner/a1.svg" class="slide-image" alt="banner1">
                </div>
                <div class="carousel-item h-100">
                    <img src="images/banner/a2.svg" class="slide-image" alt="banner2">
                </div>
                <div class="carousel-item h-100">
                    <img src="images/banner/a3.svg" class="slide-image" alt="banner3">
                </div>
                <!-- secondary-menu -->
                <nav class="navbar inner-navbar top-navbar navbar-expand-md px-4 py-0">
                    <a class="custom-font nav-link text-dark position-relative mag" data-bs-toggle="offcanvas" href="#sideBar" role="button" aria-controls="offcanvasExample">
                        <i class="fas fa-bars pe-3 fa-1x"></i><span class="thislink">All</span></a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#secondaryNavbar" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fas fa-bars fab"></i>
                    </button>
                    <div class="collapse navbar-collapse pb-2" id="secondaryNavbar">
                        <ul class="navbar-nav sec-navbar mb-lg-0 d-flex w-100 ">
                            <li class="nav-item ms-lg-0 ms-3 me-lg-0 me-auto">
                                <a class="custom-font nav-link text-dark underline-dark position-relative" href="#todaysdeals">Today's deals</a>
                            </li>
                            <li class="nav-item ms-lg-0 ms-3 me-lg-0 me-auto">
                                <a class="custom-font nav-link text-dark underline-dark position-relative" href="stories.php">Stories</a>
                            </li>
                            <li class="nav-item ms-lg-0 ms-3 me-lg-0 me-auto">
                                <a class="custom-font nav-link text-dark underline-dark position-relative" href="services.php">Customer Services</a>
                            </li>
                            <li class="nav-item ms-lg-0 ms-3 me-lg-0 me-auto">
                                <a class="custom-font nav-link text-dark underline-dark position-relative" href="contact.php">Contact</a>
                            </li>
                            <li class="nav-item ms-lg-auto ms-3 me-lg-0 me-auto">
                                <a class="custom-font nav-link text-dark underline-dark position-relative" href="views.php">BYSAP's View on COVID-19</a>
                            </li>
                        </ul>
                    </div>

                </nav>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <!-- side-bar-components -->
    <?php include 'sidebar.php' ?>


    <div class="container py-4 mt-4">
        <div class="row g-3">
            <!-- left-hand column -->
            <div class="col-lg-9 col-12">
                <div class="row g-3">
                    <?php
                    if (isset($_COOKIE['id'])) {
                        $user_id = $_COOKIE['id'];
                    } else if (isset($_SESSION['id'])) {
                        $user_id = $_SESSION['id'];
                    }
                    $query = 'SELECT DISTINCT category FROM bysap.Product';
                    $result = oci_parse($connection, $query);
                    oci_execute($result);
                    if ($result) {
                        while ($data = oci_fetch_array($result)) {
                            echo '<div class="col-md-4 col-sm-6 mb-sm-0 mb-2">
                            <div class="card h-100 p-0">
                            <a class="d-inline-block h-100 w-100 img-link position-relative overflow-hidden dec-none">
                            <div class="image-overlay position-absolute rounded"></div>
                            
                            <img class=" resp-img" src="images/banner/' . $data['CATEGORY'] . '.jpg" alt="' . $data['CATEGORY'] . '">
                            <p class="h4 position-absolute dark-text">' . $data['CATEGORY'] . '</p>
                            <div id = ' . $data['CATEGORY'] . ' class="d-block btn btn-light rounded-pill position-relative w-50 mx-auto shop">Shop Now</div>
                            </a>
                            </div>
                        </div>';
                        }
                    }

                    ?>

                    <div class="col-md-4 col-sm-6 mb-sm-0 mb-2">
                        <div class="card h-100 p-0">
                            <div class="d-inline-block h-100 w-100 img-link position-relative overflow-hidden dec-none">
                                <img class=" resp-img" src="images/banner/banner2.svg" alt="banner1">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- right hand column -->
            <div class="col-lg-3 col-12 d-flex flex-column">
                <!-- button-container -->
                <div>
                    <div class="card d-flex flex-column p-3 text-center p-0 h-100">
                        <p class="h4">Sign In for best experience</p>

                        <?php

                        if (!isset($user_id)) {
                            echo '<div class="btn btn-dark w-65 d-inline-box mx-auto"> <a class="text-light dec-none" href="signin.php">Sign In</a></div>';
                        }
                        ?>
                    </div>
                </div>
                <!-- ad-container -->
                <div class="flex-grow-1 mt-sm-3 mt-2 col-lg-12 col-md-6 col-sm-8 col-12 mx-xl-0 mx-auto">
                    <div class="card p-0 h-100">
                        <img class="resp-img" src="images/banner/banner.svg" alt="banner2">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- trending-section -->


    <div class="container my-4 pb-4">
        <?php

        if (isset($_SESSION['remove_cart_item'])) {
            echo '<p style = "color: red; text-align: center; ">' . $_SESSION["remove_cart_item"] . '</p>';
        } else if (isset($_SESSION['cart_success'])) {
            echo '<p style = "color: green; text-align: center; ">' . $_SESSION["cart_success"] . '</p>';
        }
        ?>
        <h3>Trending Products</h3>
        <hr class="border border-1 border-dark mb-4">
        <div class="row g-4">
            <?php

            if (isset($user_id)) {
                $statement100 = "SELECT cart_id FROM bysap.cart WHERE user_id = $user_id";
                $result100 = oci_parse($connection, $statement100);
                oci_execute($result100);
                $data100 = oci_fetch_array($result100);
            }

            $query1 = 'SELECT r.product_id, product_name, price, discount, category, avg(rating) as avg FROM bysap.Product p, bysap.Review r WHERE p.product_id = r.product_id GROUP BY r.product_id, product_name, price, discount, category ORDER BY avg(rating) DESC';

            $result1 = oci_parse($connection, $query1);
            oci_execute($result1);

            $count =  1;

            while ($data = oci_fetch_array($result1)) {
                if ($count < 9) {
                    echo '<div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="card jump h-100">
                                <a href = "prod_description.php?id=' . $data['PRODUCT_ID'] . '"><img class="card-img-top" class=" resp-img" src="images/' . $data['CATEGORY'] . '/' . $data['PRODUCT_NAME'] . '.jpg" alt="' . $data['PRODUCT_NAME'] . '"></a> 
                                <div class="card-body p-4">
                                    <div class="d-flex mb-3 index-heart">
                                        <h6 class="card-title">' . $data['PRODUCT_NAME'] . '</h6>';


                    if (isset($user_id)) {

                        $statement200 = "SELECT * FROM bysap.cart_items WHERE cart_id = $data100[CART_ID] AND product_id =$data[PRODUCT_ID] AND wishlist = 'Yes'";
                        $result200 = oci_parse($connection, $statement200);
                        oci_execute($result200);
                        $data200 = oci_fetch_array($result200);

                        if ($data200) {
                            echo '<a href="add_to_wishlist.php?id=' . $data['PRODUCT_ID'] . '&cart_id=' . $data100['CART_ID'] . '"> <i class="fas fa-heart fill d-inline-block ms-auto mag cursor-pointer name-' . $data['PRODUCT_ID'] . '"></i></a>';
                        } else {
                            echo '<a href="add_to_wishlist.php?id=' . $data['PRODUCT_ID'] . '&cart_id=' . $data100['CART_ID'] . '"> <i class="far fa-heart fill d-inline-block ms-auto mag cursor-pointer name-' . $data['PRODUCT_ID'] . '"></i></a>';
                        }
                    }

                    echo '</div>';

                    if ($data['DISCOUNT']) {
                        $price = $data['PRICE'] - ($data['DISCOUNT'] / 100) * $data['PRICE'];
                        echo '<p class="mb-1">&pound ' . number_format($price, 2) . '</p>';
                        echo '<p class="mb-1"><span class="text-danger"><strike>&pound ' . number_format($data['PRICE'], 2) . '</strike></span><span class="text-success"> (' . $data['DISCOUNT'] . '% OFF)</span></p>';
                    } else {
                        echo '<p class="mb-1">&pound ' . number_format($data['PRICE'], 2) . '</p>';
                    }

                    echo '<p>';
                    if ($data) {
                        $rating = $data['AVG'];
                        $i = 0;
                        while ($i < 5) {

                            if ($rating > 0) {
                                if ($rating == 0.5) {
                                    echo '<i class="fas fa-star-half-alt"></i> ';
                                } else {
                                    echo '<i class="fas fa-star"></i> ';
                                }
                            } else {
                                echo '<i class="far fa-star"></i> ';
                            }

                            $rating--;
                            $i++;
                        }
                    } else {
                        echo '<i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>';
                    }
                    echo '</p>
            </div>
        </div>
    </div>';
                    $count++;
                } else {
                    break;
                }
            }

            ?>

        </div>
    </div>

    <!-- today's-deals-section -->
    <div class="container my-4" id="todaysdeals">
        <h3>Today's Deals</h3>
        <hr class="border border-1 border-dark mb-4">
        <div class="row g-4">

            <?php
            $query2 = 'SELECT r.product_id, product_name, price, discount, category, avg(rating) as avg FROM bysap.Product p, bysap.Review r WHERE p.product_id = r.product_id AND DISCOUNT IS NOT NULL GROUP BY r.product_id, product_name, price, discount, category ORDER BY discount DESC';

            $result2 = oci_parse($connection, $query2);
            oci_execute($result2);

            $count = 1;
            while ($data = oci_fetch_array($result2)) {
                if (true) {
                    echo '<div class="col-xl-3 col-lg-4 col-sm-6">
                            <div class="card jump h-100">
                                <a href = "prod_description.php?id=' . $data['PRODUCT_ID'] . '"><img class="card-img-top" src="images/' . $data['CATEGORY'] . '/' . $data['PRODUCT_NAME'] . '.jpg" alt="' . $data['PRODUCT_NAME'] . '"></a> 
                                <div class="card-body p-4">
                                    <div class="d-flex mb-3 index-heart">
                                        <h5 class="card-title">' . $data['PRODUCT_NAME'] . '</h5>';

                    if (isset($user_id)) {

                        $statement200 = "SELECT * FROM bysap.cart_items WHERE cart_id = $data100[CART_ID] AND product_id =$data[PRODUCT_ID] AND wishlist = 'Yes'";
                        $result200 = oci_parse($connection, $statement200);
                        oci_execute($result200);
                        $data200 = oci_fetch_array($result200);

                        if ($data200) {
                            echo '<a href="add_to_wishlist.php?id=' . $data['PRODUCT_ID'] . '&cart_id=' . $data100['CART_ID'] . '"> <i class="fas fa-heart fill d-inline-block ms-auto mag cursor-pointer name-' . $data['PRODUCT_ID'] . '"></i></a>';
                        } else {
                            echo '<a href="add_to_wishlist.php?id=' . $data['PRODUCT_ID'] . '&cart_id=' . $data100['CART_ID'] . '"> <i class="far fa-heart fill d-inline-block ms-auto mag cursor-pointer name-' . $data['PRODUCT_ID'] . '"></i></a>';
                        }
                    }
                    echo ' </div>';

                    if ($data['DISCOUNT']) {
                        $price = $data['PRICE'] - ($data['DISCOUNT'] / 100) * $data['PRICE'];
                        echo '<p class="mb-1">&pound ' . number_format($price, 2) . '</p>';
                        echo '<p class="mb-1"><span class="text-danger"><strike>&pound ' . number_format($data['PRICE'], 2) . '</strike></span> <span class="text-success"> (' . $data['DISCOUNT'] . '% OFF)</span></p>';
                    } else {
                        echo '<p class="mb-1">&pound ' . number_format($data['PRICE'], 2) . '</p>';
                    }

                    echo '<p>';
                    if ($data) {
                        $rating = $data['AVG'];
                        $i = 0;
                        while ($i < 5) {

                            if ($rating > 0) {
                                if ($rating == 0.5) {
                                    echo '<i class="fas fa-star-half-alt"></i> ';
                                } else {
                                    echo '<i class="fas fa-star"></i> ';
                                }
                            } else {
                                echo '<i class="far fa-star"></i> ';
                            }

                            $rating--;
                            $i++;
                        }
                    } else {
                        echo '<i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>
                        <i class="far fa-star"></i>';
                    }
                    echo '</p>
            </div>
        </div>
    </div>';
                    $count++;
                } else {
                    break;
                }
            }
            ?>
        </div>
    </div>

    <!-- footer -->
    <?php
    include 'footer.php';
    ?>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


    <script src="js/homepage.js"></script>
    <script src="js/tooltip.js"></script>

    <?php
    unset($_SESSION['remove_cart_item']);
    unset($_SESSION['cart_success']);

    ?>
</body>

</html>
<?php
//Start session to store and retrieve the variables stored in session
session_start();

//Get the user id stored in cookie or session
if (isset($_COOKIE['id'])) {
    $user_id = $_COOKIE['id'];
} else if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
}

//Include connection.php file to connect to Oracle database
include 'connection.php';
//Get the product id from the URL
$id = $_GET['id'];

//Query to fetch all the details of the selected products 
$sql = "SELECT r.product_id, product_name, shop_name, price, discount, category, stock, description, allergy_information, avg(rating) as avg FROM bysap.Product p, bysap.Review r, bysap.Shop s WHERE p.product_id = r.product_id AND s.shop_no = p.shop_no GROUP BY r.product_id, product_name, shop_name, price, discount, category,  stock, description, allergy_information HAVING r.product_id = $id";

$result = oci_parse($connection, $sql);
oci_execute($result);
$data = oci_fetch_array($result);

//Query to fetch the details of product having no reviews
if (!$data) {
    $sql = "SELECT * FROM bysap.Product p, bysap.Shop s WHERE s.shop_no = p.shop_no AND p.product_id = $id";
    $result = oci_parse($connection, $sql);
    oci_execute($result);
    $data = oci_fetch_array($result);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product: <?php echo $data['PRODUCT_NAME'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="scss/main.css?v=<?php echo time(); ?>">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="shortcut icon" href="images/logo/logo1.svg" type="image/x-icon">
</head>

<body>

    <div class="overlay">
        <div class="popup">
            <img src="images/banner/review.png">
            <div class="content">
                <p>Your review was successful.</p>
                <button type="button" class="modal_button cancel">Cancel</button>
            </div>
        </div>
    </div>

    <div class="overlay-2">
        <div class="popup">
            <img src="images/banner/reviewerror.jpg">
            <div class="content">
                <h5>ERROR!</h5>
                <p>This item has already been reviewed.</p>
                <button type="button" class="modal_button-2 cancel2">Cancel</button>
            </div>
        </div>
    </div>

    <?php include 'nav-bar.php' ?>
    <?php include 'secondary-nav.php' ?>
    <?php include 'sidebar.php' ?>

    <div class="container">
        <?php
        $result1 = oci_parse($connection, $sql);
        oci_execute($result1);
        $data1 = oci_fetch_array($result1);
        ?>
        <div class="row py-3 pt-5 w-100 mx-auto main-row">
            <div class="col-xl-1 col-md-2 col-sm-12 p-0 me-3">
                <div class="d-flex flex-md-column flex-sm-row justify-content-between h-100">
                    <div>
                        <img alt="<?php $data1['PRODUCT_NAME'] ?>" class="resp-img border border-2 rounded shadow-sm mag-sm disp-img-1 dimmed all-disp-img disp-img"  src="images/<?php echo $data1['CATEGORY']; ?>/<?php echo $data1['PRODUCT_NAME']; ?>.jpg" alt="<?php echo $data1['PRODUCT_NAME']; ?>">
                    </div>
                    <?php
                    $sql2 = "SELECT image_name FROM bysap.Images WHERE product_id = $id";

                    $result3 = oci_parse($connection, $sql2);
                    oci_execute($result3);
                    $count = 1;
                    while ($data3 = oci_fetch_assoc($result3)) {
                        $count++;
                        echo ' <div>
                        <img alt="" class="resp-img border border-2 rounded shadow-sm mag disp-img-' . $count . ' dimmed all-disp-img disp-img" src="images/' . $data1['CATEGORY'] . '/' . $data3['IMAGE_NAME'] . '.jpg">
                    </div>';
                    }

                    ?>
                </div>
            </div>
            <div class="col-xl-4 col-lg-5 col-md-6 col-sm-12 me-3 pt-md-0 pt-5 px-0 image_container">
                <img class="resp-img border border-2 rounded shadow-sm disp-main" src="images/<?php echo $data1['CATEGORY']; ?>/<?php echo $data1['PRODUCT_NAME']; ?>.jpg" alt="<?php echo $data1['PRODUCT_NAME']; ?>">
            </div>

          
            <div class="col-xl-5 col-lg-6 col-md-8 col-sm-12 mt-lg-0 mt-4 px-0 ms-lg-3 desc-class shadow-sm rounded">

                <div class="col h-100">
                <?php
                    if (isset($_SESSION['cart_success'])) {
                        echo '<p class="mt-3 text-center" style = "color: green;">' . $_SESSION["cart_success"] . '</p>';
                    } else if (isset($_SESSION['cart_failure'])) {
                        echo '<p class="mt-3 text-center" style = "color: red;">' . $_SESSION["cart_failure"] . '</p>';
                    }
                    ?>

                    <p class="mb-2"><?php echo $data1['SHOP_NAME'] ?></p>
                    <p class="h4 fw-bold mb-2"><?php echo $data1['PRODUCT_NAME'] ?></p>

                    <div class="bottom-border pb-2">

                        <?php
                        if ($data1 && isset($data1['AVG'])) {

                            $rating = $data1['AVG'];
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

                        ?>
                        <span class="d-inline-block ps-3">
                            <?php
                            $sql2 = "SELECT count(rating) AS count FROM bysap.Review GROUP BY product_id having product_id = $data1[PRODUCT_ID]";

                            $result2 = oci_parse($connection, $sql2);
                            oci_execute($result2);
                            $data2 = oci_fetch_array($result2);

                            if ($data2) {

                                echo "($data2[COUNT] rating/s)";
                            } else {
                                echo '(0 rating)';
                            }
                            ?>
                        </span>
                    </div>
                    <div class="pt-2">
                        <?php
                        if ($data1['DISCOUNT']) {
                            $price = $data1['PRICE'] - ($data1['DISCOUNT'] / 100) * $data1['PRICE'];
                            echo '<div><span class="fw-bold">Price: </span><p class="mb-1 d-inline">&pound ' . number_format($price, 2) . '</p></div>';
                            echo '<div><span class="fw-bold">Discount: </span><p class="mb-1 d-inline"><span class="text-danger"><strike>&pound ' . number_format($data1['PRICE'], 2) . '</strike></span> <span class="text-success">(' . $data1['DISCOUNT'] . '% OFF)</span></p></div>';
                        } else {
                            $price =  number_format($data1['PRICE'], 2);
                            echo '<div><span class="fw-bold">Price: </span><p class="mb-1 d-inline">&pound ' . $price . '</p></div>';
                        }
                        ?>

                    </div>
                    <form id="buy-form" class="position-relative pt-3" method="POST" action="add_to_cart.php?id=<?php echo $id; ?>">
                        <div class="col-sm-5 col-8 d-flex">
                            <span class="pb-2 fw-bold me-2">Quantity:</span>
                            <div class="d-flex">
                                <div class="quantity-sub"><i class="fas fa-minus"></i></div>

                                <input class="quantity text-center" type="text" value="1" name="quantity">

                                <div class="quantity-add"><i class="fas fa-plus"></i></div>
                            </div>

                        </div>

                        <div class="text-success mt-3">

                            <input type="hidden" name="stock-quantity" class="quantity_count" value="<?php echo $data1['STOCK'] ?>">
                            <?php

                            if ($data1['STOCK'] != 0) {
                                echo "$data1[STOCK] units in stock.";
                            } else {
                                echo '<p class = text-danger>Out of Stock.</p>';
                            }
                            ?>
                        </div>
                        <div class="text-danger">
                            <?php
                            if ($data1['STOCK'] != 0) {
                                if ($data1['STOCK'] >= 20) {
                                    echo "(20 limits per customer).";
                                } else {
                                    echo "($data1[STOCK] limits per customer).";
                                }
                            }
                            ?>
                        </div>
                        <input type="hidden" name="product_id" value="<?php echo $data1['PRODUCT_ID'] ?>">

                        <?php
                        if (!isset($user_id)) {
                            echo '<div class="pt-3">
                            <input class="px-2 py-1 me-3 cart-btn" type="submit" value="Add to Cart" name="addtocart" formaction ="unregistered_cart.php">
                            <input class="px-2 py-1 buy-btn" type="button" value="Buy Now" style = "pointer-event:none;" name="buynow">
                            </div>';
                        } else {
                            echo '<div class="pt-3">
                            <input class="px-2 py-1 me-3 cart-btn" type="submit" value="Add to Cart" name="addtocart">
                            <input class="px-2 py-1 buy-btn" type="submit" value="Buy Now" name="buynow" formaction = "checkout.php?quantity=1&price= ' . $price . '">
                            </div>';
                        }
                        ?>

                    </form>
                  
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-5">
                <h5 class="fw-bold pb-4 m-0">Product Description</h5>
                <p>Greetings from <?php echo "$data1[SHOP_NAME]," ?></p>
                <p class="m-0 mb-4"><?php echo $data1['DESCRIPTION'] ?></p>

                <h6 class="fw-bold mb-3">Allergy Information</h6>
                <p>
                    <?php
                    if ($data1['ALLERGY_INFORMATION']) {
                        echo $data1['ALLERGY_INFORMATION'];
                    } else {
                        echo 'Information not provided by seller.';
                    }

                    ?>
                </p>
            </div>
            <div class="col-xl-5 col-md-6 col-sm-8 ms-md-5">
                <h5 class="fw-bold pb-4 pt-md-0 pt-sm-5">Product Details</h5>
                <div class="row">
                    <div class="col-xl-7 col-sm-9">
                        <div class="mb-1 d-flex justify-content-between">
                            <div class="fw-bold">Category:</div>
                            <div><?php echo $data1['CATEGORY'] ?></div>
                        </div>
                        <div class="mb-1 d-flex justify-content-between">
                            <div class="fw-bold">Shop Name:</div>
                            <div><?php echo $data1['SHOP_NAME'] ?></div>
                        </div>
                        <div class="mb-1 d-flex justify-content-between">
                            <div class="fw-bold">Available Stock:</div>
                            <div><?php echo "$data1[STOCK] units"; ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5 pb-4">
            <div class="col-xl-5 col-md-5 col-sm-7 ">
                <h5 class="fw-bold pb-4">Customer Reviews</h5>
                <div>
                    <?php
                    if ($data1 && isset($data1['AVG'])) {
                        $rating = $data1['AVG'];
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

                    ?>


                    <span class="d-inline-block ps-2 star-text">
                        <?php

                        if (isset($data1['AVG'])) {
                            echo "<span class = 'star-text1'>".number_format($data1['AVG'], 1) . " </span>out of 5 stars";
                        } else {
                            echo '0 out of 5 stars';
                        }
                        ?>


                        <?php
                        if ($data2) {

                            echo "($data2[COUNT] rating/s)";
                        } else {
                            echo '(0 rating)';
                        }
                        ?>
                    </span>

                </div>

                <div class="position-relative d-flex mt-4">
                    <div class="d-inline-block fit-width">5 stars</div>

                    <?php
                    $sql3 = "SELECT round(rating) AS rating, COUNT(*) AS Count FROM bysap.Review WHERE product_id = $id and round(rating) = 5 GROUP BY rating";

                    $sql4  = "SELECT count(*) AS Total FROM bysap.review WHERE product_id = $id";
                    $result4 = oci_parse($connection, $sql4);
                    oci_execute($result4);
                    $data4 = oci_fetch_array($result4);

                    $result3 = oci_parse($connection, $sql3);
                    oci_execute($result3);
                    $data3 = oci_fetch_array($result3);

                    $actualRating = 0;
                    if ($data3) {
                        $actualRating = ($data3['COUNT'] / $data4['TOTAL']) * 100;
                        echo ' <div class="d-inline-block star">
                        <div class="star-indicator-1" style="width:' . $actualRating . '%; z-index:1 !important; "></div>
                        </div>';
                    } else {
                        echo ' <div class="d-inline-block star">
                        <div class="star-indicator-1" style="width: 0%;"></div>
                    </div>';
                    }


                    ?>
                    <span class="d-inline-block ps-2" style="transform: translateX(15px);"><?php echo $actualRating ?>%</span>

                </div>
                <div class="position-relative d-flex">
                    <div class="d-inline-block fit-width">4 stars</div>

                    <?php
                    $sql5 = "SELECT round(rating) AS rating, COUNT(*) AS Count FROM bysap.Review WHERE product_id = $id and round(rating) = 4 GROUP BY rating";

                    $result5 = oci_parse($connection, $sql5);
                    oci_execute($result5);
                    $data5 = oci_fetch_array($result5);

                    $actualRating = 0;
                    if ($data5) {
                        $actualRating = ($data5['COUNT'] / $data4['TOTAL']) * 100;
                        echo ' <div class="d-inline-block star">
                        <div class="star-indicator-1" style="width: ' . $actualRating . '%; z-index:1 !important;"></div>
                        </div>';
                    } else {
                        echo ' <div class="d-inline-block star">
                        <div class="star-indicator-1" style="width: 0%;"></div>
                    </div>';
                    }

                    ?>

                    <span class="d-inline-block ps-2" style="transform: translateX(15px);"><?php echo $actualRating ?>%</span>
                </div>
                <div class="position-relative d-flex">
                    <div class="d-inline-block fit-width">3 stars</div>
                    <?php
                    $sql6 = "SELECT round(rating) AS rating, COUNT(*) AS Count FROM bysap.Review WHERE product_id = $id and round(rating) = 3 GROUP BY rating";

                    $result6 = oci_parse($connection, $sql6);
                    oci_execute($result6);
                    $data6 = oci_fetch_array($result6);

                    $actualRating = 0;
                    if ($data6) {
                        $actualRating = ($data6['COUNT'] / $data4['TOTAL']) * 100;
                        echo ' <div class="d-inline-block star">
                        <div class="star-indicator-1" style="width: ' . $actualRating . '%; z-index:1 !important;"></div>
                        </div>';
                    } else {
                        echo ' <div class="d-inline-block star">
                        <div class="star-indicator-1" style="width: 0%;"></div>
                    </div>';
                    }

                    ?>
                    <span class="d-inline-block ps-2" style="transform: translateX(15px);"><?php echo $actualRating ?>%</span>
                </div>

                <div class="position-relative d-flex">
                    <div class="d-inline-block fit-width">2 stars</div>
                    <?php
                    $sql7 = "SELECT round(rating) AS rating, COUNT(*) AS Count FROM bysap.Review WHERE product_id = $id and round(rating) = 2 GROUP BY rating";

                    $result7 = oci_parse($connection, $sql7);
                    oci_execute($result7);
                    $data7 = oci_fetch_array($result7);

                    $actualRating = 0;
                    if ($data7) {
                        $actualRating = ($data7['COUNT'] / $data4['TOTAL']) * 100;
                        echo ' <div class="d-inline-block star">
                        <div class="star-indicator-1" style="width: ' . $actualRating . '%; z-index:1 !important;"></div>
                        </div>';
                    } else {
                        echo ' <div class="d-inline-block star">
                        <div class="star-indicator-1" style="width: 0%;"></div>
                    </div>';
                    }

                    ?>
                    <span class="d-inline-block ps-2" style="transform: translateX(15px);"><?php echo $actualRating ?>%</span>


                </div>

                <div class="position-relative d-flex">
                    <div class="d-inline-block fit-width">1 star</div>
                    <?php
                    $sql8 = "SELECT round(rating) AS rating, COUNT(*) AS Count FROM bysap.Review WHERE product_id = $id and round(rating) = 1 GROUP BY rating";

                    $result8 = oci_parse($connection, $sql8);
                    oci_execute($result8);
                    $data8 = oci_fetch_array($result8);

                    $actualRating = 0;
                    if ($data8) {
                        $actualRating = ($data8['COUNT'] / $data4['TOTAL']) * 100;
                        echo ' <div class="d-inline-block star">
                        <div class="star-indicator-1" style="width: ' . $actualRating . '%; z-index:1 !important;"></div>
                        </div>';
                    } else {
                        echo ' <div class="d-inline-block star">
                        <div class="star-indicator-1" style="width: 0%;"></div>
                    </div>';
                    }

                    ?>
                    <span class="d-inline-block ps-2" style="transform: translateX(15px);"><?php echo $actualRating ?>%</span>

                </div>
            </div>
        </div>


        <div class="row mt-5 pb-5 bottom-border">
            <h5 class="fw-bold pb-4 m-0">Frequently bought with this item</h5>
            <div class="col">
                <div class="carousel-row freq_carousel">
                    <div class="owl-carousel owl-theme">

                        <?php
                        $sql10 = "SELECT r.product_id, product_name, price, discount,category, AVG(rating) AS avg FROM bysap.Product p, bysap.Review r where p.product_id = r.product_id AND r.product_id != $id GROUP BY r.product_id, product_name, price, discount, category ORDER BY dbms_random.value";
                        $result10 = oci_parse($connection, $sql10);
                        oci_execute($result10);

                        $count = 1;
                        while ($data10 = oci_fetch_array($result10)) {
                            if ($count <= 8) {
                                echo '<div class="card freq_card">
                                    <a href = "prod_description.php?id=' . $data10['PRODUCT_ID'] . '"><img class="card-img-top resp-img" src="images/' . $data10['CATEGORY'] . '/' . $data10['PRODUCT_NAME'] . '.jpg" alt="' . $data10['PRODUCT_NAME'] . '"></a>
                                    <div class="card-body p-4">
                                        <div class="d-flex mb-3">
                                            <h6 class="card-title">' . $data10['PRODUCT_NAME'] . '</h6>
                    
                                        </div>';

                                if ($data10['DISCOUNT']) {
                                    $price = $data10['PRICE'] - ($data10['DISCOUNT'] / 100) * $data10['PRICE'];
                                    echo '<p class="mb-1">&pound ' . number_format($price, 2) . '</p>';
                                    echo '<p class="mb-1"><span class="text-danger"><strike>&pound ' . number_format($data10['PRICE'], 2) . '</strike></span><span class="text-success"> (' . $data10['DISCOUNT'] . '% OFF)</span></p>';
                                } else {
                                    echo '<p class="mb-1">&pound ' . number_format($data10['PRICE'], 2) . '</p>';
                                }

                                echo '<p>';

                                if ($data10 && isset($data10['AVG'])) {

                                    $rating = $data10['AVG'];
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

                                echo ' </p>
                                    </div>
                                </div>';
                            } else {
                                break;
                            }

                            $count++;
                        }


                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 pb-4">
            <div class="col">
                <h5 class="fw-bold pb-3">Top reviews</h5>


                <div>
                    <?php

                    $sql9 = "SELECT fullname, rating, message FROM bysap.Review r, bysap.Users u WHERE u.user_id = r.user_id AND product_id = $id ORDER BY rating DESC";

                    $result9 = oci_parse($connection, $sql9);
                    oci_execute($result9);

                    $message = false;
                    while ($data9 = oci_fetch_array($result9)) {

                        if ($data9) {
                            if ($data9['MESSAGE']) {
                                $message = true;
                                echo '<div class="card_review">';
                                echo '<div class="user_icon">
                            <i class="fas fa-user-circle fa-2x"></i> <span>' . $data9['FULLNAME'] . '</span>
                                 </div>';
                                echo '<div class="mt-2">';

                                if ($data9) {
                                    $rating = $data9['RATING'];
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


                                echo '</div>
    
                        <div class="row text-left">
                            <h6 class="blue-text mt-3">' . $data9['MESSAGE'] . '</h6>
                        </div></div>';
                            }
                        } else {
                            $message  = false;
                        }
                    }
                    if ($message == false) {
                        echo 'No reviews yet.';
                    }

                    ?>


                </div>

            </div>
        </div>
        <div class="row mt-5 pb-4">
            <div class="col-lg-8 col-md-7 col-sm-8">
                <h5 class="fw-bold pb-4">Review this product</h5>

                <?php
                if (isset($user_id)) {
                    echo ' <p class="text-success">Give your rating</p>
                       
                    <form method = "POST" action = "review.php">
                    <div class="pb-4">
                       <div class="rate">
                            <input type="radio" id="5-star" name="rating" value="5" required />
                            <label for="5-star" title="Amazing">5 stars</label>
                            <input type="radio" id="4-star" name="rating" value="4" required/>
                            <label for="4-star" title="Good">4 stars</label>
                            <input type="radio" id="3-star" name="rating" value="3" required/>
                            <label for="3-star" title="Average">3 stars</label>
                            <input type="radio" id="2-star" name="rating" value="2" required/>
                            <label for="2-star" title="Not Good">2 stars</label>
                            <input type="radio" id="1-star" name="rating" value="1" required />
                            <label for="1-star" title="Bad">1 star</label>
                        </div>
                    </div>
                       <br>
                       <p>Write a customer review</p>
                        
                        <input type = "hidden" name = "product_id" value = "' . $id . '">

                        <input type = "hidden" name = "user_id" value = "' . $user_id . '">

                           <textarea class="form-control" placeholder="Write a review" id="floatingTextarea2" name="message" rows="5"></textarea>
                           <input class="px-3 mt-2 float-end send-btn" type="submit" value="Send" name="messagesubmit">
                    </form>';
                } else {
                    echo '<a href = "signin.php"> Sign In</a> or <a href = "register.php">Register</a> to give review.';
                }
                ?>
            </div>
        </div>

    </div>


    <?php include 'footer.php' ?>

    <?php
    if (isset($_SESSION['review_status'])) {
        if ($_SESSION['review_status'] == 'true') {
            echo "<script>
                const modal = document.querySelector('.overlay');
                modal.style.opacity = 1;
                modal.style.pointerEvents = 'all';
                </script>";
        } else if ($_SESSION['review_status'] == 'false') {
            echo "<script>
                const modal2 = document.querySelector('.overlay-2');
                modal2.style.opacity = 1;
                modal2.style.pointerEvents = 'all';
                </script>";
        }
    }

    ?>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="js/owl.js" type="text/javascript"></script>

    <script src="js/superslider.js" type="text/javascript"> </script>
    <script src="js/quantity.js" type="text/javascript"> </script>
    <script>
        const button = document.querySelector('.cancel');
        const button2 = document.querySelector('.cancel2');
        button.addEventListener('click', function() {
            modal.style.opacity = 0;
            modal.style.pointerEvents = 'none';
        });

        button2.addEventListener('click', function() {
            modal2.style.opacity = 0;
            modal2.style.pointerEvents = 'none';
        });
    </script>



    <?php
    unset($_SESSION['review_status']);
    unset($_SESSION['cart_success']);
    unset($_SESSION['cart_failure']);
    ?>

</body>

</html>
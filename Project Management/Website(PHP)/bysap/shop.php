<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BYSAP: <?php echo $_GET['category'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="scss/main.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" href="images/logo/logo1.svg" type="image/x-icon">
</head>

<body>
    <?php
    include 'connection.php';
    include 'nav-bar.php';
    include 'secondary-nav.php';
    include 'sidebar.php';

    //Display the list of products of given category and shop
    if (isset($_GET['category'])) {

        $category = $_GET['category'];
        if (isset($_GET['shop'])) {
            $query = "SELECT * FROM bysap.Product, bysap.Shop WHERE product.shop_no = shop.shop_no AND category = '$category' AND shop_name = '$_GET[shop]'";
        } else {
            $query = "SELECT * FROM bysap.Product WHERE category = '$category'";
        }
    }



    //Display the list of products within the given price range 
    if (isset($_POST['submit'])) {
        if (isset($_POST['min']) && isset($_POST['max'])) {
            $min = $_POST['min'];
            $max = $_POST['max'];

            if ($min < $max) {
                $query = $query . "AND price >= $min AND price <= $max";
            } else if ($min > $max) {
                echo 'Invalid range';
            }
        }
    }




    //Display the list of products of the selected range
    if (isset($_POST['five'])) {
        $query = $query . "AND price < 5";
    }

    if (isset($_POST['ten'])) {
        $query = $query . "AND price < 10";
    }

    if (isset($_POST['twenty'])) {
        $query = $query . "AND price < 20";
    }

    if (isset($_POST['abovetwenty'])) {
        $query = $query . "AND price >= 20";
    }

    //Sorting the list of products 
    if (isset($_POST['arrival'])) {
        $query = $query . "ORDER BY product_id DESC";
    } else if (isset($_POST['low'])) {
        $query = $query . "ORDER BY price";
    } else if (isset($_POST['high'])) {
        $query = $query . "ORDER BY price DESC";
    } else if (isset($_POST['rating'])) {
        if (isset($_GET['shop'])) {
            $query = "SELECT review.product_id,product_name, price, stock, discount, category, avg(rating) FROM bysap.Product, bysap.Shop, bysap.Review WHERE product.shop_no = shop.shop_no AND product.product_id = review.product_id AND category = '$_GET[category]' AND shop_name = '$_GET[shop]' GROUP BY review.product_id, product_name, price, stock, discount, category ORDER BY avg(rating) DESC";
        } else {
            $query = "SELECT review.product_id,product_name, price, stock, discount, category, avg(rating) FROM bysap.Product, bysap.Review WHERE product.product_id = review.product_id AND category = '$_GET[category]' GROUP BY review.product_id, product_name, price, stock, discount, category ORDER BY avg(rating) DESC";
        }
    }

    //Display the list of products based on selected ratings
    if (isset($_POST['fourstar'])) {
        if (isset($_GET['shop'])) {
            $query = "SELECT r.product_id,product_name, price, stock, discount, category, avg(rating) FROM bysap.Product p, bysap.Shop s, bysap.Review r WHERE s.shop_no = p.shop_no AND p.product_id = r.product_id AND category = '$_GET[category]' AND shop_name = '$_GET[shop]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) >= 4";
        } else {
            $query = "SELECT r.product_id,product_name, price, stock, discount, category, avg(rating) FROM bysap.Product p, bysap.Review r WHERE p.product_id = r.product_id AND category = '$_GET[category]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) >= 4";
        }
    } else  if (isset($_POST['threestar'])) {
        if (isset($_GET['shop'])) {
            $query = "SELECT r.product_id,product_name, price, stock, discount, category, avg(rating) FROM bysap.Product p, bysap.Shop s, bysap.Review r WHERE s.shop_no = p.shop_no AND p.product_id = r.product_id AND category = '$_GET[category]' AND shop_name = '$_GET[shop]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) >= 3";
        } else {
            $query = "SELECT r.product_id,product_name, price, stock, discount, category, avg(rating) FROM bysap.Product p, bysap.Review r WHERE p.product_id = r.product_id AND category = '$_GET[category]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) >= 3";
        }
    } else  if (isset($_POST['twostar'])) {
        if (isset($_GET['shop'])) {
            $query = "SELECT r.product_id,product_name, price, stock, discount, category, avg(rating) FROM bysap.Product p, bysap.Shop s, bysap.Review r WHERE s.shop_no = p.shop_no AND p.product_id = r.product_id AND category = '$_GET[category]' AND shop_name = '$_GET[shop]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) >= 2";
        } else {
            $query = "SELECT r.product_id,product_name, price, stock, discount, category, avg(rating) FROM bysap.Product p, bysap.Review r WHERE p.product_id = r.product_id AND category = '$_GET[category]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) >= 2";
        }
    } else  if (isset($_POST['onestar'])) {
        if (isset($_GET['shop'])) {
            $query = "SELECT r.product_id,product_name, price, stock, discount, category, avg(rating) FROM bysap.Product p, bysap.Shop s, bysap.Review r WHERE s.shop_no = p.shop_no AND p.product_id = r.product_id AND category = '$_GET[category]' AND shop_name = '$_GET[shop]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) >= 1";
        } else {
            $query = "SELECT r.product_id,product_name, price, stock, discount, category, avg(rating) FROM bysap.Product p, bysap.Review r WHERE p.product_id = r.product_id AND category = '$_GET[category]' GROUP BY r.product_id, product_name, price, stock, discount, category HAVING avg(rating) >= 1";
        }
    }

    $result = oci_parse($connection, $query);
    oci_execute($result);

    ?>


    <div class="container-fluid">
        <div class="row  py-2 border-bottom shadow-sm">
            <div class="col-auto align-self-center">
                <p class="m-0">

                    <!-- Count the total number of products -->

                    <?php
                    $count = 0;
                    while ($data = oci_fetch_array($result)) {
                        $count++;
                    }
                    if ($count > 0) {
                        $data = oci_num_rows($result);
                        echo "showing $data result(s) for";
                    } else {
                        echo "No results found for";
                    }
                    ?>



                    <span class="fw-bold green-txt">"<?php
                                                        if (isset($_GET['shop'])) {
                                                            echo "$_GET[shop]";
                                                        } else if (isset($_GET['category'])) {
                                                            echo "$category";
                                                        } else if (isset($_GET['k'])) {
                                                            echo $_GET['k'];
                                                        }
                                                        ?>"</span>
                </p>
            </div>


            <!-- Dropdown menu for sorting products -->
            <div class="col-sm-6 col-12 ms-auto d-inline-flex justify-content-sm-end mt-sm-0 mt-3">
                <div class="dropdown search-dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Sort by: <?php
                                    //Display current sorted products
                                    if (isset($_POST['low'])) {
                                        echo $_POST['low'];
                                    } else if (isset($_POST['high'])) {
                                        echo $_POST['high'];
                                    } else if (isset($_POST['rating'])) {
                                        echo $_POST['rating'];
                                    } else if (isset($_POST['arrival'])) {
                                        echo $_POST['arrival'];
                                    } else {
                                        echo "Featured";
                                    }

                                    ?>
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <form action="" method="POST">
                            <li><input type="submit" value="Featured" name="featured" class="dropdown-item"></li>
                            <li><input type="submit" value="Price: Low to High" name="low" class="dropdown-item"></li>
                            <li><input type="submit" value="Price: High to Low" name="high" class="dropdown-item"></li>
                            <li><input type="submit" value="Avg. Customer Review" name="rating" class="dropdown-item"></li>
                            <li><input type="submit" value="Newest Arrival" name="arrival" class="dropdown-item"></li>
                        </form>

                    </ul>
                </div>

            </div>
        </div>
    </div>

    <!-- Display the selected category -->
    <div class="container-fluid pt-3">
        <?php

        if (isset($_SESSION['remove_cart_item'])) {
            echo '<p style = "color: red; text-align: center; ">' . $_SESSION["remove_cart_item"] . '</p>';
        } else if (isset($_SESSION['cart_success'])) {
            echo '<p style = "color: green; text-align: center; ">' . $_SESSION["cart_success"] . '</p>';
        }
        ?>
        <div class="row">

            <!-- Display the list of ratings -->
            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-12 border-end border-2">
                <div class="search-options">
                    <div class="d-flex flex-column me-auto">
                        <a href="shop.php?category=<?php if (isset($_GET['category'])) echo $_GET['category']; ?>" class="h5 pt-3 ps-4 fw-bold d-block me-auto dec-none cat-link">
                            <?php
                            if (isset($_GET['category'])) {
                                echo $_GET['category'];
                            }
                            ?>
                        </a>


                        <?php
                        include 'connection.php';
                        if (isset($_GET['category'])) {
                            $query1 = "SELECT DISTINCT shop_name FROM bysap.shop, bysap.product wHERE shop.shop_no = product.shop_no AND category = '$_GET[category]'";
                        }


                        $result1 = oci_parse($connection, $query1);
                        oci_execute($result1);

                        //Display the list of related shops
                        if ($result1) {
                            while ($data = oci_fetch_array($result1)) {

                                if (isset($_GET['category'])) {
                                    echo "<a href = 'shop.php?category=$_GET[category]&shop=$data[SHOP_NAME]' class='h6 ps-4 d-block me-auto ms-2 mt-3 dec-none shop-link'>$data[SHOP_NAME]</a>";
                                }
                            }
                        }
                        ?>
                    </div>

                    <!-- Display the list of ratings -->
                    <p class="h5 pt-3 ps-4 fw-bold">Avg Rating</p>
                    <div class="rating-form">
                        <ul class="list-unstyled ps-4">
                            <form action="" method="POST" class="star_rating d-flex flex-column">
                                <button class="me-auto" type="submit" name="fourstar">
                                    <li>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                        & up
                                    </li>
                                </button>

                                <button class="me-auto" type="submit" name="threestar">
                                    <li>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        & up
                                    </li>
                                </button>
                                <button class="me-auto" type="submit" name="twostar">
                                    <li>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        & up
                                    </li>
                                </button>

                                <button class="me-auto" type="submit" name="onestar">
                                    <li>
                                        <i class="fas fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        <i class="far fa-star"></i>
                                        & up
                                    </li>
                                </button>

                            </form>
                        </ul>
                    </div>
                    <!-- Display the list of price range -->
                    <p class="h5 pt-3 ps-4 fw-bold">Price</p>
                    <ul class="list-unstyled ps-4">
                        <form action="" method="POST" class="star_rating">
                            <li><input type='submit' value="Under 5&pound" name="five"></li>
                            <li><input type='submit' value="Under 10&pound" name="ten"></li>
                            <li><input type='submit' value="Under 20&pound" name="twenty"></li>
                            <li><input type='submit' value="Above 20&pound" name="abovetwenty"></li>
                        </form>

                        <!-- Display the price input fields -->
                        <li>
                            <form action="" method="POST">
                                <div class="row align-items-center minmax-row">
                                    <div class="col-md-4 col-sm-2 col-3 p-0 pe-2 position-relative">
                                        <span class="pound-sign">&pound</span>
                                        <input class="form-control pe-0 ps-3" type="text" placeholder="Min" name="min" value="<?php if (isset($_POST['min'])) echo $_POST['min'] ?>">
                                    </div>
                                    <div class="col-md-4 col-sm-2 col-3 p-0 pe-2 position-relative">
                                        <span class="pound-sign">&pound</span>
                                        <input class="form-control pe-0 ps-3" type="text" placeholder="Max" name="max" value="<?php if (isset($_POST['max'])) echo $_POST['max'] ?>">
                                    </div>
                                    <div class="col-md-2 col-sm-1 col-2 p-0 ps-auto">
                                        <input class="btn btn-dark" type="submit" value="Go" name="submit">
                                    </div>
                                </div>
                            </form>
                        </li>
                    </ul>

                </div>
            </div>

            <!-- Display the list of matched products -->
            <div class="col-xl-10 col-lg-9 col-md-8">
                <div class="row g-4">
                    <?php

                    if (isset($_COOKIE['id'])) {
                        $user_id = $_COOKIE['id'];
                    } else if (isset($_SESSION['id'])) {
                        $user_id = $_SESSION['id'];
                    }

                    if (isset($user_id)) {
                        $statement100 = "SELECT cart_id FROM bysap.cart WHERE user_id = $user_id";
                        $result100 = oci_parse($connection, $statement100);
                        oci_execute($result100);
                        $data100 = oci_fetch_array($result100);
                    }
                    $result5 = oci_parse($connection, $query);
                    oci_execute($result5);

                    if ($count > 0) {
                        while ($data = oci_fetch_array($result5)) {
                            echo '<div class="col-xl-3 col-lg-4 col-sm-6 col-12">
                               <div class="card mag-sm-2 shadow h-100">
                               <a href = "prod_description.php?id=' . $data['PRODUCT_ID'] . '">
                               <img class="card-img-top resp-img"  src="images/' . $data['CATEGORY'] . '/' . $data['PRODUCT_NAME'] . '.jpg" alt="' . $data['PRODUCT_NAME'] . '">
                               </a>
                            <div class="card-body p-4 pt-2">';
                            echo "<p class='mb-0'>";

                            //Display the average rating of a product
                            $query2 = "SELECT avg(rating) AS avg FROM bysap.Review GROUP BY product_id having product_id = $data[PRODUCT_ID]";

                            $result2 = oci_parse($connection, $query2);
                            oci_execute($result2);
                            $data2 = oci_fetch_array($result2);

                            if ($data2) {
                                $rating = $data2['AVG'];
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

                            //Display the total rating count
                            $query3 = "SELECT count(rating) AS count FROM bysap.Review GROUP BY product_id having product_id = $data[PRODUCT_ID]";

                            $result3 = oci_parse($connection, $query3);
                            oci_execute($result3);
                            $data3 = oci_fetch_array($result3);

                            if ($data3) {

                                echo "<span class='star-shop'>($data3[COUNT] rating/s)</span>";
                            } else {
                                echo "<span class='star-shop'> (0 rating)</span>";
                            }
                            echo "</p>";

                            //Display product name, price and stock availablity
                            echo '<p class="fw-bold mb-0 mt-4"> ' . $data['PRODUCT_NAME'];


                            echo '</p>';


                            if ($data['DISCOUNT']) {
                                $price = $data['PRICE'] - ($data['DISCOUNT'] / 100) * $data['PRICE'];
                                echo '<div><p class="mb-1 d-inline">&pound ' . number_format($price, 2);

                                if (isset($user_id)) {

                                    $statement200 = "SELECT * FROM bysap.cart_items WHERE cart_id = $data100[CART_ID] AND product_id =$data[PRODUCT_ID] AND wishlist = 'Yes'";
                                    $result200 = oci_parse($connection, $statement200);
                                    oci_execute($result200);
                                    $data200 = oci_fetch_array($result200);

                                    if ($data200) {
                                        echo '<a href="add_to_wishlist.php?destination=shop&category=' . $_GET['category'] . '&id=' . $data['PRODUCT_ID'] . '&cart_id=' . $data100['CART_ID'] . '"><i class="fas fa-heart fill d-inline-block ms-auto mag cursor-pointer name-' . $data['PRODUCT_ID'] . '" style = "float: right;"></i></a>';
                                    } else {
                                        echo '<a href="add_to_wishlist.php?destination=shop&category=' . $_GET['category'] . '&id=' . $data['PRODUCT_ID'] . '&cart_id=' . $data100['CART_ID'] . '"><i class="far fa-heart fill d-inline-block ms-auto mag cursor-pointer name-' . $data['PRODUCT_ID'] . '" style = "float: right;"></i></a>';
                                    }
                                }
                                echo '</p></div>';
                                echo '<div><p class="mb-1 d-inline"><span class="text-danger"><strike>&pound ' . number_format($data['PRICE'], 2) . '</strike></span> <span class="text-success">(' . $data['DISCOUNT'] . '% OFF)</span></p></div>';
                            } else {
                                $price =  number_format($data['PRICE'], 2);
                                echo '<div><p class="mb-1 d-inline">&pound ' . $price;

                                if (isset($user_id)) {

                                    $statement200 = "SELECT * FROM bysap.cart_items WHERE cart_id = $data100[CART_ID] AND product_id =$data[PRODUCT_ID] AND wishlist = 'Yes'";
                                    $result200 = oci_parse($connection, $statement200);
                                    oci_execute($result200);
                                    $data200 = oci_fetch_array($result200);

                                    if ($data200) {
                                        echo '<a href="add_to_wishlist.php?destination=shop&category=' . $_GET['category'] . '&id=' . $data['PRODUCT_ID'] . '&cart_id=' . $data100['CART_ID'] . '"><i class="fas fa-heart fill d-inline-block ms-auto mag cursor-pointer name-' . $data['PRODUCT_ID'] . '" style = "float: right;"></i></a>';
                                    } else {
                                        echo '<a href="add_to_wishlist.php?destination=shop&category=' . $_GET['category'] . '&id=' . $data['PRODUCT_ID'] . '&cart_id=' . $data100['CART_ID'] . '"><i class="far fa-heart fill d-inline-block ms-auto mag cursor-pointer name-' . $data['PRODUCT_ID'] . '" style = "float: right;"></i></a>';
                                    }
                                }

                                echo '</p></div>';
                            }




                            echo '</p>

                                    <p class="text-success shop-stock mb-0"> ' . $data['STOCK'] . ' item(s) available in stock.
                                    
                                    </p>
                               </div> 
                               </div></div>';
                        }
                    } else {
                        echo "<p class ='mt-4'>No Result(s) Found.</p>";
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <?php

    unset($_SESSION['remove_cart_item']);
    unset($_SESSION['cart_success']);

    ?>

</body>

</html>
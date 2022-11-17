<nav class="navbar black-bg top-navbar navbar-expand-md px-4 sticky-navbar">
        <a class="navbar-brand me-auto" href="index.php">
            <img src="images/logo/logo-dark.svg" alt="logo" width="100" height="30" class="d-inline-block align-text-top overflow-visible">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars white-font"></i>
        </button>
        <div class=" collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
            <form class="mt-md-0 mt-3 position-relative"method="GET" action="search.php">
                <input class="form-control me-2 rounded-pill nav-input" type="text" name="k" placeholder="Search" value="<?php if (isset($_SESSION['k'])) echo $_SESSION['k']; ?>" aria-label="Search">
                <i class="search-icon d-block fas fa-search fab"></i>
            </form>
            
            <ul class="navbar-nav mb-lg-0">
                <li class="nav-item">
                    <?php

                    if(isset($_COOKIE['id']))
                    {
                        $nav_user_id= $_COOKIE['id'];
                    }
                    else if(isset($_SESSION['id']))
                    {
                        $nav_user_id = $_SESSION['id'];
                    }


                    if (isset($_COOKIE['name']) || isset($_SESSION['name'])) {

                        if (isset($_COOKIE['name'])) {
                            $name = explode(' ', $_COOKIE['name']);
                        } else if (isset($_SESSION['name'])) {
                            $name = explode(' ', $_SESSION['name']);
                        }
                        echo '<div class="dropdown top-dropdown my-auto">
                    <a class="btn btn-secondary dropdown-toggle ps-md-4 ps-2 mt-md-0 mt-3" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false"> <i class = "fas fa-user-circle"></i> ' .
                            $name[0]
                            . '</a>
                  
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                      <li><a class="dropdown-item" href="setup_customer.php?id='.$nav_user_id.'"><i class = "fas fa-cog"></i> Manage Account</a></li>
                      <li><a class="dropdown-item" href="my_order.php"><i class = "fas fa-box-open"></i> My Orders</a></li>
                      <li><a class="dropdown-item" href="my_reviews.php"><i class = "fas fa-comments"></i> My Reviews</a></li>
                      <li><a class="dropdown-item" href="#"> <i class = "far fa-times-circle"></i> My Returns & Cancellations</a></li>
                      <li><a class="dropdown-item" href="signout.php"><i class = "fas fa-sign-out-alt"></i> Sign Out</a></li>
                    </ul>
                  </div>';
                    } else {
                        echo '<a class="menu-icon nav-link ps-md-4 ps-2 link-white" href="signin.php">Sign In</a>';
                    }
                    ?>
                </li>
                <li class="nav-item cart-icon">
                <?php
                    include 'connection.php';
                    if (isset($nav_user_id)) {

                        $sql100 = "SELECT count(*) AS count FROM bysap.Cart_Items WHERE wishlist = 'Yes' AND cart_id = (SELECT cart_id FROM bysap.Cart WHERE user_id = $nav_user_id)";
                        $result100 = oci_parse($connection, $sql100);
                        oci_execute($result100);
                        $data100 = oci_fetch_array($result100);
                        $count = $data100['COUNT'];

                    }
                    else
                    {
                        if(isset($_SESSION['product']))
                        {
                            $count = count($_SESSION['product']);
                        }
                        else{
                            $count = 0;
                        }

                    }
                if(isset($nav_user_id))
                {
                    echo ' <span class = "cart-quantity">'.$count.'</span>
                    <a class="menu-icon nav-link ps-md-4 ps-2 align-self-center" href="wishlist.php" ><i class="fas fa-heart white-logo" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Your Wishlist"></i></a>';
                }   

                ?>
                
                
                </li>

                <li class="nav-item cart-icon">
                <?php
                    include 'connection.php';
                    if (isset($nav_user_id)) {

                        $sql100 = "SELECT count(*) AS count FROM bysap.Cart_Items WHERE wishlist = 'No' AND cart_id = (SELECT cart_id FROM bysap.Cart WHERE user_id = $nav_user_id)";
                        $result100 = oci_parse($connection, $sql100);
                        oci_execute($result100);
                        $data100 = oci_fetch_array($result100);
                        $count = $data100['COUNT'];

                    }
                    else
                    {
                        if(isset($_SESSION['product']))
                        {
                            $count = count($_SESSION['product']);
                        }
                        else{
                            $count = 0;
                        }

                    }
                    

                ?>
                <span class = "cart-quantity"><?php echo $count;?></span>
                    <a class="menu-icon nav-link ps-md-4 ps-2 align-self-center" href="cart.php" ><i class="fas fa-shopping-cart white-logo" data-bs-placement="bottom" data-bs-toggle="tooltip" title="Your cart"></i></a>
                
                </li>
               
            </ul>
        </div>
</nav>
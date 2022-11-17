<nav class="navbar black-bg top-navbar navbar-expand-md px-4">
        <a class="navbar-brand me-auto" href="trader_interface.php">
            <img src="images/logo/logo-dark.svg" alt="logo" width="100" height="30" class="d-inline-block align-text-top overflow-visible">
        </a>
        <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars white-font"></i>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent"> -->

        <ul class="navbar-nav">
            <li class="nav-item">
                <?php

                if (isset($_COOKIE['id'])) {
                    $id = $_COOKIE['id'];
                } else if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
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
                  
                    <ul class="dropdown-menu" style ="transform: translateX(-53px); position:absolute;" aria-labelledby="dropdownMenuLink">
                      <li><a class="dropdown-item" href="setup_trader.php?id=' . $id . '"><i class = "fas fa-cog"></i> Account & Settings</a></li>
                      <li><a class="dropdown-item" href="trader_interface.php"><i class = "fas fa-archive"></i> Manage Products</a></li>
                      <li><a class="dropdown-item" href="manage_shop.php"><i class = "fas fa-store-alt"></i> Manage Shops</a></li>
                      <li><a class="dropdown-item" href="view_order.php"> <i class = "fas fa-box-open"></i> View Orders </a></li>
                      <li><a class="dropdown-item" href="#"><i class = "fas fa-chart-line"></i> Growth Center</a></li>
                      <li><a class="dropdown-item" href="signout.php"><i class = "fas fa-sign-out-alt"></i> Sign Out</a></li>
                    </ul>
                  </div>';
                } else {
                    echo '<a class="menu-icon nav-link ps-md-4 ps-2 link-white" href="signin.php">Sign In</a>';
                }
                ?>
            </li>
        </ul>
        </div>
    </nav>
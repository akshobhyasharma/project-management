<div class="offcanvas offcanvas-start" tabindex="-1" id="sideBar">
    <div class="offcanvas-header">
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <h5 class="offcanvas-title mb-3" id="offcanvasExampleLabel ">Shop by Trader</h5>

        <div class="ps-3">
            <a class="dec-none" href="shop.php?category=Bakery">
                <p><img class="sidebar-img" src="images/banner/bakery.jpg" alt="bakery">Bakery</p>
            </a>
        </div>
        <div class="ps-3">
            <a class="dec-none" href="shop.php?category=Greengrocery">
                <p><img class="sidebar-img" src="images/banner/greengrocery.jpg" alt="greengrocery">Greengrocer</p>
            </a>
        </div>
        <div class="ps-3">
            <a class="dec-none" href="shop.php?category=Delicacy">
                <p><img class="sidebar-img" src="images/banner/delicacy.jpg" alt="delicacy">Delicatessen</p>
            </a>
        </div>
        <div class="ps-3">
            <a class="dec-none" href="shop.php?category=Meat">
                <p><img class="sidebar-img" src="images/banner/meat.jpg" alt="meat">Butcher</p>
            </a>
        </div>
        <div class="ps-3">
            <a class="dec-none mb-5" href="shop.php?category=Fish">
                <p><img class="sidebar-img" src="images/banner/fish.jpg" alt="fish">Fishmonger</p>
            </a>
        </div>

        <h5 class="offcanvas-title mb-3" id="offcanvasExampleLabel">Available Shops</h5>
        <?php
        include 'connection.php';
        
        $query100 = "SELECT DISTINCT category, shop_name  from bysap.Shop s, bysap.Product p WHERE p.shop_no = s.shop_no";

        $result100 = oci_parse($connection, $query100);
        oci_execute($result100);

        while ($data100 = oci_fetch_array($result100)) {


            echo '<div class="ps-3">
                    <a class="dec-none" href = "shop.php?category='.$data100['CATEGORY'].'&shop='.$data100['SHOP_NAME'].'">
                    
                  ';
            echo '<p><img class="sidebar-img1" src="images/banner/' . $data100['SHOP_NAME'] . '.jpg" alt="' . $data100['SHOP_NAME'] . '"> '.$data100['SHOP_NAME'].'</p></a></div>';
        }
       
        ?>
    </div>
</div>
<?php
//Start session to store and retrieve the variables stored in session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BYSAP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="scss/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" href="images/logo/logo1.svg" type="image/x-icon">
</head>

<body>
    <!-- primary-navigation-bar -->
    <?php
    include 'nav-bar.php' ?>
    <?php include 'sidebar.php' ?>


    <!-- secondary-menu -->
    <?php include 'secondary-nav.php' ?>

    <div class="container">
        <h2 class="m-0 my-4 s-header text-center">
           STORIES
        </h2>
        <!-- Video  added -->
        <div class="embed-responsive embed-responsive-16by9">
            <iframe class="embed-responsive bysap-video" src="images/banner/bysapf.mp4"></iframe>
        </div>
        <h6 class="my-4">BYSAP is an e-commerce platform funded by the local traders of Cleckhuddersfax to maintain their work life balance. This platform offers new ways for the customers to engage with different traders and allow them to find the products they are searching for.</h6>
    </div>

    <hr class="stories-hr">
    <div class="container">
        <h3>
            <p class="text-center fw-bold">SHOPS</p>
        </h3>
    </div>

    <div class="container-md">
        <div class="row g-5">

            <div class="col-lg-4 col-sm-6">
                <div class="card stories-card rounded">
                    <img src="images/banner/The Grocery Outlet.jpg" class="card-img-top" alt="grocery">
                    <div class="card-body p-4">
                        <h6 class="fw-bold">The Grocery Outlet</h6>
                        <p class="card-text"> The Grocery Outlet is a perfect store for you daily goodies, our shop serves 
                        something for everyone at a good quantity and perfect quality. Just as a quality grocery store needs a good health food section, we've been through this remarkable journey since forever serving and
                        providing our best and quality goods just for you and your loved ones.  Shop from our recent shops for some amazingly fresh and hygenic green and healthy
                        foods. We are here to take into account every one of your requirements for food. To serve you with quality, alongside amount, is our earlier concern.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="card stories-card rounded">
                    <img src="images/banner/The Fruits Shop.jpg" class="card-img-top" alt="fruitshop">
                    <div class="card-body p-4">
                        <h6 class="fw-bold">The Fruits Shop</h6>
                        <p class="card-text"> While new vegetables ought to be a piece of your ordinary suppers,
                         a few vegetables are elusive even in the colossal general stores in your space.
                          Be that as it may, the advantage of internet shopping offers clients the solace of 
                          savoring these veggies by requesting them from the solace of their home.fruitshop makes
                         shopping for food simpler for you with their new produce conveyed in top class bundles to you.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="card stories-card rounded">
                    <img src="images/banner/North Bay Fisheries.jpg" class="card-img-top" alt="northbay">
                    <div class="card-body p-4">
                        <h6 class="fw-bold">North Bay Fisheries</h6>
                        <p class="card-text"> North Bay Fisheries is your online fish search for purchasing live freshwater 
                        and saltwater fish.With regards to fish, newness is everything. That is the reason we have our own fish handling and dispersion office, 
                        North Bay Fisheries. Which began as a discount activity out of a little shack on the harbors close to Half Moon Bay, presently from its momentum South area buys,
                         measures and disperses a huge bit of the fish served in our eateries.</p>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-sm-6">
                <div class="card stories-card rounded">
                    <img src="images/banner/Bake and Take.jpg" class="card-img-top" alt="bakentake">
                    <div class="card-body p-4">
                        <h6 class="fw-bold">Bake & Take</h6>
                        <p class="card-text"> Bake And Take gives a wide assortment of treats, everything being equal, shapes, and flavors, notwithstanding heated merchandise and different desserts and espresso idealized to coordinate with neighborhood taste. Heat n Take treats are recognized by being new and arranged day by day on location. Another element known for Bake n Take is its degree of delicateness and newness while eating regardless of whether it's anything but warmed,
                         the principle Bake n Take thought was to introduce what is known as the Chewy Cookies.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="card stories-card rounded">
                    <img src="images/banner/The Poultry King.jpg" class="card-img-top" alt="poultry">
                    <div class="card-body p-4">
                        <h6 class="fw-bold">The Poultry King</h6>
                        <p class="card-text">Confounded whether you improve poultry noticeable all around adapted 
                        grocery store or at the neighborhood market in your space? Here is a superior choice for you.
                         Request your chicken from the solace of your home through bigbasket's online store now. 
                         Our poultry is brought to you by ranch new brands that take most extreme consideration of
                          value while providing at ostensible costs. Chicken is the most well-known wellspring of protein that is effectively accessible to every non-veggie lover and is additionally the most favored sort of meat. Offering significance to the wellbeing of our clients, we just source our chicken from very much reproduced and trust-commendable sources like Fresho! 
                        We guarantee that our clients get an incentive for the amount that they pay.</p>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-sm-6">
                <div class="card stories-card loner-card rounded">
                    <img src="images/banner/Dream Deli.jpg" class="card-img-top" alt="dreamdeli">
                    <div class="card-body p-4">
                        <h6 class="fw-bold">Dream Deli</h6>
                        <p class="card-text">Are you among those who are bored with their daily routine and want to try something different? Are you tired of cooking? If your answer is yes, then it is time to visit The Dream Deli!
                        We, at dream deli in the Cleckhuddersfax are serving our clients  and the cherry on the cake is that our clients are happy with us.
                       In case, you need to begin your morning with some new feast, we are likewise giving you the super-quick and scrumptious breakfast conveyance. You should simply to visit our site and look at the dream deli menu and request online.
                        We have various classifications accessible with us, 
                        which won't just fulfill your yearning however will let your taste buds to go wow also.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- side-bar-components -->
    <?php include 'sidebar.php' ?>


    <!-- footer -->
    <?php
    include 'footer.php';
    ?>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


</body>

</html>
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
    <link rel="stylesheet" href="scss/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">


    <title>Registration Form</title>
</head>

<body>
<!-- Modal for Terms and Conditions -->
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="exampleModalToggleLabel">Terms and Conditions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p>As per the condition of this website, the contents of this website is prohibited to be used in any unlawful or contrary to the terms provided hereafter. The breach of these conditions could cause supspension, temporary or permanent depending upon the breach of the contract. These guidelines must be followed for the continuation of the service:</p>
                    <ol>
                        <li> Avoid harrassing or abusing any members involved in the website, trader or custers.</li>
                        <li> Avoid threat of any form using this website.</li>
                        <li> Impersonation will not be tolerated and could result in permanents suspension of the account.</li>
                        <li> Any type of defamatory content will be liable to suspension by the admins.</li>
                        <li> Any type of spamming of emails available through the website as well as any attempts of phising or any form of cyber crime through the emails will result in litigations.</li>
                        <li> Any attempts to make security breaches from the customers side will also be responded with legal actions.</li>
                        <li> Traders are required to conform to the items selected by them in the shop, not doing so can result in account suspension.</li>
                        <li> The materials in this website is copyrighted and the its use personally and in business can result in huge legal actions.</li>
                    </ol>
                    <p>Apart from this any actions that could disrupt the business practices in this website could be met with actions ranging from temporary account suspensions to legal actions.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Privacy Policy -->
    <div class="modal fade" id="privacyModel" aria-hidden="true" aria-labelledby="privacyModelLabel" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="exampleModalToggleLabel">Our Privacy Policy</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p>Our privacy policy are tailored towards giving you the optimum amount of privacy without hindering the functionality of our website. Following major crux of our privacy policy:</p>
                    <ol>
                        <li> We use cookies for sign in purposes to store you login data if you wish to stay logged in.</li>
                        <li> We collect personal information for all the customers and merchants while creating accounts for this website.</li>
                        <li> Apart from that all the information we collect is to allow the website to function properly.</li>
                        <li> Non of your data is shared with any advertising company as we rely solely on the income from this website to function as of now.</li>
                        <li> We will inform you via email if there are any changes to the current privacy policy.</li>
                    </ol>
                    <p>By creating an account you are legally bound to these privacy policies. These policies are liable to change at any time with prior notice.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Include all navigation menus -->
    <?php include 'nav-bar.php' ?>
    <?php include 'secondary-nav.php' ?>
    <?php include 'sidebar.php' ?>

    <!-- Entire page container starts here -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h3 class="text-center pb-4">Create an Account</h3>

                <div class="card position-relative form-box ext-ext-rounded">

                    <div class="d-flex pt-5 px-sm-5 px-3 justify-content-sm-between justify-content-around flex-wrap">
                        <div class="d-inline-block toggle-customer cursor-pointer selected">Sign Up for Customer</div>
                        <div class="d-inline-block toggle-trader cursor-pointer">Sign Up for Trader</div>
                    </div>

                    <!-- Customer Registration Form -->
                    <form action="validate_register.php" method="post" id="customer" class="inputs">
                        <?php

                        //Display the error message for unmatched password pattern
                        if (isset($_SESSION['error']) && isset($_SESSION['Customer'])) {
                            echo "<p class = 'text-center text-danger'  $_SESSION[error]</p>";
                        }
                        //Display an error message for mismatched password
                        else if (isset($_SESSION['mismatch'])  && isset($_SESSION['Customer'])) {
                            echo "<p class = 'text-center text-danger' $_SESSION[mismatch] </p>";
                        }

                        ?>
                        <!-- Firstname input field -->
                        <div class="mb-3">
                            <input type="text" name="firstname" class="form-control ext-rounded" placeholder="Firstname" required>
                        </div>
                        <!-- Lastname input field -->
                        <div class="mb-3">
                            <input type="text" name="lastname" class="form-control ext-rounded" placeholder="Lastname" required>
                        </div>
                        <!-- Email input field -->
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control ext-rounded" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control ext-rounded" placeholder="Password" required>
                        </div>



                        <div class="mb-3">
                            <input type="password" name="confirmpassword" class="form-control ext-rounded" placeholder="Confirm Password" required>
                        </div>

                        <div class="mb-3 d-flex align-items-center">
                            <label for="dob" class="d-inline-block w-50">Date of Birth:</label>

                            <!-- Date functionality for age validation -->
                            <?php
                            $year = date('Y') - 16;
                            $month = date('m');
                            $day = date('d');
                            ?>

                            <input type="date" class="form-control ext-rounded" name="dob" id="dob" max='<?php echo "$year-$month-$day"  ?>' required>
                        </div>

                        <div class="mb-3 d-flex align-items-center">
                            <label for="gender" class="d-inline-block w-50">Gender:</label>

                            <select name="gender" id="gender" required class="form-select ext-rounded">
                                <option value="default" selected disabled>Select your gender</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Others">Others</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="address" class="form-control ext-rounded" placeholder="Address" required>
                        </div>
                        <div class="mb-3">
                            <input type="tel" name="contact" class="form-control ext-rounded" placeholder="Contact No" required>
                        </div>

                     

                        <p class="text-center">By clicking Create Account, you agree to our <a class="dec-none skyblue-txt" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Terms of Services</a> and <a class="dec-none skyblue-txt" data-bs-toggle="modal" href="#privacyModel">Privacy Policy</a></p>

                        <?php
                        if (isset($_SESSION['product']) && isset($_GET['quantity']) && isset($_GET['price'])) {

                            echo '<input type="submit" name="customersubmit" value="Create Account" class="btn btnregister btn-info text-light d-block mx-auto" formaction = "validate_register.php?quantity=' . $_GET['quantity'] . '&price=' . $_GET['price'] . '">';
                        } else {
                            echo '<input type="submit" name="customersubmit" value="Create Account" class="btn btnregister btn-info text-light d-block mx-auto">';
                        }
                        ?>



                        <div>
                            <p class="text-center pt-3">Already have an account?

                                <?php
                                if (isset($_SESSION['product']) && isset($_GET['quantity']) && isset($_GET['price'])) {

                                    echo ' <a class="skyblue dec-none" name="signin-customer" href="signin.php?quantity=' . $_GET['quantity'] . '&price=' . $_GET['price'] . '">Sign In</a>';
                                } else {
                                    echo ' <a class="skyblue dec-none" name="signin-customer" href="signin.php">Sign In</a>';
                                }
                                ?>
                            </p>
                        </div>
                    </form>


                    <!-- Trader Registration Form -->
                    <form action="validate_register.php" method="post" id="trader" class="inputs">
                        
                    <?php
                        //Display the error message for unmatched password pattern
                        if (isset($_SESSION['error'])  && isset($_SESSION['Trader'])) {
                            echo "<p class = 'text-center text-danger'  $_SESSION[error]</p>";
                        }
                        //Display an error message for mismatched password
                        else if (isset($_SESSION['mismatch'])  && isset($_SESSION['Trader'])) {
                            echo "<p class = 'text-center text-danger' $_SESSION[mismatch] </p>";
                        }
                        ?>
                    
                        <div class="mb-3">
                            <input type="text" name="firstname" class="form-control ext-rounded" placeholder="Firstname" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="lastname" class="form-control ext-rounded" placeholder="Lastname" required>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control ext-rounded" placeholder="Email" required>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control ext-rounded" placeholder="Password" required>
                        </div>


                        <div class="mb-3">
                            <input type="password" name="confirmpassword" class="form-control ext-rounded" placeholder="Confirm Password" required>
                        </div>
                        
                        <div class="mb-3">
                            <input type="tel" name="contact" class="form-control ext-rounded" placeholder="Contact No." required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="address" class="form-control ext-rounded" placeholder="Address" required>
                        </div>
                        <div class="mb-3">
                            <input type="text" name="shopname" class="form-control ext-rounded" placeholder="Shop Name" required>
                        </div>

                        <div class="mb-3 d-flex align-items-center">
                            <label for="dob" class="d-inline-block w-50">Reg. Date:</label>
                            <input type="date" class="form-control ext-rounded" name="dob" id="dob" required>
                        </div>

                       

                        <p class="text-center">By clicking Create Account, you agree to our <a class="dec-none skyblue-txt" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Terms of Services</a> and <a class="dec-none skyblue-txt" data-bs-toggle="modal" href="#privacyModel">Privacy Policy</a></p>



                        <input type="submit" name="tradersubmit" value="Create Account" class="btn btnregister  btn-info text-light d-block mx-auto">

                        <div>
                            <p class="text-center pt-3">Already have an account?
                                <a href="signin.php" class="skyblue-txt dec-none" name="signin-customer">Sign In</a>
                            </p>
                        </div>
                    </form>


                    <?php
                    unset($_SESSION['mismatch']);
                    unset($_SESSION['error']);


                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>

    <script src="js/registration.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


    <script src="js/tooltip.js"></script>

</body>

</html>
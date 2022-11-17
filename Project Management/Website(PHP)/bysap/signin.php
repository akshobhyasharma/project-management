<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BYSAP: Sign In</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="scss/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="shortcut icon" href="images/logo/logo1.svg" type="image/x-icon">
</head>

<body>
    <!-- Include all navigation menus -->
    <?php include 'nav-bar.php' ?>
    <?php include 'secondary-nav.php' ?>
    <?php include 'sidebar.php' ?>

<!-- Entire login page container starts here -->
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-sm-10 mx-auto">
                <div class="card ext-ext-rounded mt-5 border border-3">
                    <div class="col-sm-8 col-10 mx-auto my-4">
                        <!-- Form to store and validate the user credentials starts here -->
                        <form class="login-form" action="validate_signin.php" method="POST">
                            <h3 class="text-center pb-5">SIGN IN</h3>

                            <!-- Display message for invalid login credentials -->
                            <?php
                            if (isset($_SESSION['InvalidLogin'])) {
                                echo "<p class='text-danger text-center'>".$_SESSION['InvalidLogin']."</p>";
                            }
                            ?>
                            <!-- Email address input field -->
                            <div class="mb-3">
                                <input type="email" name="email" class="form-control ext-rounded" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email" required>
                            </div>
                            <!-- Password input field -->
                            <div class="mb-3">
                                <input type="password" name="password" class="form-control ext-rounded" id="exampleInputPassword1" placeholder="Password" required>
                            </div>
                            <div class="d-flex justify-content-sm-between justify-content-around flex-wrap">
                                <div class="form-check">
                                    <!-- Checkbox to store the user credentials for longer time period  -->
                                    <input type="checkbox" name="remember" value="remember" class="form-check-input" id="form-remember">
                                    <label class="form-check-label me-3" for="remember">Remember Me</label>
                                </div>

                                <div>
                                    <a href="#" class="dec-none text-center">Forgot Password?</a>
                                </div>
                            </div>

                                <?php
                                    if(isset($_SESSION['product']) && isset($_GET['quantity']) && isset($_GET['price']))
                                    {

                                        echo '<input type="submit" name="submit" class="d-block mx-auto btn btn-success px-md-4 px-sm-3 px-2 mt-3 login-button" value="Sign In" formaction = "validate_signin.php?quantity='.$_GET['quantity'].'&price='.$_GET['price'].'">';
                                    }
                                    else
                                    {
                                        echo '<input type="submit" name="submit" class="d-block mx-auto btn btn-success px-md-4 px-sm-3 px-2 mt-3 login-button" value="Sign In">';
                                    }

                                ?>

                            <p class="text-center h6 pt-5">New to BYSAP?
                            <?php
                                if(isset($_SESSION['product']) && isset($_GET['quantity']) && isset($_GET['price'])){

                                    echo ' <a class="dec-none" href="register.php?quantity='.$_GET['quantity'].'&price='.$_GET['price'].'">Sign Up for free</a>';
                                }
                                else{
                                    echo ' <a class="dec-none" href="register.php">Sign Up for free</a>';
                                }
                            ?>
                            </p>
                        </form>
                    </div>

                    <?php
                    unset($_SESSION['InvalidLogin']);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <?php include 'footer.php' ?>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

    <script src="js/tooltip.js"></script>
</body>

</html>
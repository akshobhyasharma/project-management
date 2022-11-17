<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BYSAP: Manage Account</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link rel="stylesheet" href="scss/main.css?v=<?php echo time(); ?>">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="shortcut icon" href="images/logo/logo1.svg" type="image/x-icon">
</head>

<body>
  <!-- Top Nav Bar -->
  <?php include 'trader_navbar.php'; ?>

  <!-- Entire page container starts here -->
  <div class="container-fluid setup-profile">
    <h3 class="h3 ps-4 mt-4">My Profile</h3>
    <div class="row mt-4 p-4">
      <div class="col-md-3 form-border">
        <div class="img-part ">
          <img class="img-fluid" src="images/banner/user.jpg" alt="user profile">

        </div>
        <div class = "text-center">
          <i class="fas fa-edit"></i>
          <i class="fas fa-trash"></i>

        </div>
      </div>

      <div class="col-md-9">
        <h4 class="name mt-2 mb-4 h4" style="margin-left: 45px;">Personal Information</h4>


        <?php
        //Include connection.php file  to connect to Oracle database
        include 'connection.php';
        //GET user id from URL
        $id = $_GET['id'];
        //Query to fetch all the details of users
        $sql = "SELECT * FROM bysap.users WHERE user_id = $id";
        $result = oci_parse($connection, $sql);
        oci_execute($result);

        $data = oci_fetch_array($result);
        //To extract the firstname of user from fullname 
        if (isset($data['FULLNAME'])) {
          $name = explode(' ', $data['FULLNAME']);
        }
        ?>
        <!-- Form container starts here -->
        <div class="form-part ">
          <form action="update_trader.php" method="POST" id="customer" class="inputs" style="display:block; position: static;">

            <?php
            if (isset($_SESSION['setup_error'])) {
              echo '<p style = "color: red; text-align: center; ">' . $_SESSION["setup_error"] . '</p>';
            } else if (isset($_SESSION['setup_successful'])) {
              echo '<p style = "color: green; text-align: center; ">' . $_SESSION["setup_successful"] . '</p>';
            }

            ?>

            <input type="hidden" name="user_id" value="<?php echo $id; ?>">

            <div class="setup-name">
              <div class="mb-3 col-md-6">
                <label for="firstname">Firstname</label>
                <input type="text" name="firstname" class="form-control ext-rounded" value="<?php if (isset($name)) echo $name[0]; ?>" required>
              </div>

              <div class="mb-3 col-md-6">
                <label for="lastname">Lastname</label>
                <input type="text" name="lastname" class="form-control ext-rounded" value="<?php if (isset($name)) echo $name[1]; ?>" required>
              </div>
            </div>
            <div class="mb-3">
              <label for="email">Email</label>
              <input type="email" name="email" class="form-control ext-rounded" value="<?php if (isset($data['EMAIL'])) echo $data['EMAIL'] ?>" required>
            </div>
            <div class="mb-3">
              <label for="oldpassword">Old Password</label>
              <input type="password" name="oldpassword" class="form-control ext-rounded">
            </div>
            <div class="mb-3">
              <label for="newpassword">New Password</label>
              <input type="password" name="newpassword" class="form-control ext-rounded">
            </div>

            <?php

            //Display the error message for unmatched password pattern
            if (isset($_SESSION['error']) && isset($_SESSION['Customer'])) {
              echo $_SESSION['error'];
            }

            ?>

            <div class="mb-3">
              <label for="confirmpassword">Confirm Password</label>
              <input type="password" name="confirmpassword" class="form-control ext-rounded">
            </div>

            <?php
            //Display an error message for mismatched password
            if (isset($_SESSION['mismatch'])  && isset($_SESSION['Customer'])) {
              echo $_SESSION['mismatch'];
            }

            ?>

            <div class="setup-name gender-date">
              <div class="mb-3 d-flex align-items-center col-md-6">
                <label for="dob" class="d-inline-block ">Reg. Date:</label>

                <!-- Date functionality for age validation -->
                <?php
                $date = explode('-', date("y-m-d", strtotime($data['USER_DATE'])));

                if ($date[0] < 50) {
                  $date[0] = '20' . $date[0];
                } else {
                  $date[0] = '19' . $date[0];
                }
                ?>

                <input type="date" class="form-control ext-rounded" name="user_date" id="dob" value="<?php if (isset($date)) echo $date[0] . '-' . $date[1] . '-' . $date[2]; ?>" required>
              </div>


              <div class="mb-3 d-flex align-items-center col-md-6">
                <label for="contact" class="d-inline-block ">Contact:</label>
              

              <input type="tel" name="contact" class="form-control ext-rounded " value="<?php if (isset($data['CONTACT'])) echo $data['CONTACT'] ?>" required>
              </div>
            </div>


            <div class="mb-3">
              <label for="address">Address</label>
              <input type="text" name="address" class="form-control ext-rounded" value="<?php if (isset($data['ADDRESS'])) echo $data['ADDRESS'] ?>" required>
            </div>



            <div class="col-12">
              <button class="btn cancel-btn me-3" formaction ="index.php">Cancel</button>
              <button class="btn me-3" type="submit" name="updateconfirm">Save</button>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
  <?php include 'footer.php' ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

  <?php
  unset($_SESSION['setup_error']);
  unset($_SESSION['setup_successful']);
  ?>
</body>

</html>
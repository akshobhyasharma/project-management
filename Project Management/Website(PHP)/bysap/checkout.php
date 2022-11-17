<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
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

  <!-- Entire page container starts here -->
  <div class="container mt-5">
    <div class="row">
      <div class="col-12">
        <h2>Checkout</h2>
        <hr>
      </div>
    </div>

    <!-- Display message if the slot limit exceeds -->
    <?php
    if (isset($_SESSION['slot_limit'])) {
      echo '<p style = "color: red; text-align: center; ">' . $_SESSION["slot_limit"] . '</p>';
    }

    ?>
    <div class="row mt-3 justify-content-between">
      <div class="form col-md-6 col-12">
        <h3 class="fw-bold pb-4">Collection Slot</h3>

        <!-- Form to store and send collection slot day and time  -->
        <form action="insert_order.php" method="post">

          <div class="mb-5">
          <!-- Code to display the allocated slot day and time  -->
            <?php
            //To get the day in required format 
            $date = date('l jS F');
            $count = 0;
            echo '<h5>Pick your collection day</h5>';
            while ($count < 7) {
              //Increment the date by 1
              $date = date('l jS F', strtotime($date . '+1day'));
              //Change the format of date to Oracle standard
              $oracle_date = date("m/d/Y", strToTime($date));
              $day = date('l', strtotime($date));
              if ($day == 'Wednesday' || $day == 'Thursday' || $day == 'Friday') {
                echo '<div>';
                echo '<input type="radio" name="day" class = "checkout-day" value = "' . $oracle_date . '" required> ' . $date . ' </input>';
                echo '</div>';
              }
              $count++;
            }

            ?>
          </div>

          <h5>Pick your collection time</h5>
          <div>
            <input type="radio" name="time" class="checkout-time" id="10" value="10am-1pm" required>
            <label for="10">10am - 1pm</label>
          </div>
          <div>
            <input type="radio" name="time" class="checkout-time" id="13" value="1pm-4pm" required>
            <label for="13">1pm - 4pm</label>
          </div>
          <div>
            <input type="radio" name="time" class="checkout-time" id="16" value="4pm-7pm" required>
            <label for="16">4pm - 7pm</label>

          </div>

      </div>

      <div class="ordersumm col-md-5 col-12">
        <form method="post" action="">

          <div class="summary-title mb-5">
            <h4>Order Summary</h4>
            <?php
            $quantity = $_GET['quantity'];
            if (isset($_POST['quantity'])) {
              $price = number_format(($_GET['price'] * $_POST['quantity']), 2);
            } else {
              $price = $_GET['price'];
            }


            ?>
            <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
            <input type="hidden" name="price" value="<?php echo $price; ?>">

          </div>

          <div class="summary-content">
            <div>
              <span class="summary-text">Total Items:</span>
              <span class="summary-price">
                <?php
                echo $quantity;
                ?>

              </span>
            </div>
            <div>
              <span class="summary-text">Subtotal:</span>
              <span class="summary-price">&pound;<?php echo $price; ?>
              </span>
            </div>
            <div>
              <span class="summary-text">Discount:</span>
              <span class="summary-price">&pound;0.00</span>
            </div>
            <hr>
            </hr>
            <div>
              <span class="summary-text">Total:</span>
              <span class="summary-price">&pound;<?php echo $price; ?>
              </span>
            </div>
            <div class="mt-5">
              <?php
              if (isset($_POST['quantity']) && isset($_POST['product_id'])) {
                echo ' <button type="submit" name="submit" class="checkout-btn d-block mx-auto" formaction="insert_order.php?product_id=' . $_POST['product_id'] . '&quantity=' . $_POST['quantity'] . '">PayPal Payment</button>';
              } else {
                echo '<button type="submit" name="submit" class="checkout-btn d-block mx-auto">PayPal Payment</button>';
              }
              ?>
            </div>


          </div>
        </form>
      </div>
    </div>
  </div>
  </form>
  <div class="clear"></div>


  <?php include 'footer.php' ?>

  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

  <script src="js/tooltip.js"></script>

  <script>
    const checkbox_day = document.querySelectorAll('.checkout-day');
    const checkbox_time = document.querySelectorAll('.checkout-time');
    const checkout_btn = document.querySelector('.checkout-btn');
    const currentTime = new Date().getHours();

    checkbox_day.forEach((dbox, i) => {
      dbox.addEventListener('click', () => {
        if (i == 0) {
          checkbox_time.forEach(tbox => {
            if (tbox.id <= currentTime) {
              tbox.checked = false;
              tbox.disabled = true;
              checkout_btn.style.pointerEvents = 'none';
            }
          })
        } else 
        {
          checkbox_time.forEach(tbox => {
            tbox.disabled = false;
            checkout_btn.style.pointerEvents = 'all';
          })

        }
      })
    });

   checkbox_time.forEach(tbox => {
            tbox.addEventListener('click', ()=> {
                if (tbox.checked == true)
                {
                    checkout_btn.style.pointerEvents = 'all';
                }
            })
        })
  </script>

  <?php
  unset($_SESSION['slot_limit']);
  ?>
</body>

</html>
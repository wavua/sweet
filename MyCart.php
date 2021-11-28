<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/function.php"; ?>
<?php require_once "Includes/session.php"; ?>
<?php
if (isset($_POST['remove'])) {
  if ($_GET['action'] == 'remove') {
    foreach ($_SESSION['cart'] as $key => $value) {
      if ($value["product_id"] == $_GET['product_id']) {
        unset($_SESSION['cart'][$key]);
        echo "<script>alert('Product has been Removed...!')</script>";
        echo "<script>window.location = 'MyCart.php'</script>";
      }
    }
  }
}
?>
<?php
if (isset($_GET["action"])) {
  if ($_GET["action"] == "empty") {
    foreach ($_SESSION['cart'] as $keys => $values) {
      unset($_SESSION['cart']);
      echo '<script>window.location = "COD.php"</script>';
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyCart-SweetTreats</title>
  <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css" />
  <link rel="stylesheet" href="fontawesom5/css/all.css">
  <link rel="stylesheet" href="Includes/style.css">
  <script src="Includes/cart.js" async></script>
</head>

<body>
  <!-- NAVBAR AREA -->
  <div style="height: 10px; background: #27aae1;"></div>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark"> 
    <div class="container">
      <a class="navbar-brand" href="index.php">Sweet Treats</a>
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item ">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link" href="healthyFood.php">Menu</a>
          </li>
          <li class="nav-item">
            <a href="MyCart.php" class="nav-link active">
              <h5 class="cart">
                <i class="fas fa-shopping-cart"></i> MyCart
                <?php
                if (isset($_SESSION['cart'])) {
                  $count = count($_SESSION['cart']);
                  echo "<span id=\"cart_count\" class=\"text-warning bg-light\">$count</span>";
                } else {
                  echo "<span id=\"cart_count\" class=\"text-warning bg-light\">0</span>";
                }
                ?>
              </h5>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link text-danger" href="Logout.php"> <i class="fas fa-sign-out-alt"></i> LogOut</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div style="height: 10px; background: #27aae1;" class="mb-1"></div>
  <!-- END OF NAVBAR AREA -->
  <div class="container-fluid" style="min-height:500px;">
    <div class="row px-5">
      <div class="col-md-7">
        <div class="shopping-cart">
          <h6>My Cart</h6>
          <hr class="bg-dark">
          <?php
          $total = 0;
          $vat=0.16;
          if (isset($_SESSION['cart'])) {
            $product_id = array_column($_SESSION['cart'], 'product_id');
            global $ConnectingDB;
            $sql  = "SELECT * FROM products";
            $stmt = $ConnectingDB->query($sql);
            while ($DataRows = $stmt->fetch()) {
              foreach ($product_id as $key => $id) {
                if ($DataRows["id"] == $id) {
                  cartElement(
                    $productimg   = $DataRows["product_image"],
                    $productname  = $DataRows["product_name"],
                    $productprice = $DataRows["product_price"],
                    $productid    = $DataRows["id"],
                  );
                  $vat=$vat * (int) $DataRows["product_price"];
                  $total = $total +  (int) $DataRows["product_price"] + $vat ;
                }
              }
            }
          } else {
            echo "<h5>Cart is Empty</h5>";
          }
          ?>
        </div>
      </div>
      <div class="col-md-4 offset-md-1 border rounded mt-5 bg-white h-25 border-primary">

        <div class="pt-4">
          <h6>PRICE DETAILS</h6>
          <hr class="bg-primary">
          <div class="row price-details">
            <div class="col-md-6">
              <?php
              if (isset($_SESSION['cart'])) {
                $count  = count($_SESSION['cart']);
                echo "<h6>Price ($count items)</h6>";
              } else {
                echo "<h6>Price (0 items)</h6>";
              }
              ?>
              <h6>Delivery Charges</h6>
              <h6>VAT</h6>
              <hr class="bg-primary">
              <h6 class="mb-2">Amount Payable</h6>
            </div>
            <div class="col-md-6">
              <h6>Ksh <?php echo $total; ?></h6>
              <h6 class="text-success">FREE</h6>
              <h6>Ksh <?php echo $vat; ?></h6>
              <hr class="bg-primary">
              <h6>Ksh
                <?php
                echo $total;
                ?>
              </h6>
            </div>
          </div>
        </div>

        <?php
        if (isset($_POST['checkOut'])) {
          if (empty($_SESSION['cart'])) {
            header("Location: MyCart.php");
          } else {
            if (!empty($_SESSION['cart'])) {
              echo "<script>window.open('payment.php','_self')</script>";
            }
          }
        }

        ?>
        <form method="post" action="payment.php" class="py-3">
          <a href="healthyFood.php" class="btn btn-warning mb-2 btn-block mr-auto">continue shopping</a>
          <button type="submit" name="checkOut" class="btn btn-success mb-2 btn-block ml-auto">Check Out</button>
      </div>
      </form>
    </div>
  </div>
  <!-- FOOTER -->
  <?php include 'Includes/footer.php';?>

  <!-- END FOOTER -->
  <script src="bootstrap4/js/jquery-3.5.1.min.js"></script>
  <script src="bootstrap4/js/bootstrap.bundle.js"></script>
  <script>
    $("#year").text(new Date().getFullYear());
  </script>
</body>

</html>
<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/function.php"; ?>
<?php require_once "Includes/session.php"; ?>
<?php
$total = 0;
if (isset($_SESSION['cart'])) {
  $product_id = array_column($_SESSION['cart'], 'product_id');
  global $ConnectingDB;
  $sql = "SELECT * FROM products";
  $stmt = $ConnectingDB->query($sql);
  while ($DataRows = $stmt->fetch()) {
    foreach ($product_id as $key => $id) {
      if ($DataRows["id"] == $id) {
        $total = $total + (int) $DataRows["product_price"];
      }
    }
  }
}
?>
<?php
if (isset($_POST['Cash'])) {
  session_unset();
  header("Location: COD.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>omifoods - payment</title>
  <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css" />
  <link rel="stylesheet" href="fontawesom5/css/all.css">
  <link rel="stylesheet" href="Includes/style.css">
</head>

<body>
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <h1 class="display-4 text-center font-weight-bold ">Choose Payment Option Below!!</h1>

      <h6 class="mb-2 text-center ">Amount Payable</h6>
      <h6 class="text-center font-weight-bolder">Ksh <?php echo $total; ?></h6>

      <div class="text-center">

        <form method="POST" action="payment.php">
          <div class="row">
            <div class="col mb-4">
              <a href="payOnline.php" class="btn btn-info btn-lg">Pay Online</a>
              <button name="Cash" class="btn btn-primary btn-lg">Cash On Delivery</button>
            </div>
          </div>
          <a href="MyCart.php" class="btn btn-success  btn-lg">Go back to cart</a>
        </form>
      </div>
    </div>
  </div>
  <script src="bootstrap4/js/jquery-3.5.1.min.js"></script>
  <script src="bootstrap4/js/bootstrap.bundle.js"></script>
</body>

</html>
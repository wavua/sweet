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
if (isset($_POST['submit'])) {
  session_unset();
  header("Location: COD.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SweetTreats|-PayOnline-|</title>
  <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css" />
  <link rel="stylesheet" href="fontawesom5/css/all.css">
  <link rel="stylesheet" href="Includes/style.css">
</head>

<body>
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 offset-sm-2 offset-md-3 offset-lg-4">
          <h1 class="mb-3 text-center">Please Enter Card details Below</h1>
          <form action="payOnline.php" method="POST" class="mb-3">
            <div class="form-group">
              <label for="card">Name</label>
              <input type="text" class="form-control" id="card" placeholder="Card-Holder" required />
            </div>
            <div class="form-group">
              <label for="cardNo">Card Number</label>
              <input type="number" class="form-control" id="cardNo" placeholder="Card number" required />
            </div>
            <div class="form-group">
              <label for="select" Card Type></label>
              <select name="" id="select" class="form-control" aria-describedby="select-helpBlock" required>
                <option value="">- select here -</option>
                <option value="business">VISA</option>
                <option value="sale">MasterCard</option>
                <option value="support">Discover</option>
                <option value="support">AMEX</option>
                <option value="support">Others</option>
              </select>
              <small id="select-helpBlock" class="form-text">Please select Card type.</small>
            </div>
            <div class="form-group">
              <label for="amount">Amount Payable</label>
              <input type="number" class="form-control" id="amount" Ksh value="<?php echo $total; ?>" disabled />
            </div>
            <button type="submit" name="submit" class="btn btn-primary btn-block">
              Pay Now
            </button>
          </form>
          <div class="text-center">
            <a href="payment.php"><i class="fas fa-arrow-circle-left"></i> Back to Options</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="bootstrap4/js/jquery-3.5.1.min.js"></script>
  <script src="bootstrap4/js/bootstrap.bundle.js"></script>
</body>

</html>
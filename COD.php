<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/function.php"; ?>
<?php require_once "Includes/session.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>COD</title>
  <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css" />
  <link rel="stylesheet" href="fontawesom5/css/all.css">
  <link rel="stylesheet" href="Includes/style.css">
</head>

<body>
  <nav class="navbar navbar-expand-md navbar-light bg-light mb-5">
    <div class="container">
      <a class="navbar-brand" href="index.php"></a>
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="Logout.php" class="nav-link h4 btn btn-outline-danger">
              <i class="fas fa-user-times"></i> LogOut</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    <div class="jumbotron">
      <h1 class="text-center" style="color: green;"> Order Placed Successfully.</h1>
    </div>
    <br>
    <h2 class="text-center"> Thank you for Ordering at Sweet Treats! The ordering process is now complete.</h2>

    <?php
    $num1 = rand(500, 1000);
    $num2 = rand(500, 1000);
    $num3 = rand(500, 1000);
    $number = $num1 . $num2 . $num3;
    ?>
    <h3 class="text-center mb-2"> <strong>Your Order Number:</strong> <span style="color: blue;"><?php echo "$number"; ?></span>
      <br><br>
      <a href="MyCart.php"><i class="fas fa-arrow-circle-left"></i> Back to Cart</a>
    </h3>
  </div>
  <script src="bootstrap4/js/jquery-3.5.1.min.js"></script>
  <script src="bootstrap4/js/bootstrap.bundle.js"></script>
</body>

</html>
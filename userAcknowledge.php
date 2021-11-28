<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/function.php"; ?>
<?php require_once "Includes/session.php"; ?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ACUser</title>
  <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css" />
  <link rel="stylesheet" href="fontawesom5/css/all.css">
  <link rel="stylesheet" href="Includes/style.css">
</head>

<body>
  <div class="container">
    <div class="jumbotron">
      <h1 class="text-center">Welcome!
        <?php
        echo SuccessMessage();
        ?>
      </h1>
    </div>
    <br>
    <h2 class="text-center"> Thank you for registering with Omi-Foods. <a href="UserLogin.php">LOGIN HERE!</a></h2>
  </div>
  <script src="bootstrap4/js/jquery-3.5.1.min.js"></script>
  <script src="bootstrap4/js/bootstrap.bundle.js"></script>
</body>

</html>
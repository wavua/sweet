<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/function.php"; ?>
<?php require_once "Includes/session.php"; ?>
<?php
//making login page in-accessable when logged in 
//thru the url
if (isset($_SESSION["UserId"])) {
  Redirect_to("Dashboard.php");
}

if (isset($_POST["Submit"])) {
  $UserName  = $_POST["Username"];
  $Password  = $_POST["Password"];
  if (empty($UserName) || empty($Password)) {
    $_SESSION["ErrorMessage"] = "All fields must be filled out";
    Redirect_to("Login.php");
  } else {
    $Found_Account = Login_Attempt($UserName, $Password);
    if ($Found_Account) {
      $_SESSION["UserId"] = $Found_Account["id"];
      $_SESSION["UserName"] = $Found_Account["username"];
      $_SESSION["AdminName"] = $Found_Account["aname"];
      // $_SESSION["SuccessMessage"] = "Welcome " . $_SESSION["AdminName"];
      if (isset($_SESSION["TrackingURL"])) {
        Redirect_to($_SESSION["TrackingURL"]);
      } else {
        Redirect_to("Dashboard.php");
      }
    } else {
      $_SESSION["ErrorMessage"] = "Wrong Password or Password";
      Redirect_to("Login.php");
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>|-Login page-|</title>
  <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css" />
  <script src="fontawesom5/js/all.js"></script>
  <style>
    body {
      background-color: black;
    }
  </style>
</head>

<body>
  <div style="height: 10px; background: #27aae1;"></div>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">Omi-Food</a>
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <div class="dropdown">
              <button id="my-dropdown" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Login</button>
              <div class="dropdown-menu" aria-labelledby="my-dropdown">
                <a class="dropdown-item" href="UserLogin.php">As User</a>
                <a class="dropdown-item active " href="Login.php">As Admin</a>
              </div>
            </div>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <div style="height: 10px; background: #27aae1;" class="mb-1"></div>
  <!--full width jumbotron-->
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-8 col-md-6 col-lg-4 offset-sm-2 offset-md-3 offset-lg-4">
          <div class="card bg-dark text-white shadow-lg">
            <div class="card-header bg-secondary">
              <h1 class="mb-3 text-center">Please login</h1>
            </div>
            <div class="card-body">
              <?php
              echo ErrorMessage();
              echo SuccessMessage();
              ?>
              <form method="POST" action="login.php" class="mb-3">
                <label for="username" class="text-warning">Username:</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-primary" id="username"><i class="fas fa-user" aria-hidden="true"></i></span>
                  </div>
                  <input type="text" class="form-control" name="Username" placeholder="Username" aria-label="Username" aria-describedby="username">
                </div>
                <label for="password" class="text-warning">Password:</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-primary" id="password"><i class="fas fa-lock" aria-hidden="true"></i></span>
                  </div>
                  <input type="password" class="form-control" name="Password" placeholder="password" aria-label="Password" aria-describedby="password">
                </div>
                <button type="submit" name="Submit" class="btn btn-primary btn-block">
                  login
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="bootstrap4/js/jquery-3.5.1.min.js"></script>
  <script src="bootstrap4/js/bootstrap.bundle.js"></script>
  <script>
    $("#year").text(new Date().getFullYear());
  </script>
</body>

</html>
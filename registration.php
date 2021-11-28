<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/function.php"; ?>
<?php require_once "Includes/session.php"; ?>

<?php
if (isset($_POST["Register"])) {
  $Name = $_POST['Name'];
  $Username = $_POST['Username'];
  $Email = $_POST['Email'];
  $Password = $_POST['Password'];
  $CPassword = $_POST['CPassword'];
  $Address = $_POST['Address'];
  $Phone = $_POST['Phone'];
  $User = $_SESSION["Username"];


  if (empty($Name) || empty($Username) || empty($Address) || empty($Phone)) {
    $_SESSION["ErrorMessage"] = "All fields are Required";
    Redirect_to("registration.php");
  } elseif (filter_var($Email, FILTER_VALIDATE_EMAIL) === false) {
    $_SESSION["ErrorMessage"] = "Inalid email";
    Redirect_to("registration.php");
  } elseif (strlen($Password) < 6) {
    $_SESSION["ErrorMessage"] = "Passwords should be atleast 6 characters";
  } elseif (strlen($Password !== $CPassword)) {
    $_SESSION["ErrorMessage"] = "Passwords don't match";
    Redirect_to("registration.php");
  } elseif (UserNameExists($Username)) {
    $_SESSION["ErrorMessage"] = "Username Already Exist!";
    Redirect_to("registration.php");
  } else {
    global $ConnectingDB;
    $sql = "INSERT INTO users(cname,username,email,cpassword,cpass,caddress,phone)";
    $sql .= "VALUES(:Cname,:userName,:emaiL,:cpasSword,:cPass,:cadDress,:pHone)";

    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':Cname', $Name);
    $stmt->bindValue(':userName', $Username);
    $stmt->bindValue(':emaiL', $Email);
    $stmt->bindValue(':cpasSword', $Password);
    $stmt->bindValue(':cPass', $CPassword);
    $stmt->bindValue(':cadDress', $Address);
    $stmt->bindValue(':pHone', $Phone);
    $Execute = $stmt->execute();

    if ($Execute) {
      $_SESSION["SuccessMessage"] = "{$Username}";
      Redirect_to("userAcknowledge.php");
    } else {
      $_SESSION["ErrorMessage"] = " ERROR! .Try Again !";
      Redirect_to("registration.php");
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>|-Register page-|</title>
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
      <a class="navbar-brand" href="index.php">Sweet Treats</a>
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
      </div>
    </div>
  </nav>
  <div style="height: 10px; background: #27aae1;" class="mb-1"></div>
  <!--full width jumbotron-->
  <div class="jumbotron jumbotron-fluid">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-8 col-md-8 col-lg-5 offset-sm-2 offset-md-3 offset-lg-4">
          <div class="card bg-dark text-white shadow-lg">
            <div class="card-header bg-secondary">
              <h1 class="mb-2 text-center">Please Register</h1>
            </div>
            <div class="card-body">
              <?php
              echo ErrorMessage();
              echo SuccessMessage();
              ?>
              <form method="POST" action="registration.php">
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <label for="name" class="text-warning">Name:</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text text-white bg-primary" id="name"><i class="fas fa-user" aria-hidden="true"></i></span>
                      </div>
                      <input type="text" class="form-control" name="Name" placeholder="Name" aria-label="name" aria-describedby="name">
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <label for="username" class="text-warning">Username:</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text text-white bg-primary" id="username"><i class="fas fa-user" aria-hidden="true"></i></span>
                      </div>
                      <input type="text" class="form-control" name="Username" placeholder="Username" aria-label="Username" aria-describedby="username">
                    </div>
                  </div>
                </div>
                <!-- <label for="email" class="text-warning">Email:</label>  -->
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-primary" id="email"><i class="fas fa-envelope" aria-hidden="true"></i></span>
                  </div>
                  <input type="email" class="form-control" name="Email" placeholder="example@gmail.com" aria-label="email" aria-describedby="email">
                </div>
                <label for="password" class="text-warning">password:</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-primary" id="password"><i class="fas fa-lock" aria-hidden="true"></i></span>
                  </div>
                  <input type="password" class="form-control" name="Password" placeholder="password" aria-label="password" aria-describedby="password">
                </div>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text text-white bg-primary" id="cpassword"><i class="fas fa-lock" aria-hidden="true"></i></span>
                  </div>
                  <input type="password" class="form-control" name="CPassword" placeholder="Confirm-password" aria-label="cpassword" aria-describedby="cpassword">
                </div>
                <div class="row">
                  <div class="col-12 col-sm-6">
                    <label for="address" class="text-warning">Address:</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text text-white bg-primary" id="address"><i class="fas fa-address-card"></i></span>
                      </div>
                      <input type="text" class="form-control" name="Address" placeholder="address" aria-label="address" aria-describedby="address">
                    </div>
                  </div>
                  <div class="col-12 col-sm-6">
                    <label for="phone" class="text-warning">Phone:</label>
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text text-white bg-primary" id="phone"><i class="fas fa-phone" aria-hidden="true"></i></span>
                      </div>
                      <input type="number" class="form-control" name="Phone" placeholder="(+254...)" aria-label="phone" aria-describedby="phone">
                    </div>
                  </div>
                </div>
                <button type="submit" name="Register" class="btn btn-primary btn-block">
                  Register
                </button>
              </form>
            </div>
            <p class="small text-center font-weight-bold">Have an Account ? <a href="UserLogin.php" class="mt-0">Please Login</a></p>
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
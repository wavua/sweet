<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/function.php"; ?>
<?php require_once "Includes/session.php"; ?>

<?php
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
Confirm_Login();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard - Sweet Treats</title>
  <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css" />
  <script src="fontawesom5/js/all.js"></script>
</head>

<body>
  <!-- NAVBAR AREA -->
  <div style="height: 10px; background: #27aae1;"></div>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">SWEET TREATS</a>
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a href="Dashboard.php" class="nav-link">Dashboard</a>
          </li>
          <li class="nav-item">
            <a href="Posts.php" class="nav-link">Menu</a>
          </li>
          <li class="nav-item">
            <a href="Categories.php" class="nav-link">Categories</a>
          </li>
          <li class="nav-item">
            <a href="Admins.php" class="nav-link">Manage Admins</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item"><a href="Logout.php" class="nav-link text-danger">
              <i class="fas fa-user-times"></i> Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <div style="height: 10px; background: #27aae1;"></div>
  <!-- END OF NAVBAR AREA -->
  <!--HEADER-->
  <header class="bg-dark text-white py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fas fa-cog" style="color: #27aae1;"></i> Dashboard</h1>
        </div>
        <div class="col-lg-3 mb-2">
          <a href="AddNewPost.php" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> Add New Post</a>
        </div>
        <div class="col-lg-3 mb-2">
          <a href="Categories.php" class="btn btn-info btn-block"><i class="fas fa-folder-plus"></i> Add New Category</a>
        </div>
        <div class="col-lg-3 mb-2">
          <a href="Admins.php" class="btn btn-warning btn-block"><i class="fas fa-user-plus"></i> Add New Admin</a>
        </div>
      </div>
    </div>
  </header>
  <!--END OF HEADER-->
  <!--MAIN AREA-->
  <section class="container py-2 mb-2">
    <div class="row">
      <div class="col-lg-2 d-none d-md-block">
        <!-- Left side Area End-->
        <div class="card text-center bg-success text-white mb-3">
          <div class="card-body">
            <h1 class="lead">Posts</h1>
            <h4 class="display-5"> <i class="fab fa-readme"></i>
              <?php
              echo htmlentities(TotalPost());
              ?>
            </h4>
          </div>
        </div>
        <div class="card text-center bg-primary text-white mb-3">
          <div class="card-body">
            <h1 class="lead">Categories</h1>
            <h4 class="display-5"> <i class="fas fa-folder"></i>
              <?php
              echo htmlentities(TotalCategories());
              ?>
            </h4>
          </div>
        </div>
        <div class="card text-center bg-danger text-white mb-3">
          <div class="card-body">
            <h1 class="lead">Admins</h1>
            <h4 class="display-5"> <i class="fas fa-users"></i>
              <?php
              echo htmlentities(TotalAdmins());
              ?>
            </h4>
          </div>
        </div>
        <div class="card text-center bg-secondary text-white mb-3">
          <div class="card-body">
            <h1 class="lead"><b>Clients</b></h1>
            <h4 class="display-5"> <i class="fas fa-users"></i>
              <?php
              echo htmlentities(Totalusers());
              ?>
            </h4>
          </div>
        </div>
      </div>
      <div class="col-lg-10">
        <?php
        echo ErrorMessage();
        echo SuccessMessage();
        ?>
        <div class="table-responsive">
          <h1 class="text-center">Top Posts</h1>
          <table class="table table-light table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Title</th>
                <th scope="col">Category</th>
                <th scope="col">Date&Time</th>
                <th scope="col">Author</th>
              </tr>
            </thead>
            <?php
            $SrNo = 0;
            global $ConnectingDB;
            $sql = "SELECT * FROM products ORDER BY id desc LIMIT 0,5";
            $stmt = $ConnectingDB->query($sql);
            while ($DataRows = $stmt->fetch()) {
              $PostId = $DataRows["id"];
              $DateTime = $DataRows["datetime"];
              $Author = $DataRows["author"];
              $Category = $DataRows["category"];
              $ProductTitle = $DataRows["product_name"];
              $SrNo++;
            ?>
              <tbody>
                <tr>
                  <th scope="row"><?php echo htmlentities($SrNo); ?></th>
                  <td><?php echo htmlentities($ProductTitle); ?></td>
                  <td><?php echo htmlentities($Category); ?></td>
                  <td><?php echo htmlentities($DateTime); ?></td>
                  <td><?php echo htmlentities($Author); ?></td>
                </tr>
              </tbody>
            <?php  } ?>
          </table>
        </div>
      </div>
    </div>
  </section>
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
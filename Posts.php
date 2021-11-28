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
  <title>Posts - Sweet Treats</title>
  <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css" />
  <script src="fontawesom5/js/all.js"></script>
</head>

<body>
  <!-- NAVBAR AREA -->
  <div style="height: 10px; background: #27aae1;"></div>
  <?php include 'Includes/navbar.php';?>

  <div style="height: 10px; background: #27aae1;"></div>
  <!-- END OF NAVBAR AREA -->
  <!--END OF NAVBAR-->
  <!--HEADER-->
  <header class="bg-dark text-white py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fas fa-bars" style="color: #27aae1;"></i> Menu Posts</h1>
        </div>
        <div class="col-lg-3 mb-2">
          <a href="AddNewPost.php" class="btn btn-primary btn-block"><i class="fas fa-edit"></i> Add New Menu Item</a>
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
      <div class="col-lg-12">
        <?php
        echo ErrorMessage();
        echo SuccessMessage();
        ?>
        <div class="table-responsive">
          <table class="table table-light table-striped table-hover">
            <thead class="thead-dark">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Price</th>
                <th scope="col">Category</th>
                <th scope="col">Date&Time</th>
                <th scope="col">Admin</th>
                <th scope="col">Banner</th>
                <th scope="col">Action</th>
                <th scope="col">Live Preview</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $ConnectingDB;
              $sql = "SELECT * FROM products";
              $stmt = $ConnectingDB->query($sql);
              $sr = 0;
              while ($DataRows = $stmt->fetch()) {
                $Id = $DataRows["id"];
                $DataTime = $DataRows["datetime"];
                $ProductTitle = $DataRows["product_name"];
                $Category = $DataRows["category"];
                $Admin = $DataRows["author"];
                $Image = $DataRows["product_image"];
                $ProductPrice = $DataRows["product_price"];
                $sr++;

              ?>
                <tr class="text-center">
                  <th scope="row"><?php echo $sr; ?></th>
                  <td>
                    <?php
                    if (strlen($ProductTitle) > 7) {
                      $ProductTitle = substr($ProductTitle, 0, 7) . "...";
                    }
                    echo  $ProductTitle;
                    ?>
                  </td>
                  <td>
                    <?php
                    echo $ProductPrice;
                    ?>
                  </td>
                  <td>
                    <?php
                    if (strlen($Category) > 8) {
                      $Category = substr($Category, 0, 8) . '...';
                    }
                    echo $Category;
                    ?>
                  </td>
                  <td>
                    <?php
                    if (strlen($DataTime) > 11) {
                      $DataTime = substr($DataTime, 0, 11) . '...';
                    }
                    echo $DataTime;
                    ?>
                  </td>
                  <td>
                    <?php
                    if (strlen($Admin) > 6) {
                      $Admin = substr($Admin, 0, 6) . "...";
                    }
                    echo $Admin;
                    ?>
                  </td>
                  <td><img class="img-fluid" src="Uploads/<?php echo $Image; ?>" width="170px;" height="50px;"></td>
                  <td colspan="1">
                    <a href="EditPost.php?id=<?php echo $Id; ?>"><span class="btn btn-warning mb-2">Edit</span></a>
                    <a href="DeletePost.php?id=<?php echo $Id; ?>"><span class="btn btn-danger mb-2">Delete</span></a>
                  </td>
                  <td>
                    <a href="healthyFood.php?id=<?php echo $Id; ?>" target="_blank"><span class="btn btn-primary  btn-sm">Live Preview</span></a>
                  </td>
                </tr>
            </tbody>
          <?php } ?>
          </table>
        </div>
      </div>
    </div>
  </section>
  <!--END OF MAIN AREA-->
  <!--FOOTER-->
  <!-- <div style="height: 10px; background: #27aae1;"></div> -->
  <?php include 'Includes/footer.php';?>
  <!--END OFFOOTER-->
  <script src="bootstrap4/js/jquery-3.5.1.min.js"></script>
  <script src="bootstrap4/js/bootstrap.bundle.min.js"></script>
  <script>
    $("#year").text(new Date().getFullYear());
  </script>
</body>

</html>
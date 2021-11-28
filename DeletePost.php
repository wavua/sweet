<?php
require_once "Includes/DB.php";
require_once "Includes/function.php";
require_once "Includes/session.php";

?>
<?php
$SearchQueryParameter = $_GET['id'];
// Fetching Existing Content according to our post

global $ConnectingDB;
$sql  = "SELECT * FROM products WHERE id='$SearchQueryParameter'";
$stmt = $ConnectingDB->query($sql);
while ($DataRows = $stmt->fetch()) {
  $TitleToBeDeleted    = $DataRows["product_name"];
  $CategoryToBeDeleted = $DataRows['category'];
  $ImageToBeDeleted    = $DataRows['product_image'];
  $PriceToBeDeleted     = $DataRows['product_price'];
  // code...

}

if (isset($_POST["Submit"])) {
  //Query to Delete into posts in DB when everything is fine
  $ConnectingDB;
  $sql = "DELETE FROM products WHERE id='$SearchQueryParameter'";
  $Execute = $ConnectingDB->query($sql);
  if ($Execute) {
    $Target_Path_To_DELETE_Image = "Uploads/$ImageToBeDeleted";
    unlink($Target_Path_To_DELETE_Image);
    $_SESSION["SuccessMessage"] = "Post deleted Successfully";
    Redirect_to("Posts.php");
  } else {
    $_SESSION["ErrorMessage"] = "Something went wrong.Try Again !";
    Redirect_to("Posts.php");
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>DeletePost - Omifood</title>
  <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css" />
  <script src="fontawesom5/js/all.js"></script>
</head>

<body>
  <!-- NAVBAR AREA -->
  <div style="height: 10px; background: #27aae1;"></div>
  <?php include 'Includes/navbar.php';?>

  <div style="height: 10px; background: #27aae1;"></div>
  <!-- END OF NAVBAR AREA -->
  <!--HEADER-->
  <header class="bg-dark text-white py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fas fa-edit" style="background: #27aae1;"></i> DELETE POSTS</h1>
        </div>
      </div>
    </div>
  </header>
  <!--END OF HEADER-->
  <!--MAIN AREA-->
  <section class="container py-2 mb-4">
    <div class="row">
      <div class=" offset-lg-1 col-lg-10" style="min-height: 480px">
        <?php
        echo ErrorMessage();
        echo SuccessMessage();
        ?>
        <form method="post" action="DeletePost.php?id=<?php echo $SearchQueryParameter; ?>"
          enctype="multipart/form-data">
          <div class="card bg-secondary text-light mb-3">
            <div class="card-body bg-dark">
              <div class="form-group">
                <label for="PostTitle"> <span class="FieldInfo">Post Title:</span> </label>
                <input disabled tabindex="-1" class="form-control" type="text" name="PostTitle" id="PostTitle"
                  placeholder="Type title here" value="<?php echo $TitleToBeDeleted; ?>">
              </div>
              <div class="form-group">
                <span class="FieldInfo">Existing Category:</span>
                <?php echo $CategoryToBeDeleted; ?>
                <br />
              </div>
              <div class="form-group">
                <span class="FieldInfo">Existing Image:</span>
                <img class="img-fluid mb-1" src="Uploads/<?php echo $ImageToBeDeleted; ?>" width="170px;"
                  height="70px;">
              </div>
              <div class="form-group">
                <label for="price"> <span class="FieldInfo"> Price: </span></label>
                <input class="form-control" type="number" name="ProductPrice" id="price" placeholder="Type price Here"
                  value="<?php echo $PriceToBeDeleted; ?>">
              </div>
              <div class="row">
                <div class="col-lg-6 mb-2">
                  <a href="Dashboard.php" class="btn btn-warning  btn-block"><i class="fas fa-arrow-left"></i>Back to
                    Dashboard</a>
                </div>
                <div class="col-lg-6 mb-2">
                  <button type="submit" class="btn btn-danger btn-block" name="Submit"> <i class="fas fa-trash"></i>
                    Delete</button>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </section>
  <!--END MAIN AREA-->
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
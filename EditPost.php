<?php
require_once "Includes/DB.php";
require_once "Includes/function.php";
require_once "Includes/session.php";

?>
<?php
$SearchQueryParameter = $_GET['id'];
if (isset($_POST["Submit"])) {
  $ProductTitle = $_POST["ProductTitle"];
  $Category     = $_POST["Category"];
  $ProductImage = $_FILES["Image"]["name"];
  $Target       = "Uploads/" . basename($_FILES["Image"]["name"]);
  $ProductPrice = $_POST["ProductPrice"];
  $Admin        = "Tycoon";
  date_default_timezone_set("Africa/Nairobi");
  $CurrentTime = time();
  $DateTime    = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
  if (empty($ProductTitle)) {
    $_SESSION["ErrorMessage"] = "Title can't be empty";
    Redirect_to("Posts.php");
  } elseif (strlen($ProductTitle) < 5) {
    $_SESSION["ErrorMessage"] = "Post Title should be grater than 5 characters";
    Redirect_to("Posts.php");
  } elseif (empty($ProductPrice)) {
    $_SESSION["ErrorMessage"] = " Product Price can not be empty";
    Redirect_to("AddNewPost.php");
  } else {
    //Query to update into posts in DB when everything is fine
    $ConnectingDB;
    if (!empty($ProductImage)) {
      $sql = "UPDATE products
              SET product_name='$ProductTitle', category='$Category', product_image='$ProductImage', product_price='$ProductPrice'
              WHERE id='$SearchQueryParameter'";
    } else {
      $sql = "UPDATE products
              SET product_name=' $ProductTitle', category='$Category', product_price='$ProductPrice'
              WHERE id='$SearchQueryParameter'";
    }

    $Execute = $ConnectingDB->query($sql);
    move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);

    if ($Execute) {
      $_SESSION["SuccessMessage"] = "Post with updated Successfully";
      Redirect_to("Posts.php");
    } else {
      $_SESSION["ErrorMessage"] = "Something went wrong.Try Again !";
      Redirect_to("Posts.php");
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>EditPost - OmiFood</title>
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
          <h1><i class="fas fa-edit" style="background: #27aae1;"></i> EDIT POSTS</h1>
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
        //Fetching Existing content according yo our edit button
        $ConnectingDB;
        $sql      = "SELECT * FROM products WHERE id='$SearchQueryParameter'";
        $stmtPost = $ConnectingDB->query($sql);
        while ($DataRows = $stmtPost->fetch()) {
          $TitleToBeUpdated    = $DataRows['product_name'];
          $CategoryToBeUpdated = $DataRows['category'];
          $ImageToBeUpdated    = $DataRows['product_image'];
          $PriceToBeUpdated    = $DataRows['product_price'];
        }
        ?>
        <form method="post" action="EditPost.php?id=<?php echo $SearchQueryParameter; ?>" enctype="multipart/form-data">
          <div class="card bg-secondary text-light mb-3">
            <div class="card-body bg-dark">
              <div class="form-group">
                <label for="ProductTitle"> <span class="FieldInfo">Post Title:</span> </label>
                <input class="form-control" type="text" name="ProductTitle" id="ProductTitle" placeholder="Type title here" value="<?php echo $TitleToBeUpdated; ?>">
              </div>
              <div class="form-group">
                <span class="FieldInfo">Existing Category:</span>
                <?php echo $CategoryToBeUpdated; ?>
                <br>
                <label for="CategoryTitle"> <span class="FieldInfo">Choose Category:</span> </label>
                <select class="form-control custom-select" name="Category" id="CategoryTitle">
                  <?php
                  //Fetching all the category from table
                  global $ConnectingDB;
                  $sql  = "SELECT id,title FROM category";
                  $stmt = $ConnectingDB->query($sql);
                  while ($DataRows = $stmt->fetch()) {
                    $Id           = $DataRows["id"];
                    $CategoryName = $DataRows["title"];
                  ?>
                    <option> <?php echo $CategoryName; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <span class="FieldInfo">Existing Image:</span>
                <img class="img-fluid mb-1" src=" Uploads/<?php echo $ImageToBeUpdated; ?>" width="170px;" height="70px;">
                <div class="custom-file">
                  <input class="custom-file-input" type="file" name="Image" id="ImageSelect" value="">
                  <label for="ImageSelect" class="custom-file-label">Select Image</label>
                </div>
              </div>
              <div class="form-group">
                <label for="price"> <span class="FieldInfo"> Price: </span></label>
                <input class="form-control" type="number" name="ProductPrice" id="price" placeholder="Type price Here" value="<?php echo $PriceToBeUpdated; ?>">
              </div>
              <div class="row">
                <div class="col-lg-6 mb-2">
                  <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i>Back to Dashboard</a>
                </div>
                <div class="col-lg-6 mb-2">
                  <button type="submit" class="btn btn-success btn-block" name="Submit"><i class="fas fa-check"></i>Publish</button>
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
  <div style="height: 10px; background: #27aae1;"></div>
  <script src="bootstrap4/js/jquery-3.5.1.min.js"></script>
  <script src="bootstrap4/js/bootstrap.bundle.min.js"></script>
  <script>
    $("#year").text(new Date().getFullYear());
  </script>
</body>

</html>
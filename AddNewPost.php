<?php
require_once "Includes/DB.php";
require_once "Includes/function.php";
require_once "Includes/session.php";
?>

<?php
if (isset($_POST["Submit"])) {
  $ProductTitle = $_POST["ProductTitle"];
  $Category = $_POST["Category"];
  $ProductImage = $_FILES["Image"]["name"];
  $Target = "Uploads/" . basename($_FILES["Image"]["name"]);
  $ProductPrice = $_POST["ProductPrice"];
  $Admin = $_SESSION["UserName"];
  date_default_timezone_set("Africa/Nairobi");
  $CurrentTime = time();
  $DateTime = strftime("%B-%d-%Y %H:%M:%S", $CurrentTime);
  if (empty($ProductTitle)) {
    $_SESSION["ErrorMessage"] = "Title can't be empty";
    Redirect_to("AddNewPost.php");
  } elseif (strlen($ProductTitle) < 5) {
    $_SESSION["ErrorMessage"] = "Title should be grater than 5 characters";
    Redirect_to("AddNewPost.php");
  } elseif (empty($ProductPrice)) {
    $_SESSION["ErrorMessage"] = " Product Price can not be empty";
    Redirect_to("AddNewPost.php");
  } else {
    //Query to insert into posts in DB when everything is fine
    $sql = "INSERT INTO products(datetime,product_name,category,author,product_price,product_image)";
    $sql .= "VALUES(:dateTime,:productName,:categoryName,:adminName,:productPrice,:imageName)";
    $stmt = $ConnectingDB->prepare($sql);
    $stmt->bindValue(':dateTime', $DateTime);
    $stmt->bindValue(':productName', $ProductTitle);
    $stmt->bindValue(':categoryName', $Category);
    $stmt->bindValue(':adminName', $Admin);
    $stmt->bindValue(':productPrice', $ProductPrice);
    $stmt->bindValue(':imageName', $ProductImage);

    $Execute = $stmt->execute();
    move_uploaded_file($_FILES["Image"]["tmp_name"], $Target);

    if ($Execute) {
      $_SESSION["SuccessMessage"] = "Post with id " . $ConnectingDB->lastInsertId() . " Added Successfully";
      Redirect_to("AddNewPost.php");
    } else {
      $_SESSION["ErrorMessage"] = "Something went wrong.Try Again !";
      Redirect_to("AddNewPost.php");
    }
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Add New Item</title>
  <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css" />
  <script src="fontawesom5/js/all.js"></script>
</head>

<body>
  <!-- NAVBAR AREA -->
  <div style="height: 10px; background: #27aae1;"></div>
  <?php include 'Includes/navbar.php';?>

  <div style="height: 10px; background: #27aae1;"></div>
  <!-- END OF NAVBAR AREA -->
  <!-- HEADER -->
  <header class="bg-dark text-white py-3">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <h1><i class="fas fa-edit" style="color:#27aae1;"></i> Add New Menu Item</h1>
        </div>
      </div>
    </div>
  </header>
  <!-- HEADER END -->

  <!-- Main Area -->
  <section class="container py-2 mb-4">
    <div class="row">
      <div class="offset-lg-1 col-lg-10">
        <?php
        echo ErrorMessage();
        echo SuccessMessage();
        ?>
        <form class="" action="AddNewPost.php" method="post" enctype="multipart/form-data">
          <div class="card bg-secondary text-light mb-3">
            <div class="card-body bg-dark">
              <div class="form-group">
                <label for="title"> <span class="FieldInfo"> Title: </span></label>
                <input class="form-control" type="text" name="ProductTitle" id="title" placeholder="Type title here" value="">
              </div>
              <div class="form-group">
                <label for="price"> <span class="FieldInfo"> Price: </span></label>
                <input class="form-control" type="number" name="ProductPrice" id="price" placeholder="Type price Here" value="">
              </div>
              <div class="form-group">
                <label for="CategoryTitle"> <span class="FieldInfo"> Choose Categroy </span></label>
                <select class="form-control custom-select" id="CategoryTitle" name="Category">
                  <?php
                  //Fetching all the category from table
                  global $ConnectingDB;
                  $sql = "SELECT id,title FROM category";
                  $stmt = $ConnectingDB->query($sql);
                  while ($DataRows = $stmt->fetch()) {
                    $Id = $DataRows["id"];
                    $CategoryName = $DataRows["title"];
                  ?>
                    <option> <?php echo $CategoryName; ?></option>
                  <?php } ?>
                </select>
              </div>
              <div class="form-group">
                <label for="imageSelect"> <span class="FieldInfo"> Select Image </span></label>
                <div class="custom-file">
                  <input class="custom-file-input" type="File" name="Image" id="imageSelect" value="">
                  <label for="imageSelect" class="custom-file-label">Select Image </label>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6 mb-2">
                  <a href="Dashboard.php" class="btn btn-warning btn-block"><i class="fas fa-arrow-left"></i> Back To Dashboard</a>
                </div>
                <div class="col-lg-6 mb-2">
                  <button type="submit" name="Submit" class="btn btn-success btn-block">
                    <i class="fas fa-check"></i> Publish
                  </button>
                </div>
              </div>
            </div>
          </div>
        </form>
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
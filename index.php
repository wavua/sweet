<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/function.php"; ?>
<?php require_once "Includes/session.php"; ?>
<?php
Confirm_User_Login();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sweet Treats</title>
  <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css" />
  <script src="fontawesom5/js/all.js"></script>
  <style>
    .heading {
      font-family: Bitter, Georgia, "Times New Roman", Times, serif;
      font-weight: bold;
      color: #005e90;
    }

    .heading:hover {
      color: #0090db;
    }
  </style>
</head>

<body>
  <!-- NAVBAR AREA -->
  <div style="height: 10px; background: #27aae1;"></div>
  <?php include 'Includes/indexPageNavbar.php';?>

  <div style="height: 10px; background: #27aae1;" class="mb-1"></div>
  <!-- END OF NAVBAR AREA -->

  <div class="container">
    <div class="row">
      <div class="col-12 col-lg-8">
        <!-- CAROUSEL START -->
        <div id="FoodCarousel" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
            <li class="active" data-target="#FoodCarousel" data-slide-to="0" aria-current="location"></li>
            <li data-target="#FoodCarousel" data-slide-to="1"></li>
            <li data-target="#FoodCarousel" data-slide-to="2"></li>
          </ol>
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img class="d-block w-100" src="img/slide002.jpg" alt="">
              <div class="carousel-caption d-none d-md-block">
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="img/slide005.jpg" alt="">
              <div class="carousel-caption d-none d-md-block">
              </div>
            </div>
            <div class="carousel-item">
              <img class="d-block w-100" src="img/slide001.jpg" alt="">
              <div class="carousel-caption d-none d-md-block">
              </div>
            </div>
          </div>
          <a class="carousel-control-prev" href="#FoodCarousel" data-slide="prev" role="button">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#FoodCarousel" data-slide="next" role="button">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
        <!-- CAROUSEL END -->
        <!-- JUMBOTRON STARTS -->
        <div class="container my-5">
          <div class="alert alert-primary mb-4 text-dark" role="alert">
            <h2 class="alert-heading">Delicious Meals On Demand!
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </h2>
            <p class="lead">Please proceed to the menu to get yourself a delicious food at affordable price
              <a href="healthyFood.php" class="alert-link btn btn-success btn-block text-white mt-3">Menu here</a>.
            </p>
          </div>
        </div>
        <!-- END JUMBOTRON -->
        <!-- FIGURES STARTS -->
        <div class="container my-3 my-sm-5">
          <h5>Most Popular</h5>
          <div class="row">
            <div class="col-12 col-sm-6 col-lg-4">
              <figure class="figure shadow-lg p-3">
                <img src="img/straw berry cake.jpg" class="figure-img img-fluid img-thumbnail" alt="figure-image">
                <figcaption class="figure-caption">
                  <p class="text-center font-weight-bolder">Straw Berry Cake</p>
                </figcaption>
              </figure>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
              <figure class="figure shadow-lg p-3">
                <img src="img/donuts.jpg" class="figure-img img-fluid img-thumbnail" alt="figure-image">
                <figcaption class="figure-caption">
                  <p class="text-center font-weight-bolder">Donuts</p>
                </figcaption>
              </figure>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
              <figure class="figure shadow-lg p-3">
                <img src="img/butter cookies.jpg" class="figure-img img-fluid img-thumbnail" alt="figure-image">
                <figcaption class="figure-caption">
                  <p class="text-center font-weight-bolder">Butter Cookies</p>
                </figcaption>
              </figure>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
              <figure class="figure shadow-lg p-3">
                <img src="img/orange.jpg" class="figure-img img-fluid img-thumbnail" alt="figure-image">
                <figcaption class="figure-caption">
                  <p class="text-center font-weight-bolder">Passion Juice</p>
                </figcaption>
              </figure>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
              <figure class="figure shadow-lg p-3">
                <img src="img/pies.jpg" class="figure-img img-fluid img-thumbnail" alt="figure-image">
                <figcaption class="figure-caption">
                  <p class="text-center font-weight-bolder">Pies</p>
                </figcaption>
              </figure>
            </div>
            <div class="col-12 col-sm-6 col-lg-4">
              <figure class="figure shadow-lg p-3">
                <img src="img/coffee.jpg" class="figure-img img-fluid img-thumbnail" alt="figure-image">
                <figcaption class="figure-caption">
                  <p class="text-center font-weight-bolder">Coffee</p>
                </figcaption>
              </figure>
            </div>
          </div>
        </div>
      </div>
      <!-- END FIGURES-->
      <!-- ASIDE AREA START -->
      <div class="col-12 col-lg-4">
        <div class="card shadow-lg border-info mb-3">
          <div class="card-header bg-info text-white">
            <h2 class="lead"> Recently Added to Menu</h2>
          </div>
          <div class="card-body">
            <?php
            global $ConnectingDB;
            $sql = "SELECT * FROM products ORDER BY id desc LIMIT 0,5";
            $stmt = $ConnectingDB->query($sql);
            while ($DataRows = $stmt->fetch()) {
              $PostId = $DataRows["id"];
              $DateTime = $DataRows["datetime"];
              $ProductImage = $DataRows["product_image"];
              $Category = $DataRows["category"];
              $ProductTitle = $DataRows["product_name"];
            ?>
              <div class="media">
                <img src="Uploads/<?php echo htmlentities($ProductImage); ?>" class="d-block img-fluid align-self-start" width="90" height="94" alt="">
                <div class="media-body ml-2">
                  <a style="text-decoration:none;" href="healthyFood.php">
                    <h6 class="lead"><?php echo htmlentities($ProductTitle); ?></h6>
                  </a>
                  <p class="small"><?php echo htmlentities($DateTime); ?></p>
                </div>
              </div>
              <hr>
            <?php } ?>
          </div>
        </div>
        <hr>
        <div class="card shadow-lg border-dark">
          <div class="card-header bg-primary text-light">
            <h2 class="lead">Categories</h2>
          </div>
          <div class="card-body">
            <?php
            global $ConnectingDB;
            $sql = "SELECT * FROM category ORDER BY id desc";
            $stmt = $ConnectingDB->query($sql);
            while ($DataRows = $stmt->fetch()) {
              $CategoryId = $DataRows["id"];
              $CategoryName = $DataRows["title"];
            ?>
              <a href="healthyFood.php?category=<?php echo htmlentities($CategoryName); ?>"> <span class="heading"> <?php echo htmlentities($CategoryName); ?></span> </a><br>
            <?php } ?>
          </div>
        </div>
        <hr>
      </div>
    </div>
  </div>
  </div>
  <!-- END ASIDE AREA -->
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
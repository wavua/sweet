<?php require_once "Includes/DB.php"; ?>
<?php require_once "Includes/function.php"; ?>
<?php require_once "Includes/session.php"; ?>
<?php
if (isset($_POST["add"])) {
  // print_r($_POST["product_id"]);
  if (isset($_SESSION['cart'])) {

    $item_array_id = array_column($_SESSION['cart'], "product_id");

    if (in_array($_POST['product_id'], $item_array_id)) {
      echo "<script>alert('Product is already added in the cart..!')</script>";
      echo "<script>window.location = 'healthyFood.php'</script>";
    } else {

      $count = count($_SESSION['cart']);
      $item_array = array(
        'product_id' => $_POST['product_id']
      );

      $_SESSION['cart'][$count] = $item_array;
    }
  } else {

    $item_array = array(
      'product_id' => $_POST['product_id']
    );

    // Create new session variable
    $_SESSION['cart'][0] = $item_array;
    //print_r($_SESSION['cart']);
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sweet-Treats-food-list</title>
  <link rel="stylesheet" href="bootstrap4/css/bootstrap.min.css" />
  <link rel="stylesheet" href="fontawesom5/css/all.css">
  <link rel="stylesheet" href="Includes/style.css">
</head>

<body>
  <!-- NAVBAR AREA -->
  <div style="height: 10px; background: #27aae1;"></div>
  <nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">Sweet Treats</a>
      <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="collapsibleNavId">
        <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item active">
            <a class="nav-link" href="healthyFood.php">Menu</a>
          </li>
          <li class="nav-item">
            <a href="MyCart.php" class="nav-link active">
              <h5 class="cart">
                <i class="fas fa-shopping-cart"></i> MyCart
                <?php
                if (isset($_SESSION['cart'])) {
                  $count = count($_SESSION['cart']);
                  echo "<span id=\"cart_count\" class=\"text-warning bg-light\">$count</span>";
                } else {
                  echo "<span id=\"cart_count\" class=\"text-warning bg-light\">0</span>";
                }
                ?>
              </h5>
            </a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <form class="form-inline d-none d-sm-block mr-5 " action="healthyFood.php">
            <div class="input-group my-2">
              <input class="form-control " type="text" name="Search" placeholder="Search here">
              <div class="input-group-append">
                <button class="btn btn-primary btn-sm" name="SearchButton">Search</button>
              </div>
            </div>
          </form>
        </ul>
      </div>
    </div>
  </nav>
  <div style="height: 10px; background: #27aae1;" class="mb-1"></div>
  <!-- END OF NAVBAR AREA -->
  <div class="container">
    <div class="row text-center py-5">
      <?php
      global $ConnectingDB;
      if (isset($_GET["SearchButton"])) {
        $Search = htmlspecialchars($_GET["Search"]);
        $sql = "SELECT * FROM products
            WHERE datetime LIKE :search
            OR product_name LIKE :search
            OR product_price LIKE :search
            OR category LIKE :search";
        $stmt = $ConnectingDB->prepare($sql);
        $stmt->bindValue(':search', '%' . $Search . '%');
        $stmt->execute();
      } // Query When Pagination is Active i.e foodlist.php?page=1
      elseif (isset($_GET["page"])) {
        $Page = htmlspecialchars($_GET["page"]);
        if ($Page == 0 || $Page < 1) {
          $ShowPostFrom = 0;
        } else {
          $ShowPostFrom = ($Page * 20) - 20;
        }
        $sql = "SELECT * FROM products ORDER BY id desc LIMIT $ShowPostFrom,20";
        $stmt = $ConnectingDB->query($sql);
      } // Query When Category is active in URL Tab
      elseif (isset($_GET["category"])) {
        $Category = $_GET["category"];
        $sql = "SELECT * FROM products WHERE category='$Category' ORDER BY id desc";
        $stmt = $ConnectingDB->query($sql);
      }
      // The default SQL query
      else {
        $sql  = "SELECT * FROM products ORDER BY id desc LIMIT 0,20";
        $stmt = $ConnectingDB->query($sql);
      }
      while ($DataRows = $stmt->fetch()) {
        $PostId          = $DataRows["id"];
        $ProductTitle    = $DataRows["product_name"];
        $ProductImage    = $DataRows["product_image"];
        $ProductPrice  = $DataRows["product_price"];
        component(
          $ProductTitle,
          $ProductPrice,
          $ProductImage,
          $PostId
        );
      }
      ?>
    </div>
    <!-- Pagination -->
    <nav>
      <ul class="pagination pagination-lg justify-content-center">
        <!-- Creating Backward Button -->
        <?php if (isset($Page)) {
          if ($Page > 1) { ?>
            <li class="page-item">
              <a href="healthyFood.php?page=<?php echo $Page - 1; ?>" class="page-link">&laquo;</a>
            </li>
        <?php }
        } ?>
        <?php
        global $ConnectingDB;
        $sql           = "SELECT COUNT(*) FROM products";
        $stmt          = $ConnectingDB->query($sql);
        $RowPagination = $stmt->fetch();
        $TotalPosts    = array_shift($RowPagination);
        $PostPagination = $TotalPosts / 8;
        $PostPagination = ceil($PostPagination);

        for ($i = 1; $i <= $PostPagination; $i++) {
          if (isset($Page)) {
            if ($i == $Page) {  ?>
              <li class="page-item active">
                <a href="healthyFood.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
              </li>
            <?php
            } else {
            ?> <li class="page-item">
                <a href="healthyFood.php?page=<?php echo $i; ?>" class="page-link"><?php echo $i; ?></a>
              </li>
        <?php  }
          }
        } ?>
        <!-- Creating Forward Button -->
        <?php if (isset($Page) && !empty($Page)) {
          if ($Page + 1 <= $PostPagination) { ?>
            <li class="page-item">
              <a href="healthyFood.php?page=<?php echo $Page + 1; ?>" class="page-link">&raquo;</a>
            </li>
        <?php }
        } ?>
      </ul>
    </nav>
  </div>

  </div>
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
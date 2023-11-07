<?php
require_once "../sing/controllerUserData.php";

$email = $_SESSION['email'];
$password = $_SESSION['password'];
if ($email != false && $password != false) {
  $sql = "SELECT * FROM usertable WHERE email like '$email'";
  $run_Sql = mysqli_query($con, $sql);
  if ($run_Sql) {
    $fetch_info = mysqli_fetch_assoc($run_Sql);
    $status = $fetch_info['status'];
    $code = $fetch_info['code'];
    if ($status == "verified") {
      if ($code != 0) {
        header('Location: ../sing/reset-code.php');
      }
    } else {
      header('Location: ../sing/user-otp.php');
    }
  }
} else {
  header('Location: ../user_no/home.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="author" content="CodeHim">
  <title>HOME</title>
  <link rel="stylesheet" href="./css/style.css">
  <link rel="stylesheet" href="./css/demo.css">
  <link rel="stylesheet" href="./style/style.css">
  <link rel="stylesheet" href="style/home.css">
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css'>
  <style>
    .ribbons {
      -webkit-clip-path: polygon(10% 25%, 10% 0, 35% 0%, 65% 0%, 90% 0, 90% 25%, 90% 50%, 91% 100%, 50% 73%, 10% 100%, 10% 50%);
      clip-path: polygon(10% 25%, 10% 0, 35% 0%, 65% 0%, 90% 0, 90% 25%, 90% 50%, 91% 100%, 50% 73%, 10% 100%, 10% 50%);
      position: absolute;
      top: 0px;
      background-color: #ffc107;
      padding: 31px 15px;
      text-align: center;
      left: 10px;
      font-family: 'Circular Std Medium';
      color: #fff;
    }
    .ribbons-text {
      transform: rotate(90deg);
      position: absolute;
      top: 11px;
      left: 10px;
      color: #fff;
    }
    .category-buttons {
     display: flex;
     justify-content: center;
     gap: 10px;
     margin-bottom: 20px;
   }
   .category-button {
     padding: 10px 20px;
     background-color: #1B1B1B;
     border: none;
     border-radius: 5px;
     font-family: 'Circular Std Medium';
     color: #fff;
     cursor: pointer;
   }
   .category-button.active {
     background-color: #ff8800;
   }

  </style>
</head>
<body>
  <header>
    <?php include_once 'navbar.php'; ?>
  </header>
  <main class="cd__main">
    <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative">
      <div class="category-buttons">
        <button class="category-button active" data-category-id="all">Show All</button>
        <?php
        // Fetch all categories from the category table
        $categorySql = "SELECT * FROM category";
        $categoryResult = mysqli_query($con, $categorySql);

        while ($categoryRow = mysqli_fetch_assoc($categoryResult)) {
          $categoryId = $categoryRow['id_cat'];
          $categoryName = $categoryRow['name'];
          echo "<button class='category-button' data-category-id='$categoryId'>$categoryName</button>";
        }
        ?>
      </div>
      <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3 product-list">
        <?php
        // Fetch all products initially
        $allProductsSql = "SELECT coondition, u.img as pro, u.name, t.item_id, item_name, descrition, coondition, t.img
                           FROM item t JOIN usertable u ON u.id = t.id_user
                           WHERE email NOT LIKE '$email' ORDER BY RAND()";
        $allProductsResult = $con->query($allProductsSql);

        while ($row = $allProductsResult->fetch_assoc()) {
          $img = $row["img"];
          $imgg = explode(",", $img);
          $img_name = $imgg["0"];
          $string = $row["descrition"];
          $word_array = explode(" ", $string);
          $first_four_words = implode(" ", array_slice($word_array, 0, 3));
          $first_four_words = substr($first_four_words, 0, 30);
          $id_item = $row['item_id'];
          ?>
          <div class="col hp">
            <div class="card h-100 shadow-sm">
              <a href='item_info.php?id=<?php echo $id_item; ?>'>
                <img src="<?php echo $img_name; ?>" class="card-img-top" alt="item_img">
              </a>
              <div class="ribbons"></div>
              <div class="ribbons"><?php echo $row['coondition']; ?></div>
              <div class="card-body">
                <h3 class="card-title"><?php echo $row["item_name"]; ?></h3>
                <div class="card-body">
                  <p class="card-text"><?php echo $first_four_words."..."; ?></p>
                </div>
                <img src="<?php echo $row['pro']; ?>" class="profile">
                <dev style="font-family:Greycliff CF"><?php echo $row['name']; ?></dev>
                <div class="d-grid gap-2 my-4">
                  <a href="item_info.php?id=<?php echo $id_item; ?>" class="btn btn-warning bold-btn">Ask for swap</a>
                </div>
              </div>
            </div>
          </div>
          <?php
        }
        ?>
      </div>
    </div>
  </main>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script>
  $(document).ready(function() {
    $('.category-button').click(function() {
      $('.category-button').removeClass('active');
      $(this).addClass('active');
      var categoryId = $(this).data('category-id');

      // Check if the "Show All" button is clicked
      if (categoryId === 'all') {
        // Fetch all products initially
        categoryId = ''; // Empty category ID to fetch all products
      }

      // Filter the products based on the selected category
      $('.product-list').empty();

      $.ajax({
        type: "POST",
        url: "get_products.php",
        data: { category_id: categoryId },
        success: function(response) {
          $('.product-list').html(response);
        }
      });
    });
  });
  </script>
<?php require_once 'footer.php' ?>
</body>
</html>

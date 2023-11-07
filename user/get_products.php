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
$categoryID = $_POST['category_id'];

// Fetch all products based on the selected category
if ($categoryID === '') {
  // Fetch all products if no category is selected
  $allProductsSql = "SELECT coondition, u.img AS pro, u.name, t.item_id, item_name, descrition, coondition, t.img
                     FROM item t JOIN usertable u ON u.id = t.id_user
                     WHERE email NOT LIKE '$email'";

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

    <div class="col hp" style="display: none;">
      <div class="card h-100 shadow-sm">
        <a href='item_info.php?id=<?php echo $id_item; ?>'>
          <img src="<?php echo $img_name; ?>" class="card-img-top" alt="item_img">
        </a>
        <div class="ribbons"></div>
        <div class="ribbons-text"><?php echo $row['coondition']; ?></div>
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
} else {
  $categoryProductsSql = "SELECT coondition, u.img AS pro, u.name, t.item_id, item_name, descrition, coondition, t.img
                          FROM item t JOIN usertable u ON u.id = t.id_user
                          WHERE email NOT LIKE '$email' AND category = '$categoryID'";

  $categoryProductsResult = $con->query($categoryProductsSql);

  while ($row = $categoryProductsResult->fetch_assoc()) {
    $img = $row["img"];
    $imgg = explode(",", $img);
    $img_name = $imgg["0"];
    $string = $row["descrition"];
    $word_array = explode(" ", $string);
    $first_four_words = implode(" ", array_slice($word_array, 0, 3));
    $first_four_words = substr($first_four_words, 0, 30);
    $id_item = $row['item_id'];
    ?>

    <div class="col hp" style="display: none;">
      <div class="card h-100 shadow-sm">
        <a href='item_info.php?id=<?php echo $id_item; ?>'>
          <img src="<?php echo $img_name; ?>" class="card-img-top" alt="item_img">
        </a>
        <div class="ribbons"></div>
        <div class="ribbons-text"><?php echo $row['coondition']; ?></div>
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
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $('.col.hp').show(300); // Show all cards with sliding effect
});
</script>

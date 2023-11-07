<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "swap_project";
$conn = new mysqli($server, $username, $password, $dbname);

$categoryID = $_POST['category_id'];

// Fetch all products based on the selected category
if ($categoryID === 'all' || $categoryID === '') {
  // Fetch all products if "Show All" button is clicked
  $sql = "SELECT item_id, coondition, u.img AS pro, u.name, item_name, descrition, coondition, t.img FROM item t JOIN usertable u ON u.id = t.id_user";
} else {
  $sql = "SELECT item_id, coondition, u.img AS pro, u.name, item_name, descrition, coondition, t.img FROM item t JOIN usertable u ON u.id = t.id_user WHERE category = '$categoryID'";
}

$result = $conn->query($sql);

while ($row = $result->fetch_assoc()) {
  $img = "../user/" . $row["img"];
  $imgg = explode(",", $img);
  $img_name = $imgg[0];
  $string = $row["descrition"];
  $word_array = explode(" ", $string);
  $first_four_words = implode(" ", array_slice($word_array, 0, 4));
  $first_four_words = substr($first_four_words, 0, 30);
  $id_item = $row['item_id'];
  ?>
  <div class="col hp">
    <div class="card h-100 shadow-sm">
      <a href="../sing/login-user.php">
        <?php echo "<img src='$img_name' class='card-img-top' alt='echo' /> "; ?>
      </a>
      <div class="ribbons"></div>
      <div class="ribbons-text"><?php echo $row['coondition']; ?></div>
      <div class="card-body">
        <h3 class="card-title"><?php echo $row["item_name"]; ?></h3>
        <div>
          <div class="card-body">
            <p class="card-text"><?php echo $first_four_words . "..."; ?></p>
          </div>
          <img src="<?php echo "../user/" . $row['pro']; ?>" class="profile">
          <dev style="font-family:Greycliff CF"><?php echo $row['name']; ?></dev>
        </div>
        <div class="d-grid gap-2 my-4">
          <?php
          echo "<a href='../sing/login-user.php' class='btn btn-warning bold-btn'>Ask for swap</a>";
          ?>
        </div>
      </div>
    </div>
  </div>
  <?php
}
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $('.col.hp').show(300); // Show all cards with sliding effect
});
</script>

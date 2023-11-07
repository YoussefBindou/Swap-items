<!DOCTYPE html>
<html lang="en">
  <head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="./style/navbar.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" />
    <link rel="stylesheet"href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" />
  </head>
  <body>


    <div id="menuHolder">
      <div role="navigation" class="sticky-top border-bottom border-top" id="mainNavigation">
        <div class="flexMain">
          <div class="flex2">
            <button class="whiteLink siteLink" style="border-right:1px solid #eaeaea" onclick="menuToggle()"><i class="fas fa-bars me-2"></i> MENU</button>
          </div>
          <div class="flex3 text-center" id="siteBrand">
            <a class="navbar-brand" href="home.php">SWAP ITEMS</a>
          </div>
          <div class="flex2 text-end d-none d-md-block">

          </div>
        </div>
      </div>

      <div id="menuDrawer">
        <div class="p-4 border-bottom">
          <div class='row'>

            <div class="col text-end ">
              <i class="fas fa-times" role="btn" onclick="menuToggle()"></i>
            </div>

          </div>

        </div>


        <div>
          <a href="../user/profile_update.php" class="nav-menu-item" > <img src="<?php echo "../user/".$fetch_info['img']?>" class="profile"  class="profile" > <?php echo $fetch_info['name'] ?></a>
          <a href="../user/profile_update.php" class="nav-menu-item">
          <a href="home.php" class="nav-menu-item"><i class="fas fa-home me-3" ></i>Home</a>
<a href="list_users.php" class="nav-menu-item">
  <i class="fas fa-users"></i> <!-- Icon for list users -->
  List Users
</a>
<a href="list_categorys.php" class="nav-menu-item">
  <i class="fas fa-folder-plus"></i> <!-- Icon for list categories -->
  List Categories
</a>
<a href="list_items.php" class="nav-menu-item">
<i class="fas fa-folder-plus"></i><!-- Icon for list items -->
  List Items
</a>
<a href="list_report.php" class="nav-menu-item">
<i class="fas fa-folder-plus"></i><!-- Icon for list items -->
  List report
</a>
<a href="#" class="nav-menu-item" onclick="showadd_Category()">
  <i class="fas fa-plus"></i> <!-- Icon for add category -->
  Add Category
</a>
<a href="../user/home.php" class="nav-menu-item">
  <i class="fas fa-sign-out-alt"></i> <!-- Icon for log out -->
  FRONTEND
</a>
<a href="../sing/logout-user.php" class="nav-menu-item">
  <i class="fas fa-sign-out-alt"></i> <!-- Icon for log out -->
  Log Out
</a>



        </div>
      </div>
    </div>
    <script>
      var menuHolder = document.getElementById('menuHolder')
      var siteBrand = document.getElementById('siteBrand')
      function menuToggle(){
        if(menuHolder.className === "drawMenu") menuHolder.className = ""
        else menuHolder.className = "drawMenu"

      }
      if(window.innerWidth < 426) siteBrand.innerHTML = "SWAP ITEMS"
      window.onresize = function(){
        if(window.innerWidth < 420) siteBrand.innerHTML = "SWAP ITEMS"
        else siteBrand.innerHTML = "ITEMS SWAP"
      }</script>

  </body>
</html>

<style>


.profile{
height: 50px;
width:50px;
margin:auto;
border-radius: 50%;
}
.nav-menu-item img{
height: 50px;
width:50px;
margin:auto;
border-radius: 50%;
}
</style>
<script>
function showadd_Category() {
  // Display the add_Category modal
  $('#add_Category').modal('show');
}
</script>

<!-- add Category Modal -->
<div class="modal fade" id="add_Category" tabindex="-1" aria-labelledby="add_CategoryLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addCategoryModalLabel">Add Category</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addCategoryForm" method="post">
          <div class="mb-3">
            <label for="CategoryName" class="form-label">Category Name</label>
            <input type="text" class="form-control" id="CategoryName" name="CategoryName" required>
            <label for="CategoryDescription" class="form-label">Category Description</label>
            <input type="text" class="form-control" id="CategoryDescription" name="CategoryDescription" required>
          </div>
          <button type="submit" class="btn btn-primary" name="addCategory">Add Category</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- PHP code to insert the category into the database table -->
<?php
if(isset($_POST['addCategory'])) {
  $categoryName = $_POST['CategoryName'];
  $categoryDescription = $_POST['CategoryDescription'];

  // Perform the database insertion here
  // Replace 'your_table_name' with the actual name of your table
  $sql = "INSERT INTO category (name, descr) VALUES ('$categoryName', '$categoryDescription')";
  $result = mysqli_query($con, $sql);

  if ($result) {
    // Data inserted successfully
    echo '<script>alert("Bureau added successfully!");</script>';
  } else {
    // Error occurred
    echo '<script>alert("Error: ' . mysqli_error($con) . '");</script>';
  }
}
?>

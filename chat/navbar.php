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
            <a class="navbar-brand" href="../user/home.php">SWAP ITEMS</a>
          </div>
          <div class="flex2 text-end d-none d-md-block">
            <nav >
              <ul>

                <li>
                 <a href="../user/home.php"> <span class="material-icons-outlined" title="Home" > home </span></a>
                </li>
                <li>
                  <a href="../user/up_load_item.php"> <span class="material-icons-outlined" title="add item"> add_box </span></a>
                </li>

                <li>
                <img src="<?php echo "../user/".$fetch_info['img']?>" class="profile" >
                  <ul>

                    <li class="sub-item">
                      <a href="../chat/users.php"><span class="material-icons-outlined"> forum </span></a><p>chats</p>
                    </li>
                    <li class="sub-item">

                      <a href="../user/myitems.php"><span class="material-icons-outlined">format_list_bulleted</span></a> <p>My Items </p>
                    </li>
                    <li class="sub-item">
                      <a href="../user/profile_update.php" onclick="showPage()"><span class="material-icons-outlined"> manage_accounts </span></a><p>Update Profile</p>
                    </li>
                    <li class="sub-item">
                      <a href="../sing/logout-user.php"><span class="material-icons-outlined"> logout </span></a><p>Log out</p>

                    </li>
                  </ul>
                </li>
              </ul>
            </nav>
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
        <a href="../user/profile_update.php" class="nav-menu-item" >
          <img src="<?php echo "../user/".$fetch_info['img'];?>" class="profile" ><?php echo $fetch_info['name'] ?></a>
          <a href="../user/home.php" class="nav-menu-item"><i class="fas fa-home me-3" ></i>Home</a>
          <a href="../user/up_load_item.php" class="nav-menu-item"><i class="fas fa-plus-square me-3"></i>Add Items</a>
          <a href="../chat/users.php" class="nav-menu-item"><i class="far fa-comment me-3"></i></i></i>chat</a>
          <a href="../user/myitems.php" class="nav-menu-item"><i class="fas fa-list  me-3"></i>My Items </a>

          <a href="#" class="nav-menu-item"><i class="fas fa-building me-3"></i>About Us</a>
          <?php

                    if($_SESSION['admin']==1){

                    ?>
          <a href="../admin" class="nav-menu-item"><i class="fas fa-user-shield me-3"></i>admin</a>
          <?php
                    }
                    ?>
          <a href="../sing/logout-user.php" class="nav-menu-item"><i class="fas fa-sign-out-alt me-3"></i>Log Out</a>


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

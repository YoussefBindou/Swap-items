<!DOCTYPE html>
<html lang="en">
  <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style/navbar.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"><link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>navbar</title>
    
  </head>
  <body>
    <style>
    
    </style>
    
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
           <a href="../sing/login-user.php " id="Login" class="btn btn-outline-dark">Login</a>
           
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
          <a href="../sing/login-user.php" class="nav-menu-item" ><i class="fas fa-building me-3"></i> Login</a>
          <a href="#" class="nav-menu-item"><i class="fas fa-home me-3"></i>Home</a>
          <a href="#footer" class="nav-menu-item"><i class="fas fa-building me-3"></i>About Us</a>

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

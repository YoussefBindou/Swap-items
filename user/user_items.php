<?php require_once "../sing/controllerUserData.php"; ?>
<?php
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email like '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: ../sing/reset-code.php');
            }
        }else{
            header('Location: ../sing/user-otp.php');
        }
    }
}else{
    header('Location: ../user_no/home.php');
}

// Check if the user_id parameter is set
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];

    // Fetch the user's information
    $user_query = "SELECT * FROM usertable WHERE id = $user_id";
    $user_result = $con->query($user_query);
    $user = $user_result->fetch_assoc();

    // Fetch the user's items
    $items_query = "SELECT coondition,u.img as pro ,u.name,t.item_id,item_name,descrition,coondition,u.id,t.img from item t join usertable u on u.id=t.id_user
    WHERE id_user = $user_id";
    $items_result = $con->query($items_query);
} else {
    // If user_id parameter is not set, redirect to homepage or display an error message
    header('Location: ../user_no/home.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="CodeHim">
    <title>User Items</title>

    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/demo.css">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="style/user_items.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css'>
</head>

<body>
    <header>
        <?php include_once 'navbar.php'; ?>
    </header>

    <main class="cd__main">
               <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative">
        <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
          <?php


              while($row = $items_result->fetch_assoc()) {
              $img =  $row["img"] ;
              $imgg = explode(",",$img);
              $img_name = $imgg["0"];
              $string = $row["descrition"];
              $word_array = explode(" ", $string);
              $first_four_words = implode(" ", array_slice($word_array, 0, 3));
              $first_four_words = substr($first_four_words, 0, 30);
              $id_item= $row['item_id'];
          ?>


          <div class="col hp">
            <div class="card h-100 shadow-sm">
            <?php
            $p = $row['item_id'];
              echo "<a href='item_info.php?id=$p' >";



                echo "<a href = 'item_info.php?id=$id_item'><img src=  '$img_name' class='card-img-top' alt='item_img' /></a> ";?>
              </a>
              <div class="ribbons"></div>
              <div class="ribbons-text"><?php echo $row['coondition'] ;?></div>

              <div class="card-body">
                <h3 class="card-title"><?php echo $row["item_name"] ; ?></h3>
              <div>
              <div class="card-body">
          <p class="card-text"><?php echo $first_four_words."..." ;?></p>
        </div>
        <?php
        echo '<img src="' . $row['pro'] . '" class="profile">
        <a href="user_items.php?user_id=' . $row['id'] . '" style="font-family:Greycliff CF; color: black;
        text-decoration: none";>' . $row['name'] . '</a>';?>


                <div class="d-grid gap-2 my-4">
                <?php
                $id_item= $row['item_id'];
                 echo "<a href='item_info.php?id=$id_item' class='btn btn-warning bold-btn'>asK for swap</a>";
                 ?>

                </div>

              </div></div></div>
              </div>

          <?php
              }


          ?>
        </div>
      </div>


            </main>
</body>

</html>

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
      </style>

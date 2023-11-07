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
?>

<?php include_once "header.php"; ?>

<body>
 <div >
    <div class="wrapper">
    <section class="chat-area">
      <header>


        <?php

          $user_id = $_GET['user_id'];
          $_SESSION['id_res']=$user_id;
          $sql = mysqli_query($con, "SELECT * FROM usertable WHERE unique_id = {$user_id}");
          if(mysqli_num_rows($sql) > 0){
            $row = mysqli_fetch_assoc($sql);
          }else{
            header("location: users.php");
          }
        ?>
        <a href="users.php" class="back-icon"><i class="fas fa-arrow-left"></i></a>
        <img src="../user/<?php echo $row['img']; ?>" alt="">
        <div class="details">
          <span><?php echo $row['name'] ?></span>
          <p><?php echo $row['status_o_f']; ?></p>
        </div>
        <a href="../user/chooseitem.php?id=<?php echo $user_id; ?>" class="cart-icon"><i class="fas fa-cart-plus fa-lg" style="color: #000000;"></i></a>

      </header>
      <div class="chat-box">

      </div>
      <form action="#" class="typing-area">
        <input type="text" class="incoming_id" name="incoming_id" value="<?php echo $user_id; ?>" hidden>
        <input type="text" name="message" class="input-field" placeholder="Type a message here..." autocomplete="off">
        <button><i class="fab fa-telegram-plane"></i></button>
      </form>
    </section>
  </div>
  </div>

  <script src="javascript/chat.js"></script>

</body>
</html>
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
    .cart-icon {
  font-size: 24px;
  padding-left: 110px;
  }
  </style>

<?php require_once "../sing/controllerUserData.php"; ?>
<?php
$id_item = $_GET['id'];
session_commit();
$sameguy = "SELECT id_user FROM item WHERE item_id =".$id_item;

$result = mysqli_query($con, $sameguy);

$email = $_SESSION['email'];
$password = $_SESSION['password'];
$id_user = $_SESSION['id']; //4adi na5od hadi f sing up
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email like '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        $a=$fetch_info['admin'];
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
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="product.css">
    <style>
      body {
        background-color: #ecedee;
      }

      .card {
        border: none;
        overflow: hidden;
      }

      .main_image {
        display: flex;
        justify-content: center;
        align-items: center;
        border-bottom: 1px solid #eee;
        height: 400px;
        width: 100%;
        overflow: hidden;
      }
      body {
      background-color: #ecedee;
    }

    .card {
      border: none;
      overflow: hidden;
    }

    .main_image {
      display: flex;
      justify-content: center;
      align-items: center;
      border-bottom: 1px solid #eee;
      height: 400px;
      width: 100%;
      overflow: hidden;
    }

    .main_image img {
      object-fit: cover;
      width: 100%;
      height: 100%;
      transition: transform 0.3s ease-in-out;
    }

    .main_image img:hover {
      transform: scale(1.2);
    }

      .main_image img {
        object-fit: cover;
        width: 100%;
        height: 100%;
      }

      .thumbnail_images ul {
        list-style: none;
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        flex-wrap: wrap;
        padding: 0;
        margin: 0;
      }

      .thumbnail_images ul li {
        margin: 5px;
        padding: 0;
        width: 70px;
        height: 70px;
        overflow: hidden;
      }

      .thumbnail_images ul li img {
        width: 100%;
        height: 100%;
        object-fit: cover;
      }

      .thumbnail_images ul li:hover {
        border: 2px solid #000;
      }

      .right-side {
        position: relative;
      }

      .buttons .btn {
        height: 50px;
        width: 150px;
        border-radius: 0px !important;
      }
      .carousel-item img {
    height: 400px; /* set the height that you want */
    width: 100%; /* set to full width */
    object-fit: contain; /* scales the image as large as possible without cropping or stretching the image */
}
.carousel-control-prev, .carousel-control-next {
    width: 50px;
    height: 50px;
    justify-content: center;
    align-items: center;
    border-radius: 50%;
    transition: background-color 0.3s;
}

.carousel-control-prev:hover, .carousel-control-next:hover {
    background-color: rgba(0, 0, 0, 0.1);
}

.carousel-control-prev-icon, .carousel-control-next-icon {
    filter: invert(1);
}

.carousel-control-prev-icon:hover, .carousel-control-next-icon:hover {
    filter: invert(0.5);
}

    </style>
    <title></title>
  </head>
  <body>
    <?php include_once 'navbar.php'; ?>
    <form id="trade-form" method="post">
      <div class="container mt-5 mb-5">
        <div class="card">
          <div class="row g-0">
            <div class="col-md-6 border-end">
              <div class="d-flex flex-column justify-content-center">
                  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
                      <div class="carousel-inner">
                          <?php
                          if($result && mysqli_num_rows($result) > 0){
                          if ($result = mysqli_query($con, ("SELECT i.*, u.img as pro ,u.name FROM item i join usertable u on i.id_user = u.id WHERE item_id =" . $id_item))) {
                              if ($row = $result->fetch_assoc()) {
                                  $imagePathsString = $row['img'];
                                  $imagePaths = explode(',', $imagePathsString); // Split the string into an array using the comma delimiter

                                  for ($i = 0; $i < count($imagePaths); $i++) {
                                      $carouselImage = $imagePaths[$i];
                                      if ($i == 0) { // First image gets "active" class
                                          echo '<div class="carousel-item active">';
                                      } else {
                                          echo '<div class="carousel-item">';
                                      }
                                      echo '<img src="' . $carouselImage . '" class="d-block w-100" alt="Image">';
                                      echo '</div>';
                                  }
                              } else {
                                  echo 'No images found.';
                              }
                          }
                          ?>
                      </div>
                      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Previous</span>
                      </button>
                      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                          <span class="carousel-control-next-icon" aria-hidden="true"></span>
                          <span class="visually-hidden">Next</span>
                      </button>
                  </div>
              </div>
          </div>


            <div class="col-md-6">
              <div class="p-3 right-side">
                <div class="d-flex justify-content-between align-items-center">

                  <?php
                  if ($result = $con->query("SELECT i.*, u.img as pro ,u.name,u.id FROM item i join usertable u on i.id_user = u.id WHERE item_id =" . $id_item)) {
                    $row = $result->fetch_assoc();
                    $name = $row['item_name'];
                    echo "<div class='border-bottom pb-3 mb-3'>
                        <h2 class='mb-3'>$name</h2></div>";
                  } else {
                    echo "null";
                  }
                  ?>
                  </h3>
                </div>
                <div class="mt-2 pr-3 content">
                  <p>
                    <?php
                    if ($result = $con->query("SELECT i.*, u.img as pro ,u.name,u.id FROM item i join usertable u on i.id_user = u.id WHERE item_id =" . $id_item)) {
                      $row = $result->fetch_assoc();
                      ?>
                      <div class="product-description">
                        <h4 class="mb-1">Descriptions</h4>
                        <p><?php echo $row['descrition']; ?></p>
                        <?php
                        $id =  $row['id_user'];
                        if($id_user != $id){
                        echo '<img src="' . $row['pro'] . '" class="profile">
                        <a href="user_items.php?user_id=' . $row['id'] . '" style="font-family:Greycliff CF; color: black;
                        text-decoration: none";>' . $row['name'] . '</a>';
                    echo"</div>";
                  }
                  else {
                    echo '<img src="' . $row['pro'] . '" class="profile">
                    <a href="myitems.php?user_id=' . $row['id'] . '" style="font-family:Greycliff CF; color: black;
                    text-decoration: none";>' . $row['name'] . '</a>';
                  }


                  $result = $con->query("select unique_id from usertable where id = $id");
                  $row = $result->fetch_assoc();
                  $id1 = $row["unique_id"];
                  $_SESSION['id_res'] = $id1;
                  ?>
                  </p>
                </div>
                <div class="buttons d-flex flex-row mt-5 gap-3">


                <?php
                if ($result && mysqli_num_rows($result) == 0) {
                }  else {
                if($id_user != $id){
                echo "<a href='send_item_msg.php?user_id=$id1&item_id=$id_item'><button type='button' name='submit' class='btn btn-outline-dark' id='message'>Request Trade</button></a>";
              ?>
                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#sendreportModal">Report</button>
                <?php 
                      if($a== 1){
                    ?>
                      
                <form  method="POST"  onsubmit="return confirm('Are you sure you want to delete this item?');">
                   
                    <button  type="submit" id="Confirm" name="delete_item" value="<?= $item['item_id']; ?>" class="btn btn-danger">Delete Item</button>
                    <form>
                    
                    <?php 
                      }
                    ?>
                  <?php
                  }
                    }
                    }
                  ?>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </form>

  </body>
</html>


<script>
  var currentImageIndex = 0;
  var thumbnailImages = document.querySelectorAll('.thumbnail_images ul li img');
  var mainProductImage = document.getElementById('main_product_image');

  // Change the main image when a thumbnail is clicked
  function changeImage(element) {
    currentImageIndex = Array.from(thumbnailImages).indexOf(element);
    mainProductImage.src = element.src;
  }

  // Change to the previous image
  function previousImage() {
    currentImageIndex--;
    if (currentImageIndex < 0) {
      currentImageIndex = thumbnailImages.length - 1;
    }
    mainProductImage.src = thumbnailImages[currentImageIndex].src;
  }

  // Change to the next image
  function nextImage() {
    currentImageIndex++;
    if (currentImageIndex >= thumbnailImages.length) {
      currentImageIndex = 0;
    }
    mainProductImage.src = thumbnailImages[currentImageIndex].src;
  }

  // Automatically change the image every 5 seconds
  setInterval(nextImage, 5000);
</script>
<script>
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
    <!-- send report Modal -->
    <div class="modal fade" id="sendreportModal" tabindex="-1" aria-labelledby="sendreportModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="sendreportModalLabel">send report</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="sendreportForm" method="post">
                        <div class="mb-3">
                            <label for="oldreport" class="form-label"> report</label>
                            <textarea name="detail" class="form-control" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="sendreport" form="sendreportForm">send report</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
if (isset($_POST['sendreport'])) {
    $detail = $_POST['detail'];
    $id_item = $id_item; // Assuming $id_item is already defined

    // Check if the report text is not empty
    if (!empty($detail)) {
        // Insert the data into the report table
        $insertQuery = "INSERT INTO report (id_item, id_user, report_text) VALUES ('$id_item', '$id_user', '$detail')";
        if (mysqli_query($con, $insertQuery)) {
            echo '<script>alert("Report sent successfully.");</script>';
        } else {
            echo '<script>alert("Error sending report. Please try again later.");</script>';
        }
    } else {
        echo '<script>alert("Please enter a report.");</script>';
    }
}

// Check if the delete item form is submitted
if (isset($_POST['delete_item'])) {
    $itemId = $_POST['delete_item'];

    // Perform the deletion query
    $deleteItemQuery = "DELETE FROM item WHERE item_id = '$id_item'";
    $deleteItemResult = mysqli_query($con, $deleteItemQuery);

    if ($deleteItemResult) {
        // Deletion successful
        echo "<script>alert('delete_item deleted successfully.'); window.history.back();</script>";
        
    } else {
        // Deletion failed
        echo "<script>alert('Error deleting delete_item: " . mysqli_error($con) . "'); window.history.back();</script>";
    }
}

}
else {
  echo "This Item is not available";
}
?>
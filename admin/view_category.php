<?php
require_once "../sing/controllerUserData.php";

$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($_SESSION['admin'] != 1){
    header('Location: ../user/home.php');
}
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
<!doctype html>
<html lang="en">
<head>
<link rel="shortcut icon" href="../user/img/logo.png" type="image/x-icon">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../logo.webp" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Category information</title>
</head>
<body>

<header>
<?php

require 'navbar.php';
?>

</header>

    <div class="container mt-5"  style="padding-top: 60px;">

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>category information
                            <a href="home.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        if (isset($_GET['id'])) {
                            $category_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT * FROM category WHERE id_cat='$category_id' ";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $category = mysqli_fetch_array($query_run);
                                ?>

                                <div class="mb-3">
                                    <label>category Name</label>
                                    <p class="form-control">
                                        <?= $category['name']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>category Email</label>
                                    <p class="form-control">
                                        <?= $category['descr']; ?>
                                    </p>
                                </div>
                                

                                <?php
                            } else {
                                echo "<h4>No Such ID Found</h4>";
                            }
                        } else {
                            echo "<h4>Invalid ID</h4>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<style>
    .dark{
  color: white;
}

.white {
  color: white;
}

.card {
    background-color: #ffffff00;
    
}
</style>

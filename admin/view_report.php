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
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="shortcut icon" href="../user/img/logo.png" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../logo.webp" type="image/x-icon">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>report information</title>
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
                        <h4>report information
                            <a href="home.php" class="btn btn-danger float-end">BACK</a>
                        </h4>
                    </div>
                    <div class="card-body">

                        <?php
                        $id_item=0;
                        if (isset($_GET['id'])) {
                            $report_id = mysqli_real_escape_string($con, $_GET['id']);
                            $query = "SELECT r.id,i.item_name,u.name,report_text,i.item_id FROM report r join item i on i.item_id=r.id_item join usertable u on u.id = r.id_user where r.id = $report_id ";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                $report = mysqli_fetch_array($query_run);
                                $id_item=$report['item_id'] ;
                                ?>

                                <div class="mb-3">
                                    <label>report text</label>
                                    <p class="form-control">
                                        <?= $report['report_text']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                    <label>reporter</label>
                                    <p class="form-control">
                                        <?= $report['name']; ?>
                                    </p>
                                </div>
                                <div class="mb-3">
                                   <a href="../user/item_info.php?id= <?= $id_item ?>" class="btn btn-primary">Go to Item Info</a>
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


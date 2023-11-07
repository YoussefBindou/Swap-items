<?php
require_once "../sing/controllerUserData.php";

$email = $_SESSION['email'];
$password = $_SESSION['password'];
if ($_SESSION['admin'] != 1) {
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

    <title>User information</title>
</head>

<body>

<header>
    <?php
    require 'navbar.php';
    ?>
</header>

<div class="container mt-5" style="padding-top: 20px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>User information
                        <a href="home.php" class="btn btn-danger float-end">BACK</a>
                    </h4>
                </div>
                <div class="card-body">
                    <?php
                    if (isset($_GET['id'])) {
                        $User_id = mysqli_real_escape_string($con, $_GET['id']);
                        $query = "SELECT * FROM usertable WHERE id='$User_id' ";
                        $query_run = mysqli_query($con, $query);

                        if (mysqli_num_rows($query_run) > 0) {
                            $User = mysqli_fetch_array($query_run);
                            ?>

                            <!-- Display user image -->
                            <div class="mb-3 text-center">
                                <img src="<?= "../user/".$User['img']; ?>" alt="User Image" width="150">
                            </div>

                            <div class="mb-3">
                                <label>User Name</label>
                                <p class="form-control">
                                    <?= $User['name']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>User Email</label>
                                <p class="form-control">
                                    <?= $User['email']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>User Phone</label>
                                <p class="form-control">
                                    <?= $User['phone']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>User address</label>
                                <p class="form-control">
                                    <?= $User['address']; ?>
                                </p>
                            </div>
                            <div class="mb-3">
                                <label>city</label>
                                <p class="form-control">
                                    <?= $User['city']; ?>
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


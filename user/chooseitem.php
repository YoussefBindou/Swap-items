<?php
require_once "../sing/controllerUserData.php";

$email = $_SESSION['email'];
$password = $_SESSION['password'];

if ($email != false && $password != false) {
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if ($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        $id = $fetch_info['id'];
        if ($status == "verified") {
            if ($code != 0) {
                header('Location: ../sing/reset-code.php');
                exit();
            }
        } else {
            header('Location: ../sing/user-otp.php');
            exit();
        }
    }
} else {
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
    <title>My item</title>

    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/demo.css">
    <link rel="stylesheet" href="./style/style.css">
    <link rel="stylesheet" href="style/home.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css'>
</head>

<body>
    <?php
    $sql = "SELECT u.img as pro, u.name, t.* FROM item t JOIN usertable u ON u.id = t.id_user WHERE id_user = $id";
    $run_Sql2 = mysqli_query($con, $sql);
    $id_user = $_GET['id'];
    ?>

    <header>
        <?php
        include_once 'navbar.php';
        ?>
    </header>
    <main class="cd__main">
        <div class="container-fluid bg-trasparent my-4 p-3" style="position: relative">
            <div class="row row-cols-1 row-cols-xs-2 row-cols-sm-2 row-cols-lg-4 g-3">
                <?php
                while ($row = $run_Sql2->fetch_assoc()) {
                    $img = $row["img"];
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
                            <a href="item_info.php?id=<?php echo $id_item; ?>">
                                <?php echo "<img src='$img_name' class='card-img-top' alt='echo' /> "; ?>
                            </a>
                            <div class="card-body">
                                <h3 class="card-title"><?php echo $row["item_name"]; ?></h3>
                                <div>
                                    <div class="card-body">
                                        <p class="card-text"><?php echo $first_four_words . "..."; ?></p>
                                    </div>
                                    
                                </div>
                                <div class="d-grid gap-2 my-4">
                                    <?php
                                    echo "<a href='offre_item_msg.php?user_id=$id_user&item_id=$id_item' class='btn btn-warning bold-btn'>Offer this item</a>";
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </main>
</body>

</html>

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
<meta charset="UTF-8" />
<link rel="shortcut icon" href="../logo.webp" type="image/x-icon">
    <title>Home</title>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.css">
    <link rel="stylesheet" href="./av/style/navbar.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
 </style>
</head>
<body>
    <header>
        <div class="all">
            <?php require 'navbar.php'; ?>
        </div>
    </header>
    <div class="container mt-4">
    <div class="row">
        <div class="col-md-3">
            <a href="list_users.php">
                <div class="cardBox">
                    <div class="card">
                        <div class="cardContent">
                            <div class="countIcon">
                                <div class="numbers">
                                    <?php
                                    $userCountQuery = "SELECT COUNT(*) as count FROM usertable  ";
                                    $userCountResult = mysqli_query($con, $userCountQuery);
                                    $userCount = mysqli_fetch_assoc($userCountResult)['count'];
                                    echo $userCount;
                                    ?>
                                </div>
                                <div class="iconBx">
                                    <i class="fas fa-users"></i>
                                </div>
                            </div>
                            <div class="cardName">Users</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3">
            <a href="list_items.php">
                <div class="cardBox">
                    <div class="card">
                        <div class="cardContent">
                            <div class="countIcon">
                                <div class="numbers">
                                    <?php
                                    $itemCountQuery = "SELECT COUNT(*) as count FROM item";
                                    $itemCountResult = mysqli_query($con, $itemCountQuery);
                                    $itemCount = mysqli_fetch_assoc($itemCountResult)['count'];
                                    echo $itemCount;
                                    ?>
                                </div>
                                <div class="iconBx">
                                <i class="fas fa-cart-plus"></i>
                                </div>
                            </div>
                            <div class="cardName">items</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="list_categorys.php">
                <div class="cardBox">
                    <div class="card">
                        <div class="cardContent">
                            <div class="countIcon">
                                <div class="numbers">
                                    <?php
                                    $bureauCountQuery = "SELECT COUNT(*) as count FROM category";
                                    $bureauCountResult = mysqli_query($con, $bureauCountQuery);
                                    $bureauCount = mysqli_fetch_assoc($bureauCountResult)['count'];
                                    echo $bureauCount;
                                    ?>
                                </div>
                                <div class="iconBx">
                                <i class="fas fa-sitemap"></i>
                                </div>
                            </div>
                            <div class="cardName">categorys</div>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3">

                <div class="cardBox">
                    <div class="card">
                        <div class="cardContent">
                            <div class="countIcon">
                                <div class="numbers">
                                    <?php
                                    $supportCountQuery = "SELECT COUNT(*) as count FROM messages";
                                    $supportCountResult = mysqli_query($con, $supportCountQuery);
                                    $supportCount = mysqli_fetch_assoc($supportCountResult)['count'];
                                    echo $supportCount;
                                    ?>
                                </div>
                                <div class="iconBx">
                                    <i class="fa fa-comment"></i>
                                </div>
                            </div>
                            <div class="cardName">messages</div>
                        </div>
                    </div>
                </div>

        </div>
    </div>
</div>

    <div class="container mt-4">

            <div class="row">

                <div class="col-md-6">
                    <h2>Users</h2>
                    <table class="table mb-0">
                    <caption><a href="list_users.php" style="text-decoration: none;">List of Users</a></caption>

                        <thead>
                            <tr>
                            <th>id</th>
                                <th>Name</th>
                                <th>status</th>
                                <th>city</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                                $query = "SELECT * FROM usertable  WHERE name != 'admin' ORDER BY RAND() LIMIT 4";


                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                while ($user = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                    <tr>
                                    <td><?= $user['id']; ?></td>
                                    <td><?= $user['name']; ?></td>
                                    <td><?= $user['status_o_f']; ?></td>
                                    <td><?= $user['city']; ?></td>
                                        <td>
                                            <a href="view_user.php?id=<?= $user['id']; ?>" class="btn btn-info btn-sm">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <form action="code.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                                                <button type="submit" id="Confirm" name="delete_User" value="<?= $user['id']; ?>" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='3'>No Users Found</td></tr>";
                            }


                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <h2>items</h2>
                    <table class="table mb-0">
    <caption><a href="list_items.php" style="text-decoration: none;">List of Items</a></caption>
    <thead>
        <tr>
        <th>id</th>
            <th>Category</th>
            <th>Name</th>
            <th>Owner</th>
        </tr>
    </thead>
    <tbody>
    <?php
$query = "SELECT i.*, c.name AS category_name, u.name AS owner_name FROM item AS i JOIN usertable AS u ON u.id = i.id_user JOIN category AS c ON c.id_cat = i.category ORDER BY RAND() LIMIT 4";
$query_run = mysqli_query($con, $query);
if (mysqli_num_rows($query_run) > 0) {
    while ($item = mysqli_fetch_assoc($query_run)) {

        ?>
        <tr>
            <td><?= $item['item_id']; ?></td>
            <td><?= $item['category_name']; ?></td>
            <td><?= $item['item_name']; ?></td>
            <td><?= $item['owner_name']; ?></td>
            <td>
                <a href="view_item.php?id=<?= $item['item_id']; ?>" class="btn btn-info btn-sm">
                    <i class="fas fa-eye"></i>
                </a>

                <form action="code.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this item?');">
                    <button type="submit" id="Confirm" name="delete_item" value="<?= $item['item_id']; ?>" class="btn btn-danger btn-sm">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </td>
        </tr>
        <?php
    }
}
?>
    </tbody>
</table>
</div>
</div>

            <div class="row">

            <div class="col-md-6">

                    <h2>category</h2>
                    <table class="table mb-0">
                    <caption><a href="list_categorys.php" style="text-decoration: none;">List of category</a></caption>

                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>category Name</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM category ORDER BY RAND() LIMIT 4";
                            $query_run = mysqli_query($con, $query);

                            if (mysqli_num_rows($query_run) > 0) {
                                while ($category = mysqli_fetch_assoc($query_run)) {
                                    ?>
                                    <tr>
                                        <td><?= $category['id_cat']; ?></td>
                                        <td><?= $category['name']; ?></td>
                                        <td>
                                            <a href="view_category.php?id=<?= $category['id_cat']; ?>" class="btn btn-info btn-sm">
                                            <i class="fas fa-eye"></i>
                                        </a>

                                        <form action="code.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        <button type="submit" name="delete_category" value="<?= $category['id_cat']; ?>" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                         </form>

                                    </tr>
                            <?php
                                }
                            } else {
                                echo "<tr><td colspan='3'>No categorys Found</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
        </div>
    </div>
    <div>
</body>
<script>

    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</html>
<style>
<style>
    .cardContent {
        color: #333;
        display: flex;
        align-items: center;
    }

    .countIcon {
        display: flex;
        align-items: center;
    }

    .numbers {
        margin-right: 10px;
    }

    .iconBx {
        color: #333;
        margin-right: 10px;
    }

    .cardName {
        cursor: pointer;
    }




.cardBox {
    margin-bottom: 20px;
}

.card {
    color: #333;
    background-color: #ffffff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    display: flex;
    justify-content: space-between;
    align-items: center;
    transition: background-color 0.3s ease;
}

.card:hover {
    background-color: #f5f5f5;
}

.numbers {
    font-size: 32px;
    font-weight: bold;
    color: #000;
}

.cardName {

    font-size: 18px;
    font-weight: bold;
    color: #333333;
}

.iconBx {
    color: #333;
    font-size: 40px;
    color: #4e73df;
}

a:link {
      text-decoration: none;
}
.iconBx i {
        color: #333;
        margin-right: 10px;
    }






</style>

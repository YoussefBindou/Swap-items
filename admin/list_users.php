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
    <meta charset="UTF-8" />
    <title>User List</title><link rel="shortcut icon" href="../user/img/logo.png" type="image/x-icon">
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
    <!-- Include jQuery library -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">

    <!-- Include DataTables JavaScript -->
    <script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable();
        });
    </script>
</head>

<body>
    <header>
        <div class="all">
            <?php require 'navbar.php'; ?>
        </div>
    </header>

    <center>
        <div class="col-md-6">
            <h2>Users</h2>
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>City</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT * FROM usertable WHERE name != 'admin'";
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
                                    <a href="view_user.php?id=<?= $user['id']; ?>" class="btn btn-info btn-sm view-user" data-toggle="modal" data-target="#viewUserModal" data-id="<?= $user['id']; ?>">
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
    </div>

    <!-- View User Modal -->
    <div class="modal fade" id="viewUserModal" tabindex="-1" role="dialog" aria-labelledby="viewUserModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewUserModalLabel">User Information</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="user-info"></div>
                </div>
            </div>
        </div>
    </div>
    </center>
    <script>
        $(document).ready(function() {
            $('.view-user').click(function() {
                var userId = $(this).data('id');
                $.ajax({
                    url: 'get_user_info.php',
                    type: 'POST',
                    data: {
                        id: userId
                    },
                    success: function(response) {
                        $('#user-info').html(response);
                    }
                });
            });
        });
    </script>
</body>

</html>

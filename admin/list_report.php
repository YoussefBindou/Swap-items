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
    <title>report List</title>
    
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
    <!-- Include jQuery library --><link rel="shortcut icon" href="../user/img/logo.png" type="image/x-icon">

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
            <h2>reports</h2>
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>id</th>
                        <th>item name </th>
                        <th>user reporter </th>
                   
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT r.id,i.item_name,u.name FROM report r join item i on i.item_id=r.id_item join usertable u on u.id = r.id_user";
                    $query_run = mysqli_query($con, $query);

                    if (mysqli_num_rows($query_run) > 0) {
                        while ($report = mysqli_fetch_assoc($query_run)) {
                            ?>
                            <tr>
                                <td><?= $report['id']; ?></td>
                                <td><?= $report['item_name']; ?></td>
                                <td><?= $report['name']; ?></td>
                                
                                <td>
                                    <a href="view_report.php?id=<?= $report['id']; ?>" class="btn btn-info btn-sm view-report" data-toggle="modal" data-target="#viewreportModal" data-id="<?= $report['id']; ?>">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="code.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this report?');">
    <button type="submit" id="Confirm" name="delete_report" value="<?= $report['id']; ?>" class="btn btn-danger btn-sm">
        <i class="fas fa-trash"></i>
    </button>
</form>

                                </td>
                            </tr>
                    <?php
                        }
                    } else {
                        echo "<tr><td colspan='3'>No reports Found</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    </center>
    <script>
        $(document).ready(function() {
            $('.view-report').click(function() {
                var reportId = $(this).data('id');
                $.ajax({
                    url: 'get_report_info.php',
                    type: 'POST',
                    data: {
                        id: reportId
                    },
                    success: function(response) {
                        $('#report-info').html(response);
                    }
                });
            });
        });
    </script>
</body>

</html>

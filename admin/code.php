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

// Initialize the alert message variable
$alertMessage = '';

// ...

// Check if the delete user form is submitted
if (isset($_POST['delete_User'])) {
    $userId = $_POST['delete_User'];

    // Perform the deletion query
    $deleteUserQuery = "DELETE FROM usertable WHERE id = '$userId'";
    $deleteUserResult = mysqli_query($con, $deleteUserQuery);

    if ($deleteUserResult) {
        // Deletion successful
        echo "<script>alert('delete_item deleted successfully.'); window.history.back();</script>";
    } else {
        // Deletion failed
        echo "<script>alert('Error deleting delete_item: " . mysqli_error($con) . "'); window.history.back();</script>";
    }
}

// Check if the delete item form is submitted
if (isset($_POST['delete_item'])) {
    $itemId = $_POST['delete_item'];

    // Perform the deletion query
    $deleteItemQuery = "DELETE FROM item WHERE item_id = '$itemId'";
    $deleteItemResult = mysqli_query($con, $deleteItemQuery);

    if ($deleteItemResult) {
        // Deletion successful
        echo "<script>alert('delete_item deleted successfully.'); window.history.back();</script>";
    } else {
        // Deletion failed
        echo "<script>alert('Error deleting delete_item: " . mysqli_error($con) . "'); window.history.back();</script>";
    }
}

// Check if the delete category form is submitted
if (isset($_POST['delete_category'])) {
    $categoryId = $_POST['delete_category'];

    // Perform the deletion query
    $deleteCategoryQuery = "DELETE FROM category WHERE id_cat = '$categoryId'";
    $deleteCategoryResult = mysqli_query($con, $deleteCategoryQuery);

    if ($deleteCategoryResult) {
        // Deletion successful
        echo "<script>alert('delete_category deleted successfully.'); window.history.back();</script>";
    } else {
        // Deletion failed
        echo "<script>alert('Error deleting delete_category: " . mysqli_error($con) . "'); window.history.back();</script>";
    }
}

// ...

// Check if there is an alert message to display

if (isset($_POST['delete_report'])) {
    $reportId = $_POST['delete_report'];

    // Delete the report from the database
    $query = "DELETE FROM report WHERE id = '$reportId'";
    if (mysqli_query($con, $query)) {
        // Report deleted successfully
        echo "<script>alert('Report deleted successfully.'); window.history.back();</script>";
    } else {
        // Failed to delete the report
        echo "<script>alert('Error deleting report: " . mysqli_error($con) . "'); window.history.back();</script>";
    }

    // Close the database connection

}
?>



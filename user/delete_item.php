<?php
require_once "../sing/controllerUserData.php";

$id_item = $_GET['id'];

// Perform the deletion logic here, for example:
$sql = "DELETE FROM item WHERE item_id = $id_item";
$result = mysqli_query($con, $sql);

if ($result) {
    // Deletion successful, redirect to the desired page
    header("Location: myitems.php");
    exit();
} else {
    // Deletion failed, handle the error
    echo "Failed to delete item. Please try again.";
}
?>

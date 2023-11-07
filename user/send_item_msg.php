<?php
require_once "../sing/controllerUserData.php";
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$outgoing_id = $_SESSION['unique_id'];

if ($email != false && $password != false) {
    $sql = "SELECT * FROM usertable WHERE email LIKE '$email'";
    $run_Sql = mysqli_query($con, $sql);

    if ($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        $outgoing_id = $fetch_info['unique_id'];
        if ($status == "verified") {
            if ($code != 0) {
                header('Location: ../../sing/reset-code.php');
                exit(); // Make sure to exit after redirection
            }
        } else {
            header('Location: ../../sing/user-otp.php');
            exit(); // Make sure to exit after redirection
        }
    }
} else {
    header('Location: ../../user_no/home.php');
    exit(); // Make sure to exit after redirection
}

$id_item = $_GET['item_id'];
$result = mysqli_query($con, "SELECT * FROM item WHERE item_id = ".$id_item);
if ($row = $result->fetch_assoc()) {
    $imagePathsString = $row['img'];
    $imagePaths = explode(',', $imagePathsString); // Split the string into an array using the comma delimiter
    $incoming_id = $_GET['user_id'];

    $image = "<img src='../../SWAP-ITEMS/user/".$imagePaths[0]."' width='70'>"; // Set maximum width for the image
    $message = "<a href='../user/item_info.php?id=".$id_item."'>".$image."</a>"; // Wrap the image tag with an anchor tag

    $message .= "is This item available?";

    if (!empty($message)) {
        $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
                VALUES ($incoming_id, $outgoing_id, '".mysqli_real_escape_string($con, $message)."')";
        $result = mysqli_query($con, $sql);
        header("Location: item_info.php?id=".$id_item);
        exit(); // Make sure to exit after redirection
    }
}
?>

<?php
require_once "../../sing/controllerUserData.php";
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
        $outgoing_id=$fetch_info['unique_id'];
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

session_start();

//$outgoing_id = $_SESSION['unique_id'];
$incoming_id = $_SESSION['id_res'];
$message = $_POST['message'];

if(!empty($message)){
    $sql = "INSERT INTO messages (incoming_msg_id, outgoing_msg_id, msg)
            VALUES ($incoming_id, $outgoing_id, '$message')";
    $result = mysqli_query($con, $sql);

}
?>

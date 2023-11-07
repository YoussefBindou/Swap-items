<?php
require_once "../../sing/controllerUserData.php";

$email = $_SESSION['email'];
$password = $_SESSION['password'];
$outgoing_id = $_SESSION['unique_id'];

if ($email != false && $password != false) {
    $sql = "SELECT * FROM usertable WHERE email like '$email'";
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

if (isset($fetch_info['unique_id'])) {
    $incoming_id = $_SESSION['id_res'];
    $output = "";
    $sql = "SELECT * FROM messages LEFT JOIN usertable ut ON ut.unique_id = messages.outgoing_msg_id
            WHERE (outgoing_msg_id = {$outgoing_id} AND incoming_msg_id = {$incoming_id})
            OR (outgoing_msg_id = {$incoming_id} AND incoming_msg_id = {$outgoing_id}) ORDER BY msg_id";
    $query = mysqli_query($con, $sql);
    if (mysqli_num_rows($query) > 0) {
        while ($row = mysqli_fetch_assoc($query)) {
            if ($row['outgoing_msg_id'] === $outgoing_id) {
                $output .= '<div class="chat outgoing">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                            </div>';
            } else {
                $output .= '<div class="chat incoming">
                                <img src="../user/'.$row['img'].'" alt="">
                                <div class="details">
                                    <p>'. $row['msg'] .'</p>
                                </div>
                            </div>';
            }
        }
    } else {
        $output .= '<div class="text">No messages are available. Once you send a message, they will appear here.</div>';
    }
    echo $output;
} else {
    // Handle the case when the unique_id is not set
}
?>

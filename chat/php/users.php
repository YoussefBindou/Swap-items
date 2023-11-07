<?php require_once "../../sing/controllerUserData.php"; ?>
<?php 
$email = $_SESSION['email'];
$password = $_SESSION['password'];
$outgoing_id = $_SESSION['unique_id'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email like '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        $outgoing_id = $fetch_info['unique_id'];
        if($status == "verified"){
            if($code != 0){
                header('Location: ../../sing/reset-code.php');
            }
        }else{
            header('Location: ../../sing/user-otp.php');
        }
    }
}else{
    header('Location: ../../user_no/home.php');
}


    
    $sql = "SELECT * FROM usertable WHERE NOT unique_id = {$outgoing_id} ORDER BY id DESC";
    $query = mysqli_query($con, $sql);
    $output = "";
    if(mysqli_num_rows($query) == 0){
        $output .= "No users are available to chat";
    }elseif(mysqli_num_rows($query) > 0){
        include_once "data.php";
    }
    echo $output;
?>
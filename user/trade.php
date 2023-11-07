<?php require_once "../sing/controllerUserData.php"; ?>
<?php 

$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email like '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if($status == "verified"){
            if($code != 0){
                header('Location: ../sing/reset-code.php');
            }
        }else{
            header('Location: ../sing/user-otp.php');
        }
    }
}else{
    header('Location: ../user_no/home.php');
}


// Check if an offer already exists for the user for this product
$check_stmt = $con->prepare("SELECT * FROM trade WHERE user_id_offerer = ? AND item_id = ?");
$check_stmt->bind_param("ii", $id, $id_product);
$check_stmt->execute();
$check_result = $check_stmt->get_result();

if ($check_result->num_rows > 0) {
    // An offer already exists for the user for this product
    echo 'offer_exists';
} else {
    // No existing offer for the user for this product, so insert a new one
    $insert_stmt = $con->prepare("INSERT INTO trade (user_id_offerer, item_id) VALUES (?, ?)");
    $insert_stmt->bind_param("ii", $id, $id_product);

    if ($insert_stmt->execute()) {
        echo 'success';
    } else {
        echo 'failure';
    }
}
<?php
require_once "../sing/controllerUserData.php";

$email = $_SESSION['email'];
$password = $_SESSION['password'];

// Check if the "Save Profile" button was clicked
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['saveProfile'])) {
    session_commit();
    $Postcode = $_POST["Postcode"];
    $Address = $_POST["Address"];
    $Mobile_Number = $_POST["Mobile_Number"];
    $nom = $_POST["nom"];
    $city = $_POST["city"];

    // Check if a file was uploaded
    if (isset($_FILES["img"]) && $_FILES["img"]["error"] === UPLOAD_ERR_OK) {
        $file_name = $_FILES['img']['name'];
        $targetDir = "test/";
        $targetFile = $targetDir . basename($file_name);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        if (move_uploaded_file($_FILES["img"]["tmp_name"], $targetFile)) {
            // File uploaded successfully, update the img field in the database
            $img = "test/" . $file_name;
        } else {
            // Handle file upload error
            echo "<script>alert('Failed to upload image')</script>";
            exit; // Exit the script or handle the error as needed
        }
    }

    // Update the database with all the information
    $sql = "UPDATE usertable SET
            email = '$email',
            name = '$nom',
            phone = '$Mobile_Number',
            address = '$Address',
            postcode = '$Postcode',
            city = '$city'";

    // Include the img field in the query if it was uploaded
    if (isset($img)) {
        $sql .= ", img = '$img'";
    }

    $sql .= " WHERE email = '$email'";

    if ($con->query($sql) === TRUE) {
        echo "<script>alert('Your profile has been updated successfully')</script>";
    } else {
        // Handle database update error
        echo "<script>alert('Failed to update profile')</script>";
    }
}

// Check if the "Change Password" button was clicked
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['changePassword'])) {
    $oldPassword = $_POST['oldPassword'];
    $newPassword = $_POST['newPassword'];
    $confirmPassword = $_POST['confirmPassword'];

    // Validate the form inputs
    if ($newPassword !== $confirmPassword) {
        echo "<script>alert('New passwords do not match')</script>";
    } else {
        // Fetch the current password from the database
        $fetchPasswordSql = "SELECT password FROM usertable WHERE email = '$email'";
        $result = $con->query($fetchPasswordSql);
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $currentPassword = $row['password'];

            // Verify the old password
            if (password_verify($oldPassword, $currentPassword)) {
                // Update the password in the database
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $updatePasswordSql = "UPDATE usertable SET password = '$hashedPassword' WHERE email = '$email'";
                if ($con->query($updatePasswordSql) === TRUE) {
                    echo "<script>alert('Password updated successfully')</script>";
                } else {
                    echo "<script>alert('Failed to update password')</script>";
                }
            } else {
                echo "<script>alert('Old password is incorrect')</script>";
            }
        } else {
            echo "<script>alert('Failed to fetch current password')</script>";
        }
    }
}

// Redirect user based on authentication and verification status
if ($email != false && $password != false) {
    $sql1 = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql1);
    if ($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        if ($status == "verified") {
            if ($code != 0) {
                header('Location: ../sing/reset-code.php');
                exit; // Add exit to prevent further execution of the script
            }
        } else {
            header('Location: ../sing/user-otp.php');
            exit; // Add exit to prevent further execution of the script
        }
    }
} else {
    header('Location: ../sing/login-user.php');
    exit; // Add exit to prevent further execution of the script
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
<link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/css/bootstrap.min.css'>
    <style>
    body {
        background: rgb(99, 39, 120)
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #BA68C8
    }

    .profile-button {
        background: rgb(99, 39, 120);
        box-shadow: none;
        border: none
    }

    .profile-button:hover {
        background: #682773
    }

    .profile-button:focus {
        background: #682773;
        box-shadow: none
    }

    .profile-button:active {
        background: #682773;
        box-shadow: none
    }

    .back:hover {
        color: #682773;
        cursor: pointer
    }

    .labels {
        font-size: 11px
    }

    .add-experience:hover {
        background: #BA68C8;
        color: #fff;
        cursor: pointer;
        border: solid 1px #BA68C8
    }

    .center {
      height: 100%;
      display: flex;
      align-items: center;
      justify-content: center;
    }
    .form-input {
      width: 250px;
      padding: 20px;
      background: #fff;
    }
    .form-input input {
      display: none;
    }
    .form-input label {
      display: block;
      width: 100%;
      height: 50px;
      line-height: 50px;
      text-align: center;
      background: #333;
      color: #fff;
      font-size: 15px;
      font-family: "Open Sans", sans-serif;
      text-transform: Uppercase;
      font-weight: 600;
      border-radius: 10px;
      cursor: pointer;
    }

    .form-input img {
      width: 100%;
      display: none;
      margin-top: 10px;
    }
    </style>
</head>

<body>
    <header>
        <?php include_once 'navbar.php'; ?>
    </header>

    <form method="post" enctype="multipart/form-data">
        <div class="container rounded bg-white mt-5 mb-5">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img name="img" id="file-ip-1-preview" class="rounded-circle mt-5" width="150px"
                            src="<?php echo $fetch_info['img'] ?>">
                        <div class="center">
                            <div class="form-input">
                                <div class="preview">
                                    <img id="file-ip-1-preview">
                                </div>
                                <label for="file-ip-1">Upload Image</label>
                                <input name="img" type="file" id="file-ip-1" accept="image/*"
                                    onchange="showPreview(event);">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5 border-right">
                    <div class="p-3 py-5">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="text-right">Profile Settings</h4>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Name</label>
                                <input type="text" name="nom" class="form-control" placeholder="Name"
                                    value="<?php echo $fetch_info['name'] ?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <label class="labels">Mobile Number</label>
                                <input type="text" name="Mobile_Number" class="form-control"
                                    placeholder="Enter phone number" value="<?php echo $fetch_info['phone'] ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Address</label>
                                <input type="text" name="Address" class="form-control"
                                    placeholder="Enter address line 1"
                                    value="<?php echo $fetch_info['address'] ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">Postcode</label>
                                <input type="text" name="Postcode" class="form-control"
                                    placeholder="Enter postcode"
                                    value="<?php echo $fetch_info['postcode'] ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="labels">City</label>
                                <select name="city" class="select form-control" style="width: 65%;" required>
                                <option value="<?php echo $fetch_info['city'] ?>" selected><?php echo $fetch_info['city'] ?></option>
                                <option value="Agadir">Agadir</option>
                                <option value="Al Hoceima">Al Hoceima</option>
                                <option value="Azemmour">Azemmour</option>
                                <option value="Beni Mellal">Beni Mellal</option>
                                <option value="Casablanca">Casablanca</option>
                                <option value="Chefchaouen">Chefchaouen</option>
                                <option value="Dakhla">Dakhla</option>
                                <option value="El Jadida">El Jadida</option>
                                <option value="Essaouira">Essaouira</option>
                                <option value="Fes">Fes</option>
                                <option value="Kenitra">Kenitra</option>
                                <option value="Khnadak">Khnadak</option>
                                <option value="Laayoune">Laayoune</option>
                                <option value="Marrakech">Marrakech</option>
                                <option value="Meknes">Meknes</option>
                                <option value="Nador">Nador</option>
                                <option value="Ouarzazate">Ouarzazate</option>
                                <option value="Oujda">Oujda</option>
                                <option value="Rabat">Rabat</option>
                                <option value="Safi">Safi</option>
                                <option value="Sale">Sale</option>
                                <option value="Tangier">Tangier</option>
                                <option value="Temsia">Temsia</option>
                                <option value="Tetouan">Tetouan</option>
                                <option value="Tiznit">Tiznit</option>
                                <option value="Zagora">Zagora</option>
                            </select>

                            </div>
                            <div class="col-md-12">
                                <label class="labels">Email ID</label>
                                <input type="text" name="email" class="form-control" placeholder="Enter email ID" value="<?php echo $fetch_info['email'] ?>" readonly>
                            </div>

                            <div class="mt-5 text-center">
                                <input class="btn btn-primary profile-button" type="submit" name="saveProfile" value="Save Profile" onclick="location.reload()">
                                <button class="btn btn-primary profile-button" type="button" data-bs-toggle="modal" data-bs-target="#changePasswordModal">Change Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function showPreview(event) {
            if (event.target.files.length > 0) {
                var src = URL.createObjectURL(event.target.files[0]);
                var preview = document.getElementById("file-ip-1-preview");
                preview.src = src;
                preview.style.display = "block";
            }
        }
    </script>
    <!-- Change Password Modal -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="changePasswordModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="changePasswordForm" method="post">
                        <div class="mb-3">
                            <label for="oldPassword" class="form-label">Old Password</label>
                            <input type="password" class="form-control" id="oldPassword" name="oldPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="newPassword" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                        </div>
                        <button type="submit" class="btn btn-primary" name="changePassword">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js'></script>
</body>

</html>
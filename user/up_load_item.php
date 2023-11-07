<?php require_once "../sing/controllerUserData.php"; ?>
<?php
$email = $_SESSION['email'];
$password = $_SESSION['password'];
if($email != false && $password != false){
    $sql = "SELECT * FROM usertable WHERE email = '$email'";
    $run_Sql = mysqli_query($con, $sql);
    if($run_Sql){
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];
        $id= $fetch_info['id'];
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
?>

<?php
if(isset($_POST["submit"])){
    $itemname = $_POST["itemname"];
    $itemdesc = $_POST["itemdesc"];
    $itemcondition = $_POST["itemcondition"];
    $item_cati = $_POST["item_cati"];

    $imagePaths = array(); // Array to store image paths

    // Loop through each uploaded file
    for ($i = 0; $i < 4; $i++) {
        $targetDir = "test/";
        $targetFile = $targetDir . uniqid() . "_" . basename($_FILES["itemimg"]["name"][$i]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $msg = "";

        // Check if file already exists
        if (file_exists($targetFile)) {
            $msg = "Sorry, file already exists.";
            echo "<script>alert('$msg')</script>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $msg = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            echo "<script>alert('$msg')</script>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            $msg = "Sorry, your file was not uploaded.";
            echo "<script>alert('$msg')</script>";
        } else {
            // If everything is ok, try to upload file
            if (move_uploaded_file($_FILES["itemimg"]["tmp_name"][$i], $targetFile)) {
                $msg = "The file ". basename($_FILES["itemimg"]["name"][$i]). " has been uploaded.";
                $imagePaths[] = $targetFile; // Store the image path in the array

                if ($i == 3) {
                    // Insert the item data into the database
                    $imagePathsStr = implode(",", $imagePaths); // Convert image paths array to a string
                    $sql = "INSERT INTO item (item_name, descrition, coondition, img, id_user,category) VALUES ('$itemname', '$itemdesc', '$itemcondition', '$imagePathsStr', $id,$item_cati)";
                    if ($con->query($sql) === TRUE) {
                        $msg = "Your product has been uploaded successfully.";
                        echo "<script>alert('$msg')</script>";
                    } else {
                        $msg = "Error uploading your product. Please try again.";
                        echo "<script>alert('$msg')</script>";
                    }
                }
            } else {
                $msg = "Sorry, there was an error uploading your file.";
                echo "<script>alert('$msg')</script>";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload</title>
    <link rel="stylesheet" href="style/upload.css">
</head>
<body>
    <header>
    <?php
        include_once 'navbar.php';
    ?>
    </header>
    <section id="upload">
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="itemname" id="itemname" placeholder="Item Name" required>
            <select  name="itemcondition"class="form-select" required>
            <option value="Unused">Unused</option>
            <option value="Used">Used</option>
            </select><br>
            <input type="text" name="itemdesc" id="itemdesc" placeholder="Item Description" required>
            <select  name="item_cati"class="form-select" required>
            <?php
                $req = "select id_cat, name from category";
                $rs = mysqli_query($con, $req);
                while ($row = mysqli_fetch_row($rs)) {
                ?>
                    <option value="<?php echo $row[0] ?>" selected><?php echo $row[1] ?></option>
                <?php
                }
            ?>
                </select><br>
            <input type="file" name="itemimg[]" id="itemimg" required hidden multiple accept="image/*">
            <button id="image" onclick="upload();">Choose 4 images</button>
            <input type="submit" value="Submit" name="submit">
        </form>
    </section>
    <script>
        var itemname = document.getElementById("itemname");
        var itemdesc = document.getElementById("itemdesc");
        var itemcondition = document.getElementById("itemcondition");
        var image = document.getElementById("image");
        var itemimg = document.getElementById("itemimg");

        function upload(){
            itemimg.click();
        }

        itemimg.addEventListener("change", function(){
            var files = this.files;
            var fileCount = files.length;
            var filenames = "";

            if (fileCount > 0) {
                filenames = "You can change (" + files[0].name + ")";
                if (fileCount > 1) {
                    filenames += " and " + (fileCount - 1) + " more image(s)";
                }
            }

            image.innerHTML = filenames;
        });
    </script>
</body>
</html>

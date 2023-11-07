<?php
require_once "../sing/controllerUserData.php";

?>

<?php
if (!isset($_SESSION['email']) || empty($_SESSION['email'])) {
    header('Location: ../user_no/home.php');
    exit();
}

$email = $_SESSION['email'];

$sql = "SELECT * FROM usertable WHERE email = '$email'";
$run_Sql = mysqli_query($con, $sql);
if (!$run_Sql || mysqli_num_rows($run_Sql) < 1) {
    header('Location: ../user_no/home.php');
    exit();
}

$fetch_info = mysqli_fetch_assoc($run_Sql);
$status = $fetch_info['status'];
$code = $fetch_info['code'];
$id = $fetch_info['id'];

if ($status != "verified" || $code != 0) {
    header('Location: ../user_no/home.php');
    exit();
}
?>

<?php
$itemId = $_GET['id'];

$sql = "SELECT * FROM item WHERE item_id = $itemId";
$run_Sql = mysqli_query($con, $sql);
if (!$run_Sql || mysqli_num_rows($run_Sql) < 1) {
    header('Location: ../user_no/home.php');
    exit();
}

$itemInfo = mysqli_fetch_assoc($run_Sql);
$itemname = $itemInfo['item_name'];
$itemdesc = $itemInfo['descrition'];
$itemcondition = $itemInfo['coondition'];
$item_cati = $itemInfo['category'];
$imagePaths = explode(',', $itemInfo['img']);
?>

<?php
if (isset($_POST["submit"])) {
    $newItemname = $_POST["itemname"];
    $newItemdesc = $_POST["itemdesc"];
    $newItemcondition = $_POST["itemcondition"];
    $newItem_cati = $_POST["item_cati"];

    $sql = "UPDATE item SET item_name = '$newItemname', descrition = '$newItemdesc', coondition = '$newItemcondition', category = '$newItem_cati' WHERE item_id = $itemId";
    if (mysqli_query($con, $sql)) {
        $msg = "updating item information.";
        echo "<script>alert('$msg')</script>";
    } else {
        $msg = "Error updating item information. Please try again.";
        echo "<script>alert('$msg')</script>";
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
    <title>Update Item</title>
    <link rel="stylesheet" href="style/upload.css">
</head>
<body>
    <header>
        <?php include_once 'navbar.php'; ?>
    </header>
    <section id="upload">
        <form method="post" enctype="multipart/form-data">
            <input type="text" name="itemname" id="itemname" placeholder="Item Name" required value="<?php echo $itemname; ?>">
            <select name="itemcondition" class="form-select" required>
                <option value="Unused" <?php if ($itemcondition == "Unused") echo "selected"; ?>>Unused</option>
                <option value="Used" <?php if ($itemcondition == "Used") echo "selected"; ?>>Used</option>
            </select><br>
            <input type="text" name="itemdesc" id="itemdesc" placeholder="Item Description" required value="<?php echo $itemdesc; ?>">
            <select name="item_cati" class="form-select" required>
                <?php
                $req = "SELECT id_cat, name FROM category";
                $rs = mysqli_query($con, $req);
                while ($row = mysqli_fetch_row($rs)) {
                    $selected = ($item_cati == $row[0]) ? "selected" : "";
                    echo "<option value='$row[0]' $selected>$row[1]</option>";
                }
                ?>
            </select><br>
            <div class="image-container">
                <?php
                foreach ($imagePaths as $imagePath) {
                    echo "<img src='$imagePath' width='180px' style='margin-right:13px;' alt='Item Image'>";
                }
                ?>
            </div>
         
            <input type="submit" value="Submit" name="submit">
        </form>
    </section>
    <script>
        var itemname = document.getElementById("itemname");
        var itemdesc = document.getElementById("itemdesc");
        var itemcondition = document.getElementById("itemcondition");
        var image = document.getElementById("image");
        var itemimg = document.getElementById("itemimg");

        function upload() {
            itemimg.click();
        }

        itemimg.addEventListener("change", function () {
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

<style>
    .img{
    max-width: 100%;
    width: 156px;
    height: auto;
    margin: 0 16px;
    }
    .image-container{
         /* justify-content: center; */
    display: flex;
    align-items: center;
    justify-content: center;
    }
    </style>
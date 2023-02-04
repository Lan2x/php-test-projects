<!DOCTYPE html>
<html>

<body>

    <form method="post" enctype="multipart/form-data">
        Select image to upload:
        <input type="file" name="fileToUpload" id="fileToUpload">
        <input type="submit" value="Upload Image" name="submit">
    </form>




    <form method="post">
        <input type="submit" value="Retrieve All Image" name="retrieve">
    </form>

    <div class='img-container'>
        <?php
        if (isset($_POST['retrieve'])) {
            $dir_name = "uploads/";
            $images = glob($dir_name . "*.jpg");
            foreach ($images as $image) {
                echo '<img src="' . $image . '" /><br />';
            }
        }
        ?>
    </div>

</body>

<style>
    img {
        width: 300px;
        height: 250px;
        padding: 20px;
    }

    .img-container {
        display: flex;
        flex-wrap: wrap;
    }
</style>

</html>


<?php

// Check if image file is a actual image or fake image
if (isset($_POST["submit"])) {
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.')</script>";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            echo "<script>alert('The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.')</script>";
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
        }
    }
}


?>
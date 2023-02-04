<!DOCTYPE html>
<html>

<head>
    <title>Compress Image</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container" style="margin-top:20px;">
        <div class="panel panel-primary">
            <div class="panel-heading text-center"><strong>Image Upload and Compress using PHP</strong></div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-8">
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label><b>Select Image File:</b></label>
                                <input type="file" class="form-control-file border" name="image">
                            </div>
                    </div>
                    <input type="submit" class="btn btn-primary" name="submit" value="Compress Image">
                    </form>
                </div>
                <div id="result1">

                </div>
                <div id="result2">

                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php

/* 
 * Custom function to compress image size and 
 * upload to the server using PHP 
 */
function compressImage($source, $destination, $quality)
{
    // Get image info 
    $imgInfo = getimagesize($source);
    $mime = $imgInfo['mime'];

    // Create a new image from file 
    switch ($mime) {
        case 'image/jpeg':
            $image = imagecreatefromjpeg($source);
            break;
        case 'image/png':
            $image = imagecreatefrompng($source);
            break;
        case 'image/gif':
            $image = imagecreatefromgif($source);
            break;
        default:
            $image = imagecreatefromjpeg($source);
    }

    // Save image 
    imagejpeg($image, $destination, $quality);

    // Return compressed image 
    return $destination;
}


function moveOriginalFile()
{
    $target_dir = "originals/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }

    if ($uploadOk == 0) {
        echo "<script>alert('Sorry, your file was not uploaded.')</script>";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            echo "<script>alert('The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been compressed.')</script>";
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
        }
    }
}


// File upload path 
$uploadPath = "compressed/";

// If file upload form is submitted 
$status = $statusMsg = '';
if (isset($_POST["submit"])) {
    $status = 'error';
    if (!empty($_FILES["image"]["name"])) {
        // File info 
        $fileName = basename($_FILES["image"]["name"]);
        $imageUploadPath = $uploadPath . $fileName;
        $fileType = pathinfo($imageUploadPath, PATHINFO_EXTENSION);

        // Allow certain file formats 
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes)) {
            // Image temp source 
            $imageTemp = $_FILES["image"]["tmp_name"];
            $imageSize = $_FILES["image"]["size"];

            // Compress size and upload image 
            $compressedImage = compressImage($imageTemp, $imageUploadPath, 40);

            if ($compressedImage) {
                $compressedImageSize = filesize($compressedImage);

                echo '<script> document.getElementById("result1").innerText += "original image size: ' . $imageSize . ' bytes"</script>';
                echo '<br>';
                echo '<script> document.getElementById("result2").innerText += "compressed image size: ' . $compressedImageSize . ' bytes" </script>';


                moveOriginalFile();
                $status = 'success';
                // $statusMsg = "Image compressed successfully."; 
            } else {
                $statusMsg = "Image compress failed!";
            }
        } else {
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.';
        }
    } else {
        $statusMsg = 'Please select an image file to upload.';
    }
}

// Display status message 
echo $statusMsg;

?>
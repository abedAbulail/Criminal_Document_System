<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .det{
            margin-left:120px;
        }
    </style>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
<form action="test.php" method="post" enctype="multipart/form-data">
    <div class="row">
        <input type="file" name="image" required>
        <input type="submit" name="submit" value="Upload">
    </div>
</form>

<?php
$targetFile = "";
$uploadOk = 1; // Initialize $uploadOk to 1

// Check image using getimagesize function and get size
if (isset($_FILES["image"])) {
    // directory name to store the uploaded image files
    // this should have sufficient read/write/execute permissions
    // if not already exists, please create it in the root of the
    // project folder
    $targetDir = "uploads/";
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}



// Check if the file already exists in the same path
if (file_exists($targetFile)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

// Check file size and throw an error if it is greater than
// the predefined value, here it is 500000
if ($_FILES["image"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Check for uploaded file formats and allow only 
// jpg, png, jpeg, and gif
// If you want to allow more formats, declare it here
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
?>

<?php
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
        echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

?>
<div class="det">


<h1>Display uploaded Image:</h1>
<?php if (isset($_FILES["image"]) && $uploadOk == 1) : ?>
    <img src="<?php echo $targetFile; ?>" alt="Uploaded Image" width="200">
<?php endif; ?>
<br>
<p>asdasdasdasdasdasdasd</p>
</div>
</body>
</html>

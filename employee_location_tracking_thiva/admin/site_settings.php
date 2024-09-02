<?php
include('../db_connect.php');
include('admin_header.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['logo'])) {
    $target_dir = "uploads/"; // Corrected path
    $target_file = $target_dir . basename($_FILES["logo"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["logo"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size
    if ($_FILES["logo"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
            // Insert or update the logo path in the database
            $stmt = $conn->prepare("INSERT INTO site_settings (logo_path) VALUES (?) ON DUPLICATE KEY UPDATE logo_path=?");
            $stmt->bind_param("ss", $target_file, $target_file);
            $stmt->execute();
            
            if($stmt->affected_rows > 0){
                echo "The file ". htmlspecialchars(basename($_FILES["logo"]["name"])). " has been uploaded.";
            } else {
                echo "Failed to update the logo path in the database.";
            }
            $stmt->close();
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
    $conn->close(); // Close the database connection
}
?>

<html>
<head>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
<div class="container">
    <h2>Upload Logo</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="logo">Select logo to upload:</label>
        <input type="file" name="logo" id="logo" required><br><br>
        <button type="submit">Upload Logo</button>
        <button type="reset">Reset Logo</button>
    </form>
</div>
</body>
</html>

<?php include('admin_footer.php'); ?>
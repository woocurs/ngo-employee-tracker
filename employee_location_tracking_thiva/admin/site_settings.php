<?php
include('../db_connect.php');
include('admin_header.php');


// Initialize default values for footer in case no data is returned
$footer = [
    'name' => 'NGO Employee Location Tracking System',
    'facebook_link' => '#',
    'twitter_link' => '#',
    'linkedin_link' => '#',
];

// Fetch current footer settings from the database
$query = "SELECT * FROM site_settings WHERE id = 1";
$result = $conn->query($query);

// If query returns data, overwrite the default footer values
if ($result && $result->num_rows > 0) {
    $footer = $result->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle logo upload
    if (isset($_FILES['logo']) && $_FILES['logo']['size'] > 0) {
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
                $stmt = $conn->prepare("INSERT INTO site_settings (id, logo_path) VALUES (1, ?) ON DUPLICATE KEY UPDATE logo_path=?");
                $stmt->bind_param("ss", $target_file, $target_file);
                $stmt->execute();
                
                if ($stmt->affected_rows > 0) {
                    echo "The logo " . htmlspecialchars(basename($_FILES["logo"]["name"])) . " has been uploaded.";
                } else {
                    echo "Failed to update the logo path in the database.";
                }
                $stmt->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    }

    // Handle footer settings update
    $name = $_POST['name'];
    $facebook = $_POST['facebook'];
    $twitter = $_POST['twitter'];
    $linkedin = $_POST['linkedin'];



    $stmt = $conn->prepare("UPDATE site_settings SET name = ?, facebook_link = ?, twitter_link = ?, linkedin_link = ? WHERE id = 1");
    $stmt->bind_param("ssss", $name, $facebook, $twitter, $linkedin);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo "Footer settings updated successfully!";
    } else {
        echo "No changes made to the footer settings.";
    }
    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="d-flex flex-column min-vh-100">
<div class="container my-5">
    <h2 class="text-center">Settings</h2>

    <!-- Form to upload logo and update footer settings -->
    <form action="" method="post" enctype="multipart/form-data" class="mt-4">
        <!-- Logo upload -->
        <div class="mb-3">
            <label for="logo" class="form-label">Select logo to upload:</label>
            <input type="file" name="logo" id="logo" class="form-control">
        </div>

        <!-- Footer name -->
        <div class="mb-3">
            <label for="name" class="form-label">Footer Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo $footer['name']; ?>" required>
        </div>

        <!-- Footer social links -->
        <div class="mb-3">
            <label for="facebook" class="form-label">Facebook Link</label>
            <input type="url" name="facebook" id="facebook" class="form-control" value="<?php echo $footer['facebook_link']; ?>">
        </div>
        <div class="mb-3">
            <label for="twitter" class="form-label">Twitter Link</label>
            <input type="url" name="twitter" id="twitter" class="form-control" value="<?php echo $footer['twitter_link']; ?>">
        </div>
        <div class="mb-3">
            <label for="linkedin" class="form-label">LinkedIn Link</label>
            <input type="url" name="linkedin" id="linkedin" class="form-control" value="<?php echo $footer['linkedin_link']; ?>">
        </div>

        <!-- Submit buttons -->
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary me-md-2">Save Settings</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
    </form>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>

<?php include('admin_footer.php'); ?>
<?php

include('db_connect.php');


// Initialize default values for footer in case no data is returned
$footer = [
    'name' => 'NGO Employee Location Tracking System',
    'facebook_link' => '#',
    'youtube_link' => '#',
  
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
        $target_dir = 'uploads/'; // Corrected path
        $target_file = $target_dir . basename($_FILES["logo"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES["logo"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            
              echo "<script> alert('File is not an image.');</script>"; 
            $uploadOk = 0;
        }

        // Check if file already exists
        if (file_exists($target_file)) {
            
	     echo "<script>alert('Sorry, Logo file already exists.');  window.location.href = 'site_settings.php';</script>";

            $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["logo"]["size"] > 500000) { // Limit set to 500KB
           
	    echo "<script>alert('Sorry, your file is too large.');window.location.href = 'site_settings.php';</script>";
            $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
             echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');window.location.href = 'site_settings.php';</script>";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            
		 echo "<script>alert('Sorry, your file was not uploaded.');window.location.href = 'site_settings.php';</script>";

        // If everything is ok, try to upload the file
        } else {
            if (move_uploaded_file($_FILES["logo"]["tmp_name"], $target_file)) {
                // Insert or update the logo path in the database
                $stmt = $conn->prepare("UPDATE site_settings SET logo_path = ? WHERE id = 1");
                
                // Check if the query was prepared successfully
                if ($stmt === false) {
                    die('Error preparing statement for logo: ' . $conn->error);
                }

                $stmt->bind_param("s", $target_file);
                $stmt->execute();
                
                if ($stmt->affected_rows > 0) {
                    
				 echo "<script> alert(' The logo  "  . htmlspecialchars(basename($_FILES['logo']['name'])) . " has been uploaded.');</script>";


                } else {
                  
				 echo "<script>alert('No changes made to the logo.');window.location.href = 'site_settings.php';</script>";

                }
                $stmt->close();
            } else {
				 echo "<script>alert('Sorry, your file was not uploaded.');window.location.href = 'site_settings.php';</script>";

            }
        }
    }

    // Handle footer settings update
    $name = $_POST['name'];
    $facebook = $_POST['facebook'];
    $youtube = $_POST['youtube'];
  

    $stmt = $conn->prepare("UPDATE site_settings SET name = ?, facebook_link = ?, youtube_link = ? WHERE id = 1");
    
    // Check if the query was prepared successfully
    if ($stmt === false) {
        die('Error preparing statement for footer settings: ' . $conn->error);
    }

    $stmt->bind_param("sss", $name, $facebook, $youtube);
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        
		echo "<script>alert('Footer settings updated successfully!');window.location.href = 'site_settings.php';</script>";
    } else {
        
		echo "<script>alert('No changes made to the footer settings.');window.location.href = 'site_settings.php';</script>";
    }
    $stmt->close();
}

$conn->close();
?>
<?php include('header_setting.php');?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <!-- Bootstrap CSS
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="styles.css">
</head>
<body  class="d-flex flex-column min-vh-100">
<div class="container my-5 mt-3 mb-0" >
    <h2 style="color:green;" class="text-center">Settings</h2>

    <!-- Form to upload logo and update footer settings -->
    <form action="" method="post" enctype="multipart/form-data" class="mt-1 mb-0">
        <!-- Logo upload -->
        <div class="mb-2">
            <label for="logo" class="form-label">Select logo to upload:</label>
            <input type="file" name="logo" id="logo" class="form-control">
        </div>

        <!-- Footer name -->
        <div class="mb-2">
            <label for="Company name" class="form-label">Company Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo $footer['name']; ?>" required>
        </div>

        <!-- Footer social links -->
        <div class="mb-2">
            <label for="facebook" class="form-label">Facebook Link</label>
            <input type="url" name="facebook" id="facebook" class="form-control" value="<?php echo $footer['facebook_link']; ?>">
        </div>
        <div class="mb-2">
            <label for="youtube" class="form-label">Youtube Link</label>
            <input type="url" name="youtube" id="youtube" class="form-control" value="<?php echo $footer['youtube_link']; ?>">
        </div>
       

        <!-- Submit buttons -->
        <div class="d-grid gap-2 d-md-flex justify-content-md-end ">
            <button type="submit" class="btn btn-primary me-md-2">Save Settings</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </div>
    </form>
</div>
<?php include('footer.php'); ?>
<!-- Bootstrap JS 
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>-->

</body>
</html>


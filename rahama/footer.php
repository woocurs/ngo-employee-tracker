
<?php
// footer.php

// Database connection
include('db_connect.php');

// Fetch current footer settings
$query = "SELECT * FROM site_settings WHERE id = 1";
$result = $conn->query($query);

// Initialize default values in case the database does not return any result
$footer = [
    'name' => 'NGO Employee Location Tracking System',  // Default name
    'facebook_link' => '#',  // Default placeholder links
    'youtube_link' => '#',

];

// If a result is found, update the footer array
if ($result && $result->num_rows > 0) {
    $footer = $result->fetch_assoc();
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NGO Employee Location Tracking System</title>
    <!-- Bootstrap CSS -->
    <!--<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">-->
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Your page content here -->

       <footer class="bg-dark text-white text-center py-2 mt-auto">
        <div class="container mt-1">
            <div class="row">
                <div class="col-12 col-md-6 mb-2 mb-md-0">
                    <p class="mb-1 fs-6 fs-md-5">&copy; <?php echo date("Y"); ?> <?php echo htmlspecialchars($footer['name']); ?>. All rights reserved.</p>
                </div>
                <div class="col-12 col-md-6">
                    <p class="mb-0">
                        Follow us on:
                        <a href="<?php echo htmlspecialchars($footer['facebook_link']); ?>" target="_blank" class="text-white ms-2"><i class="fab fa-facebook"></i></a>
                        <a href="<?php echo htmlspecialchars($footer['youtube_link']); ?>" target="_blank" class="text-white ms-2"><i class="fab fa-youtube"></i></a>
                        
                    </p>
                </div>
            </div>
        </div>
    </footer>


    <!-- Optional JavaScript; choose one of the two! -->

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
<!-- admin_footer.php -->
<?php


// Database connection
include('../db_connect.php');

// Fetch current footer settings
$query = "SELECT * FROM settings WHERE id = 1";
$result = $conn->query($query);

// Initialize default values in case the database does not return any result
$footer = [
    'name' => 'NGO Employee Location Tracking System',  // Default name
    'facebook_link' => '#',  // Default placeholder links
    'twitter_link' => '#',
    'linkedin_link' => '#',
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
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    
</head>
<body class="d-flex flex-column min-vh-100">

<footer class="bg-dark text-white text-center py-2 mt-auto">
    <div class="container mt-1">
        <div class="row">
            <div class="col-12 col-md-6 mb-2 mb-md-0">
                <p class="mb-1 fs-6 fs-md-5">© 2024 NGO Employee Location Tracking System. All rights reserved.</p>
            </div>
            <div class="col-12 col-md-6">
                <p class="mb-0">
                    Follow us on:
                    <a href="facebook_link" target="_blank" class="text-white ms-2"><i class="fab fa-facebook"></i></a>
                    <a href="twitter_link" target="_blank" class="text-white ms-2"><i class="fab fa-twitter"></i></a>
                    <a href="linkedin_link" target="_blank" class="text-white ms-2"><i class="fab fa-linkedin"></i></a>
                </p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
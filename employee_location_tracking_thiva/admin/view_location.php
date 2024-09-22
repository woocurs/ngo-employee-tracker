<?php
include('admin_header.php');
include('../db_connect.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

// Sanitize input
$employee_id = intval($_GET['id']);

if ($employee_id <= 0) {
    die("Invalid employee ID.");
}

// Construct the query
$locationQuery = "SELECT * FROM employee_tracking WHERE employee_id = $employee_id ORDER BY sign_in_time DESC LIMIT 1";

// Execute the query and check for errors
$locationResult = $conn->query($locationQuery);

if (!$locationResult) {
    die("Query failed: " . $conn->error);
}

$location = $locationResult->fetch_assoc();
?>

<div class="container mt-5">
    <h2 class="text-center">Employee Location</h2>
    <?php if ($location) { ?>
        <p><strong>Sign In Time:</strong> <?php echo htmlspecialchars($location['sign_in_time']); ?></p>
        <p><strong>Sign In Location:</strong> <?php echo htmlspecialchars($location['sign_in_location']); ?></p>
        <p><strong>Latitude:</strong> <?php echo htmlspecialchars($location['latitude']); ?></p>
        <p><strong>Longitude:</strong> <?php echo htmlspecialchars($location['longitude']); ?></p>
        <?php if (!empty($location['sign_out_time'])) { ?>
            <p><strong>Sign Out Time:</strong> <?php echo htmlspecialchars($location['sign_out_time']); ?></p>
            <p><strong>Sign Out Location:</strong> <?php echo htmlspecialchars($location['sign_out_location']); ?></p>
        <?php } ?>
        
        <!-- Google Map -->
        <div id="map" style="width:100%;height:400px;"></div>

        <script>
        function initMap() {
            var location = {lat: <?php echo $location['latitude']; ?>, lng: <?php echo $location['longitude']; ?>};
            var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: location
            });
            var marker = new google.maps.Marker({
                position: location,
                map: map
            });
        }
        </script>

        <!-- Replace YOUR_API_KEY with your actual API key -->
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&callback=initMap"></script>
        
    <?php } else { ?>
        <p>No location data available for this employee.</p>
    <?php } ?>
</div>

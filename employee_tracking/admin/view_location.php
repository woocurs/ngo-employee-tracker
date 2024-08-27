<?php
include('admin_header.php');
include('../db_connect.php');
session_start();

if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Sanitize input
$employee_id = intval($_GET['id']);

if ($employee_id <= 0) {
    die("Invalid employee ID.");
}

// Prepare and execute the query to get the location
$stmt = $conn->prepare("
    SELECT sign_in_time, sign_in_location, sign_out_time, sign_out_location, latitude, longitude 
    FROM employee_tracking 
    WHERE employee_id = ? 
    ORDER BY id DESC LIMIT 1
");
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$locationResult = $stmt->get_result();
$location = $locationResult->fetch_assoc();

$stmt->close();
$conn->close();
?>

<div class="container mt-5">
    <h2 class="text-center" style="margin-top: 70px;">Employee Location</h2>
    <?php if ($location) { ?>
        <p><strong>Sign In Time:</strong> <?php echo htmlspecialchars($location['sign_in_time']); ?></p>
        <p><strong>Sign In Location:</strong> <?php echo htmlspecialchars($location['sign_in_location']); ?></p>
        <?php if (!empty($location['sign_out_time'])) { ?>
            <p><strong>Sign Out Time:</strong> <?php echo htmlspecialchars($location['sign_out_time']); ?></p>
            <p><strong>Sign Out Location:</strong> <?php echo htmlspecialchars($location['sign_out_location']); ?></p>
        <?php } ?>
        
        <!-- Google Map -->
        <div id="map" style="width: 80%; height: 350px; margin-top: 190px; margin: 0 auto; display: flex; justify-content: center; align-items: center;"></div>

        <script>
        function initMap() {
            // Use PHP variables for latitude and longitude in JavaScript
            var location = {
                lat: <?php echo $location['latitude']; ?>, 
                lng: <?php echo $location['longitude']; ?>
            };
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

<?php include('admin_footer.php'); ?>

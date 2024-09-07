<?php
//employee_dashboard.php
include('db_connect.php') include('footer.php'); // Ensure the database connection is included
session_start();
if (!isset($_SESSION['employee_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.html");
    exit();
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['signOut'])) {
    $employee_id = $_SESSION['employee_id'];
    $sign_out_time = $_POST['sign_out_time'];
    $sign_out_location = $_POST['sign_out_location'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
	  

    // Prepare SQL statement
    $update_stmt = $conn->prepare("UPDATE employee_tracking SET sign_out_time = now(), sign_out_location = ?,latitude=?, longitude=? WHERE employee_id = ? AND sign_out_time IS NULL ORDER BY sign_in_time DESC LIMIT 1");


    $update_stmt->bind_param("isss", $employee_id,  $sign_out_location,$latitude, $longitude);

    if ($update_stmt->execute()) {
        echo "Sign out successful!";
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $update_stmt->close();
}

$conn->close();
?>

<?php include 'header.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Dashboard</title>
    <script>
        function getLocation(signOut) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                   // var signOutTime=new Date().toISOString(); 
                    var signOutLocation = position.coords.latitude + ', ' + position.coords.longitude;

                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                   // document.getElementById('sign_out_time').value = signOutTime;
                    document.getElementById('sign_out_location').value = signOutLocation;

                    document.getElementById('locationForm').submit();
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
    </script>
</head>
<body>

<div class="d-flex align-items-center justify-content-center" style="min-height: 55vh;">
    <div class="form-container">
        <h2>NGO EMPLOYEE</h2>
        <h3>Welcome, Employee ID: <?php echo htmlspecialchars($_SESSION['employee_id']); ?>!</h3>
        <p class="text-center">This is your dashboard.</p>
        <div class="text-center">
            <form id="locationForm" action="logout.php" method="post">
                <input type="hidden" id="latitude" name="latitude">
                <input type="hidden" id="longitude" name="longitude">
             <!--  <input type="hidden" id="sign_out_time" name="sign_out_time">-->
                <input type="hidden" id="sign_out_location" name="sign_out_location">

                <input type="submit" name="signOut" onclick="getLocation('signOut')" value="Sign Out" class="btn btn-danger w-100">
            </form>
        </div>
    </div>
</div>

</body>
</html>
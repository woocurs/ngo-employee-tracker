<?php
include('../includes/db_connect.php');
include('../includes/functions.php');



checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $employee_id = $_SESSION['employee_id'];

    $stmt = $conn->prepare("INSERT INTO attendance (employee_id, action, latitude, longitude, timestamp) VALUES (?, ?, ?, ?, NOW())");
    $stmt->bind_param("isss", $employee_id, $action, $latitude, $longitude);

    if ($stmt->execute()) {
        echo ucfirst($action) . " successful!";
        header("location:logout.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}

$employee_id = $_SESSION['employee_id'];
$stmt = $conn->prepare("SELECT * FROM employees WHERE id = ?");
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$employee = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Dashboard</title>
    <link rel="stylesheet" href="../styles.css">
    <script>
        function getLocation(action) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                    document.getElementById('action').value = action;
                    document.getElementById('locationForm').submit();
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
    </script>
</head>
<body>
 <form id="locationForm" method="post" action="">
        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">
        <input type="hidden" id="action" name="action">
        
     <div align="right">  <a href="dashboard.php" target="_blank">  <button  type="button">HOME</button></a>

      <a href="logout.php" target="_blank">  <button  type="submit" onclick="getLocation('sign out')">Sign Out</button></a></div>
    </form>
    <h2>Welcome, <?php echo $employee['name']; ?>!</h2>
   
    <br>
    <h3>Your Profile</h3>
    <table>
        <tr><th>Name:</th><td><?php echo $employee['name']; ?></td></tr>
        <tr><th>Email:</th><td><?php echo $employee['email']; ?></td></tr>
<tr><th>Gender:</th><td><?php echo $employee['gender']; ?></td></tr>
        <tr><th>Department:</th><td><?php echo $employee['department']; ?></td></tr>
        <tr><th>Position:</th><td><?php echo $employee['position']; ?></td></tr>
        <tr><th>Salary:</th><td><?php echo $employee['salary']; ?></td></tr>
        <tr><th>Join Date:</th><td><?php echo $employee['join_date']; ?></td></tr>
    </table>
    <br>
  

</body>
</html>
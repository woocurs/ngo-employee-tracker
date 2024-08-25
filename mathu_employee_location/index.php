<?php
include('includes/db_connect.php');
include('includes/functions.php');

redirectIfLoggedIn();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
       

    $stmt = $conn->prepare("SELECT id, password FROM employees WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($id, $hashedPassword);
    $stmt->fetch();

    if (verifyPassword($password, $hashedPassword))
    {
        $_SESSION['employee_id'] = $id;
		if (isset($_POST['action']))
		{
   			 $action = $_POST['action'];
    			 $latitude = $_POST['latitude'];
    			 $longitude = $_POST['longitude'];
    			 $employee_id = $_SESSION['employee_id'];

		$stm="insert into attendance values('','$employee_id','$action','$latitude','$longitude',now())";
		mysqli_query($conn,$stm);
                


    		/* $stm = $conn->prepare("INSERT INTO attendance (employee_id, action, latitude, longitude, timestamp) VALUES (?, ?, ?, ?, NOW())");
    		$stm->bind_param("isss", $employee_id, $action, $latitude, $longitude);
    		$stm->execute(); */
    		}
	
	header("Location: employee/dashboard.php");
    }
else {
        echo "Invalid email or password!";
     }
} 


	
 	



?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
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

    <h2>Employee Login</h2>
   <form id="locationForm" method="post" action="">
<!--<nav class="navbar" align="right">
    <a href="logout.php" target="_blank" > <button class="logout-button" type="submit" onclick="getLocation('sign out')" >Log Out</button></a></nav>-->

<br>
        <label>Email:</label><input type="email" name="email" required><br>
        <label>Password:</label><input type="password" name="password" required><br>
       
        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">
        <input type="hidden" id="action" name="action">
   
        <button type="submit" onclick="getLocation('sign in')">Login</button>

    </form>
<div><a href="register.php">Don't have an account?<button target="_blank">Register</button></a></div>

</body>
</html>
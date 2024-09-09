<?php include 'header.php'; include('db_connect.php');// index.php ?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
   
    <script>
        function getLocation(signIn) {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    // Get current date and time for sign-in
                  //  var signInTime = new Date().toLocaleString(); // Format: YYYY-MM-DDTHH:MM:SSZ

                    // Generate sign-in location string (latitude, longitude)
                    var signInLocation = position.coords.latitude + ', ' + position.coords.longitude;

                    // Set hidden fields with location and time data
                    document.getElementById('latitude').value = position.coords.latitude;
                    document.getElementById('longitude').value = position.coords.longitude;
                   // document.getElementById('sign_in_time').value = signInTime;
                    document.getElementById('sign_in_location').value = signInLocation;

                    // Submit the form
                    document.getElementById('locationForm').submit();
                }, function(error) {
                    alert("Error getting location: " + error.message);
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }
        }
    </script>

</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 d-flex justify-content-center">
            <div class="form-container">
                <h2>NGO EMPLOYEE</h2>
                <h3>SIGN IN</h3>
                <form id="locationForm" action="login.php" method="post">
                    <div class="mb-3">
                        <input type="text" name="id" class="form-control" placeholder="Enter ID" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                    </div>
                    <!-- Hidden fields for location and time data -->
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">
                   <!-- <input type="hidden" id="sign_in_time" name="sign_in_time">-->
                    <input type="hidden" id="sign_in_location" name="sign_in_location">

                    <div class="text-center">
                        <input type="submit" onclick="getLocation('signIn')" value="Sign In" class="btn btn-success w-100">
                        <input type="reset" value="Reset" class="btn btn-success w-100 mt-2">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

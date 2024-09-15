<?php
include('header.php');
include('db_connect.php');
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script>
        function captureSelfie(callback) {
            var video = document.createElement('video');
            var canvas = document.createElement('canvas');
            var context = canvas.getContext('2d');

            navigator.mediaDevices.getUserMedia({ video: true })
                .then(function(stream) {
                    video.srcObject = stream;
                    video.play();
                    
                    setTimeout(function() {
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);
                        var selfieDataUrl = canvas.toDataURL('image/jpeg');
                        
                        video.srcObject.getTracks().forEach(track => track.stop()); // Stop video stream
                        callback(selfieDataUrl);
                    }, 1000);
                })
                .catch(function(error) {
                    alert("Error accessing camera: " + error.message);
                });
        }

        function getLocation(event) {
            event.preventDefault(); // Prevent default form submission
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    var signInLocation = latitude + ', ' + longitude;

                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;
                    document.getElementById('sign_in_location').value = signInLocation;

                    captureSelfie(function(selfieDataUrl) {
                        document.getElementById('selfie').value = selfieDataUrl;
                        document.getElementById('locationForm').submit();
                    });
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
                        <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                    </div>
                    <!-- Hidden fields for location and time data -->
                    <input type="hidden" id="latitude" name="latitude">
                    <input type="hidden" id="longitude" name="longitude">
                    <input type="hidden" id="sign_in_location" name="sign_in_location">
                    <input type="hidden" id="selfie" name="selfie">

                    <div class="text-center">
                        <input type="submit" onclick="getLocation(event)" value="Sign In" class="btn btn-success w-100">                      
                        <input type="reset" value="Reset" class="btn btn-success w-100 mt-2">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
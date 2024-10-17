<?php
session_start();
if (!isset($_SESSION['employee_id'])) {
    header("Location: sign_in.php"); // Redirect if not signed in
    exit();
}
include('db_connect.php');
include 'header.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Dashboard</title>
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
                    var signOutLocation = latitude + ', ' + longitude;

                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;
                    document.getElementById('sign_out_location').value = signOutLocation;

                    captureSelfie(function(selfieDataUrl) {
                        document.getElementById('selfie').value = selfieDataUrl;
                        document.getElementById('locationForm').submit();
                    });
                }, function(error) {
                    alert("Error fetching location: " + error.message);
                });
        }
    }

        function getLocation(event) {
            event.preventDefault(); // Prevent default form submission
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function(position) {
                    var latitude = position.coords.latitude;
                    var longitude = position.coords.longitude;
                    var signOutLocation = latitude + ', ' + longitude;

                    document.getElementById('latitude').value = latitude;
                    document.getElementById('longitude').value = longitude;
                    document.getElementById('sign_out_location').value = signOutLocation;

                    captureSelfie(function(selfieDataUrl) {
                        document.getElementById('selfie').value = selfieDataUrl;
                        document.getElementById('locationForm').submit();
                    });
                }, function(error) {
                    alert("Error fetching location: " + error.message);
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
                <input type="hidden" id="sign_out_location" name="sign_out_location">
                <input type="hidden" id="selfie" name="selfie">

                <button type="submit" onclick="getLocation(event)" class="btn btn-danger">Sign Out</button>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
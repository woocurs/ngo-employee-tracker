<?php
session_start();
include('db_connect.php');

// Check if the employee is logged in
if (!isset($_SESSION['employee_id'])) {
    header("Location: sign_in.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_SESSION['employee_id'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $sign_out_location = $_POST['sign_out_location'];
    $selfieDataUrl = $_POST['selfie'] ?? '';

    // Handle selfie data
    if ($selfieDataUrl) {
        // Create 'uploads/selfies' directory if it doesn't exist
        $selfieFolder = 'uploads/selfies/';
        if (!is_dir($selfieFolder)) {
            mkdir($selfieFolder, 0755, true); // Create the folder with proper permissions
        }

        // Convert base64 image data to binary and save to file
        if (preg_match('/^data:image\/(\w+);base64,/', $selfieDataUrl, $type)) {
            $selfieDataUrl = substr($selfieDataUrl, strpos($selfieDataUrl, ',') + 1);
            $type = strtolower($type[1]); // jpg, png, etc.

            if (!in_array($type, ['jpg', 'jpeg', 'png'])) {
                throw new Exception('Invalid image type');
            }

            // Decode the base64 data to get the image binary
            $selfie = base64_decode($selfieDataUrl);

            // Generate a unique filename for the selfie
            $selfieFileName = $selfieFolder . 'selfie_' . $employee_id . '_' . time() . '.' . $type;

            // Save the selfie to the folder
            if (!file_put_contents($selfieFileName, $selfie)) {
                throw new Exception('Failed to save selfie image.');
            }

            // Prepare SQL statement to store the file path in the database
            $stmt = $conn->prepare("UPDATE employee_tracking SET sign_out_time = NOW(), sign_out_location = ?, latitude = ?, longitude = ?, sign_out_selfie = ? WHERE employee_id = ? AND sign_out_time IS NULL");

            if ($stmt === false) {
                die("Prepare failed: " . $conn->error);
            }

            // Bind parameters (store the file path, not the binary data)
            $stmt->bind_param("ssssi", $sign_out_location, $latitude, $longitude, $selfieFileName, $employee_id);

            // Execute the SQL statement
            if (!$stmt->execute()) {
                die("Execute failed: " . $stmt->error);
            }

            $stmt->close();
        } else {
            throw new Exception('Invalid image data');
        }
    }

    // End session and redirect to sign-in page
    session_unset();
    session_destroy();
    header("Location: sign_in.php");
    exit();
}

$conn->close();
?>
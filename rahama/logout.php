<?php
session_start();
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $employee_id = $_SESSION['employee_id'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $sign_out_location = $_POST['sign_out_location'];
    $selfieDataUrl = $_POST['selfie'] ?? '';

    if ($selfieDataUrl) {
        // Convert base64 to binary
        if (preg_match('/^data:image\/(\w+);base64,/', $selfieDataUrl, $type)) {
            $selfieDataUrl = substr($selfieDataUrl, strpos($selfieDataUrl, ',') + 1);
            $type = strtolower($type[1]);
            if (!in_array($type, ['jpg', 'jpeg', 'png'])) {
                die('Invalid image type');
            }
            $selfie = base64_decode($selfieDataUrl);
        } else {
            die('Invalid image data');
        }

        // Prepare SQL statement
        $stmt = $conn->prepare("UPDATE employee_tracking SET sign_out_time = now(), sign_out_location = ?, latitude = ?, longitude = ?, sign_out_selfie = ? WHERE employee_id = ? AND sign_out_time IS NULL");

        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }

        // Bind parameters
        $stmt->bind_param("ssssi", $sign_out_location, $latitude, $longitude, $selfie, $employee_id);

        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }

        $stmt->close();
    }

    session_unset();
    session_destroy();

    header("Location: sign_in.php");
    exit();
}
$conn->close();
?>
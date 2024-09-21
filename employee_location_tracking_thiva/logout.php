<?php
session_start(); // Start the session

// Include the database connection
include('db_connect.php');

if (isset($_SESSION['employee_id'])) {
    // Get the employee ID and sign-out details from POST request
    $employee_id = $_SESSION['employee_id'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $sign_out_location = $_POST['sign_out_location'];

    // Debugging: Print the POST data to check if values are received correctly
    // echo "Latitude: $latitude, Longitude: $longitude, Location: $sign_out_location";

    // Update the existing employee tracking record for sign-out
    $stmt_update = $conn->prepare("UPDATE employee_tracking SET sign_out_time = now(), sign_out_location = ?, sign_out_latitude = ?, sign_out_longitude = ? WHERE employee_id = ? AND sign_out_time IS NULL");

    // Check if prepare was successful
    if ($stmt_update === false) {
        echo "Error preparing statement: " . $conn->error;
    } else {
        // Bind parameters
        $stmt_update->bind_param("sddi", $sign_out_location, $latitude, $longitude, $employee_id);

        // Execute the statement
        if (!$stmt_update->execute()) {
            echo "Error executing statement: " . $stmt_update->error;
        }
    }

    $stmt_update->close();

    // Unset session data and destroy the session
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session itself

    // Redirect to the sign-in page
    header("Location: sign_in.php?message=logged_out");
    exit(); // Stop further script execution
} else {
    // If no employee is logged in, redirect to the sign-in page
    header("Location: sign_in.php");
    exit(); // Stop further script execution
}

$conn->close();
?>

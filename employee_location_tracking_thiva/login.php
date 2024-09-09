<?php
session_start(); // Start the session as the first thing

include('db_connect.php'); // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT id, password FROM employees WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verify password (assume password is stored in plain text; should hash it)
        if ($password === $hashed_password) {
            $_SESSION['employee_id'] = $id;

            // Insert tracking info
            $latitude = $_POST['latitude'];
            $longitude = $_POST['longitude'];
            $sign_in_location = $_POST['sign_in_location'];
            $employee_id = $_SESSION['employee_id'];

            $stmt_insert = $conn->prepare("INSERT INTO employee_tracking (employee_id, sign_in_time, sign_in_location, sign_in_latitude, sign_in_longitude) VALUES (?, now(), ?, ?, ?)");
            $stmt_insert->bind_param("isss", $employee_id, $sign_in_location, $latitude, $longitude);

            if (!$stmt_insert->execute()) {
                echo "Error: " . $stmt_insert->error;
            }

            $stmt_insert->close();

            header("Location: dashboard.php"); // Redirect to dashboard
            exit(); // Important: stop further script execution
        } else {
            echo "<div style='color: white; font-size: 18px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;'>Invalid password.</div>";
        }
    } else {
        echo "<div style='color: white; font-size: 18px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;'>No user found with that ID.</div>";
    }

    $stmt->close();
}
$conn->close();
?>

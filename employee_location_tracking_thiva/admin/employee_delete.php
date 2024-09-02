



<?php
session_start();
include('../db_connect.php'); // Assuming the database connection is in this file

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

// Check if any employees were selected for deletion
if (isset($_POST['employee_ids']) && is_array($_POST['employee_ids'])) {
    $employee_ids = $_POST['employee_ids'];

    // Prepare the SQL statement to delete employees
    $placeholders = implode(',', array_fill(0, count($employee_ids), '?'));
    $deleteQuery = "DELETE FROM employees WHERE id IN ($placeholders)";
    $stmt = $conn->prepare($deleteQuery);

    // Bind the employee IDs to the statement
    $stmt->bind_param(str_repeat('i', count($employee_ids)), ...$employee_ids);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Selected employees have been successfully deleted.";
    } else {
        $_SESSION['message'] = "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    $_SESSION['message'] = "No employees selected for deletion.";
}

$conn->close();

// Redirect back to the admin dashboard
header("Location: admin_dashboard.php");
exit();
?>
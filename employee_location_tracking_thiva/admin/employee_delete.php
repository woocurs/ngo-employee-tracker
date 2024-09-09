<?php
session_start();
include('../db_connect.php'); // Include database connection

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

// Check if the 'ids' parameter is set
if (isset($_GET['ids'])) {
    $ids = explode(',', $_GET['ids']);
    
    // Prepare the DELETE query
    $stmt = $conn->prepare("DELETE FROM employees WHERE id = ?");
    
    foreach ($ids as $id) {
        // Bind the ID parameter and execute the query
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        // Optionally, delete associated records in the employee_tracking table
        $trackingStmt = $conn->prepare("DELETE FROM employee_tracking WHERE employee_id = ?");
        $trackingStmt->bind_param("i", $id);
        $trackingStmt->execute();
        $trackingStmt->close();
    }
    
    $stmt->close();
    header("Location: admin_dashboard.php"); // Redirect back to the dashboard after deletion
    exit();
} else {
    echo "No employees selected for deletion.";
}


?>

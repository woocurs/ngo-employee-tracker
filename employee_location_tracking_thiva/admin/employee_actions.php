<?php
include('../db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['employee_ids'])) {
    $action = $_GET['action'];
    $selected_employees = $_POST['employee_ids'];

    if ($action == 'delete') {
        foreach ($selected_employees as $employee_id) {
            $stmt = $conn->prepare("DELETE FROM employees WHERE id = ?");
            $stmt->bind_param("i", $employee_id);
            $stmt->execute();
        }
    } elseif ($action == 'reset') {
        foreach ($selected_employees as $employee_id) {
            // Reset the selected employee's details to default values
            $stmt = $conn->prepare("UPDATE employees SET name='John Doe', email='johndoe@example.com', phone_number='0000000000' WHERE id = ?");
            $stmt->bind_param("i", $employee_id);
            $stmt->execute();
        }
    }

    header("Location: admin_dashboard.php");
    exit();
}
?>
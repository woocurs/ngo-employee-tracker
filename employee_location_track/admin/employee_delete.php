<?php
include('../includes/db_connect.php');
include('../includes/functions.php');

//checkLogin();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM employees WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: employee_fetch.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>
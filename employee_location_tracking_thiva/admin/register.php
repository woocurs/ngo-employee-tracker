<?php
include('../db_connect.php');

include 'admin_header.php'; 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    


    $stmt = $conn->prepare("INSERT INTO employees (name, email,phone_number, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssis", $name, $email, $phone,$password);

    if ($stmt->execute()) {
        echo "Registration successful!";
        
    } else {
        echo "Error:This email already exit " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h2>Employee Registration</h2>
    <form method="post" action="">
        <label>Name:</label><input type="text" name="name" required><br>
        <label>Email:</label><input type="email" name="email" required><br>
	<label>Phone_Number:</label><input type="tel" name="phone" pattern="[0-9]{10}" required><br>
	<label>Password:</label><input type="password" name="password" required><br>
                      
        <button type="submit">Register</button>
    </form>

    <?php
// Include the footer
include('admin_footer.php');
?>


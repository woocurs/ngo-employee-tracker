<?php
include('includes/db_connect.php');
include('includes/functions.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = encryptPassword($_POST['password']);
    $gender = $_POST['gender'];
    $department = $_POST['department'];
    $position = $_POST['position'];
    $salary = $_POST['salary'];
    $join_date = $_POST['join_date'];




    $stmt = $conn->prepare("INSERT INTO employees (name, email, password, gender, department, position, salary, join_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssds", $name, $email, $password, $gender, $department, $position, $salary, $join_date);

    if ($stmt->execute()) {
        echo "Registration successful!";
        header("Location: index.php");
    } else {
        echo "Error: " . $stmt->error;
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
        <label>Password:</label><input type="password" name="password" required><br>
        <label>Gender:</label>
        <select name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br>
        <label>Department:</label><input type="text" name="department"><br>
        <label>Position:</label><input type="text" name="position"><br>
        <label>Salary:</label><input type="text" name="salary"><br>
        <label>Join Date:</label><input type="date" name="join_date"><br>
        <button type="submit">Register</button>
    </form>
<div><a href="index.php">Already have an account!<button target="_blank">Login</button></a></div>
</body>
</html>
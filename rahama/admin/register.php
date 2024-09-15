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
        echo "<script>alert('Registeration successfully!');  window.location.href = 'register.php';</script>";
        
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
<body><br>
    <h2 style="color:green;">Employee Registration</h2>
    <form method="post" action="">
        <label>Name:</label><input type="text" name="name" required><br>
        <label>Email:</label><input type="email" name="email" required><br>
	
	<label>Password:</label><input type="password" name="password" required><br>
         <label>Phone Number:</label><input type="number" name="phone" required><br><br>             
        <button type="submit">Register</button> &nbsp;
	<button type="reset">Reset</button>
    </form>
<?php include ('../footer.php'); ?>
</body>

</html>

<?php
include('../db_connect.php');

include('admin_header.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM employees WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $employee = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    

    
    $stmt = $conn->prepare("UPDATE employees SET name=?, email=?, phone_number=?  WHERE id=?");
    $stmt->bind_param("ssii", $name, $email, $phone_number, $id);
   

    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h2>Edit Employee</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $employee['id']; ?>">
        <label>Name:</label><input type="text" name="name" value="<?php echo $employee['name']; ?>" required><br>
        <label>Email:</label><input type="email" name="email" value="<?php echo $employee['email']; ?>" required><br>
               <label>Phone Number:</label><input type="number" name="phone_number" value="<?php echo $employee['phone_number']; ?>"><br><br>
                <button type="submit">Update</button>
		<button type="reset">Reset</button>

    </form>
</body>
</html>
<?php include('admin_footer.php'); ?>
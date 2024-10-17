<?php
ob_start(); // Start output buffering

include('../db_connect.php');
include('admin_header.php');

// Fetch employee details when id is passed in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM employees WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $employee = $stmt->get_result()->fetch_assoc();
}

// Backup and Update logic after form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
 /*   

    $stmt = $conn->prepare($backupQuery);
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        echo "Backup Error: " . $stmt->error;
    }
*/

    // Update employee details
    $updateQuery = "UPDATE employees SET name = ?, email = ?, phone_number = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ssii", $name, $email, $phone_number, $id);
    
    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
        exit(); // Ensure no further code runs after redirect
    } else {
        echo "Update Error: " . $stmt->error;
    }
}

ob_end_flush(); // Flush the output buffer and turn off output buffering
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h2 style="margin-top:30px; color:green";>Edit Employee</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($employee['id']); ?>">
        <label>Name:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($employee['name']); ?>" required><br>
        
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($employee['email']); ?>" required><br>
        
        <label>Phone Number:</label>
        <input type="tel" name="phone_number" value="<?php echo htmlspecialchars($employee['phone_number']); ?>"><br><br>
        
        <button type="submit">Update</button>
        <button type="reset">Reset</button>
    </form>
</body>
</html>

<?php include('../footer.php'); ?>
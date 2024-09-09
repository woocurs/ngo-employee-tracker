<?php
// Start session and include necessary files
session_start();
include('admin_header.php');
include('../db_connect.php'); // Assuming the database connection is in this file

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

// Initialize a variable to store the success message
$successMessage = "";

// Get the employee IDs from the URL
$employee_ids = isset($_GET['ids']) ? explode(",", $_GET['ids']) : [];
if (empty($employee_ids)) {
    echo "No employees selected.";
    exit();
}

// Fetch the details of the first selected employee
$employee_id = $employee_ids[0];
$employeeQuery = "SELECT name, email, phone_number FROM employees WHERE id = ?";
$stmt = $conn->prepare($employeeQuery);
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$employeeResult = $stmt->get_result();

if ($employeeResult->num_rows == 0) {
    echo "Employee not found.";
    exit();
}

$employee = $employeeResult->fetch_assoc();

// Handle form submission to update employee details
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    $updateQuery = "UPDATE employees SET name = ?, email = ?, phone_number = ? WHERE id = ?";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bind_param("sssi", $name, $email, $phone_number, $employee_id);
    $updateStmt->execute();

    // Set the success message after updating the employee details
    $successMessage = "Successfully changed!";
}
?>

<div class="container mt-5">
    <h2>Edit Employee</h2>

    <!-- Display the success message if it exists -->
    <?php if (!empty($successMessage)) { ?>
        <div class="alert alert-success">
            <?php echo $successMessage; ?>
        </div>
    <?php } ?>

    <form method="POST">
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($employee['name']); ?>" required>
        </div>
        <div class="form-group mt-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?php echo htmlspecialchars($employee['email']); ?>" required>
        </div>
        <div class="form-group mt-3">
            <label for="phone_number">Phone Number</label>
            <input type="text" name="phone_number" id="phone_number" class="form-control" value="<?php echo htmlspecialchars($employee['phone_number']); ?>" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Save Changes</button>
        <a href="admin_dashboard.php" class="btn btn-secondary mt-3">Cancel</a>
    </form>
</div>

<?php


// Include the footer
include('admin_footer.php');
?>

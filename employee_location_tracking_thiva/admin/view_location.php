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

// Get the employee IDs from the URL
$employee_ids = isset($_GET['ids']) ? explode(",", $_GET['ids']) : [];
if (empty($employee_ids)) {
    echo "No employees selected.";
    exit();
}

// Fetch the most recent (current) location of each selected employee
$employeeIds = implode(",", array_map('intval', $employee_ids));
$locationQuery = "
    SELECT e.id, e.name, et.sign_in_location AS current_location
    FROM employees e
    LEFT JOIN (
        SELECT employee_id, sign_in_location
        FROM employee_tracking
        WHERE (employee_id, sign_in_time) IN (
            SELECT employee_id, MAX(sign_in_time)
            FROM employee_tracking
            GROUP BY employee_id
        )
    ) et ON e.id = et.employee_id
    WHERE e.id IN ($employeeIds)
    ORDER BY e.id ASC";

$locationResult = $conn->query($locationQuery);

// Check for query errors
if (!$locationResult) {
    die("Query failed: " . $conn->error);
}
?>

<div class="container mt-5">
    <h2 class="text-center">Current Employee Locations</h2>
    <div class="table-responsive mt-4">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Current Location</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($locationResult->num_rows > 0) { ?>
                    <?php while ($location = $locationResult->fetch_assoc()) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($location['id']); ?></td>
                            <td><?php echo htmlspecialchars($location['name']); ?></td>
                            <td><?php echo htmlspecialchars($location['current_location']); ?></td>
                        </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="3" class="text-center">No locations found for the selected employees.</td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="text-center mt-4">
        <a href="admin_dashboard.php" class="btn btn-primary">Back to Dashboard</a>
    </div>
</div>

<?php
// Include the footer
include('admin_footer.php');
?>

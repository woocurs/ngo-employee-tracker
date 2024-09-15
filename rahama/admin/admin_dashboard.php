<?php
// Start session and include necessary files
session_start();
include('../db_connect.php'); // Ensure the database connection is included

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../sign_in.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch employee details including their last sign-in and sign-out details
$employeeQuery = "
    SELECT e.id, e.name, e.email, e.phone_number, 
           et.sign_in_time, et.sign_in_location, 
           et.sign_out_time, et.sign_out_location,
           et.sign_in_selfie, et.sign_out_selfie
    FROM employees e
    LEFT JOIN (
        SELECT employee_id, sign_in_time, sign_in_location, sign_out_time, sign_out_location, sign_in_selfie, sign_out_selfie
        FROM employee_tracking
        WHERE (employee_id, sign_in_time) IN (
            SELECT employee_id, MAX(sign_in_time)
            FROM employee_tracking
            GROUP BY employee_id
        )
    ) et ON e.id = et.employee_id
    ORDER BY e.id ASC";

$employeeResult = $conn->query($employeeQuery);

// Check for query errors
if (!$employeeResult) {
    die("Query failed: " . $conn->error);
}
?>

<?php include('admin_header.php'); ?>

<div class="container mt-5">
    <h2 class="text-center">Admin Dashboard</h2>

    <?php
    // Display session message, if available
    if (isset($_SESSION['message'])) {
        echo "<div class='alert alert-info'>" . htmlspecialchars($_SESSION['message']) . "</div>";
        unset($_SESSION['message']); // Clear the message after displaying
    }
    ?>

    <h3 class="mt-4">Employee Details</h3>
    <form id="employeeForm" action="" method="post">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Sign-In Time</th>
                        <th>Sign-In Location</th>
                        <th>Sign-Out Time</th>
                        <th>Sign-Out Location</th>
                        <th>Sign-In Selfie</th>
                        <th>Sign-Out Selfie</th>
                        <th>View Location</th>
                        <th>Edit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($employeeResult->num_rows > 0) { ?>
                        <?php while ($employee = $employeeResult->fetch_assoc()) { ?>
                            <tr>
                                <td>
                                    <input type="checkbox" name="employee_ids[]" value="<?php echo htmlspecialchars($employee['id']); ?>">
                                </td>
                                <td><?php echo htmlspecialchars($employee['id']); ?></td>
                                <td><?php echo htmlspecialchars($employee['name']); ?></td>
                                <td><?php echo htmlspecialchars($employee['email']); ?></td>
                                <td><?php echo htmlspecialchars($employee['phone_number']); ?></td>
                                <td><?php echo htmlspecialchars($employee['sign_in_time']); ?></td>
                                <td><?php echo htmlspecialchars($employee['sign_in_location']); ?></td>
                                <td><?php echo htmlspecialchars($employee['sign_out_time']); ?></td>
                                <td><?php echo htmlspecialchars($employee['sign_out_location']); ?></td>
                                <td>
                                    <?php if ($employee['sign_in_selfie']) { ?>
                                        <a href="data:image/jpeg;base64,<?php echo base64_encode($employee['sign_in_selfie']); ?>" target="_blank">View Selfie</a>
                                    <?php } else { ?>
                                        No Selfie
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($employee['sign_out_selfie']) { ?>
                                        <a href="data:image/jpeg;base64,<?php echo base64_encode($employee['sign_out_selfie']); ?>" target="_blank">View Selfie</a>
                                    <?php } else { ?>
                                        No Selfie
                                    <?php } ?>
                                </td>
                                <td>
                                    <a href="https://www.google.com/maps/@<?php echo htmlspecialchars($employee['sign_in_location']); ?>,15z" target="_blank">
                                        <button type="button" class="btn btn-info">View</button>
                                    </a>
                                </td>
                                <td>
                                    <a href="employee_edit.php?id=<?php echo htmlspecialchars($employee['id']); ?>">
                                        <button type="button" class="btn btn-primary">Edit</button>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="13" class="text-center">No employees found matching the criteria.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </form>

    <button type="button" class="btn btn-danger mt-3" onclick="confirmDelete()">Delete Selected</button>
    <button type="button" class="btn btn-warning mt-3" onclick="window.location.href='view_location.php'">View Location Selected</button>
</div>

<?php
// Close the database connection
$conn->close();

// Include the footer
include('../footer.php');
?>

<script>
// Select/Deselect All Checkboxes
document.getElementById('selectAll').onclick = function() {
    var checkboxes = document.querySelectorAll('input[name="employee_ids[]"]');
    for (var checkbox of checkboxes) {
        checkbox.checked = this.checked;
    }
};

// Confirm deletion before submitting the form
function confirmDelete() {
    var selected = document.querySelectorAll('input[name="employee_ids[]"]:checked');
    if (selected.length > 0) {
        if (confirm("Are you sure you want to delete the selected employees?")) {
            document.getElementById('employeeForm').action = 'employee_delete.php?action=delete';
            document.getElementById('employeeForm').submit();
        }
    } else {
        alert("Please select at least one employee to delete.");
    }
}
</script>
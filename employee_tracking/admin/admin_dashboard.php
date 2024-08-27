<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

include('admin_header.php');
include('../db_connect.php');

// Query to retrieve employee details with the most recent tracking data
$employeeQuery = "
    SELECT e.id, e.name, e.email, e.phone_number, et.sign_in_time, et.sign_in_location, et.sign_out_time, et.sign_out_location 
    FROM employees e
    LEFT JOIN (
        SELECT employee_id, sign_in_time, sign_in_location, sign_out_time, sign_out_location
        FROM employee_tracking et1
        WHERE sign_in_time = (
            SELECT MAX(sign_in_time)
            FROM employee_tracking et2
            WHERE et1.employee_id = et2.employee_id
        )
    ) et ON e.id = et.employee_id
    ORDER BY e.id ASC
";
$employeeResult = $conn->query($employeeQuery);

if (!$employeeResult) {
    echo "Error: " . $conn->error;
}
?>

<div class="container" style="margin-top: 120px;">
    <h2 class="text-center">Admin Dashboard</h2>
    <h3 class="mt-4">Employee Details</h3>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone Number</th>
                <th>Sign-In Time</th>
                <th>Sign-In Location</th>
                <th>Sign-Out Time</th>
                <th>Sign-Out Location</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($employeeResult->num_rows > 0) {
                while ($employee = $employeeResult->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $employee['id']; ?></td>
                        <td><?php echo $employee['name']; ?></td>
                        <td><?php echo $employee['email']; ?></td>
                        <td><?php echo $employee['phone_number']; ?></td>
                        <td><?php echo $employee['sign_in_time']; ?></td>
                        <td><?php echo $employee['sign_in_location']; ?></td>
                        <td><?php echo $employee['sign_out_time']; ?></td>
                        <td><?php echo $employee['sign_out_location']; ?></td>
                        <td>
                            <a href="view_location.php?id=<?php echo $employee['id']; ?>" class="btn btn-info">View Location</a>
                        </td>
                    </tr>
            <?php } 
            } else { ?>
                <tr>
                    <td colspan="9" class="text-center">No employee records found.</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include('admin_footer.php'); ?>

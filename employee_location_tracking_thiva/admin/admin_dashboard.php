<?php
session_start();
ob_start(); // Add this line at the top to buffer output
include('admin_header.php');
include('../db_connect.php');

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])){
    header("Location: index.php"); // Redirect to login page if not logged in
    exit();
}

// Fetch employee details including their last sign-in and sign-out details
$employeeQuery = "
    SELECT e.id, e.name, e.email, e.phone_number, 
           et.sign_in_time, et.sign_in_location, 
           et.sign_out_time, et.sign_out_location 
    FROM employees e
    LEFT JOIN (
        SELECT employee_id, sign_in_time, sign_in_location, sign_out_time, sign_out_location
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
ob_end_flush();
?>

<div class="container mt-5">
    <h2 class="text-center">Admin Dashboard</h2>
    <h3 class="mt-4">Employee Details</h3>
    <div class="table-responsive">
        <form id="adminActionsForm" method="POST">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th></th>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Sign-In Time</th>
                        <th>Sign-In Location</th>
                        <th>Sign-Out Time</th>
                        <th>Sign-Out Location</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($employeeResult->num_rows > 0) { ?>
                        <?php while ($employee = $employeeResult->fetch_assoc()) { ?>
                            <tr>
                                <td><input type="checkbox" name="select_employee[]" value="<?php echo $employee['id']; ?>"></td>
                                <td><?php echo htmlspecialchars($employee['id']); ?></td>
                                <td><?php echo htmlspecialchars($employee['name']); ?></td>
                                <td><?php echo htmlspecialchars($employee['email']); ?></td>
                                <td><?php echo htmlspecialchars($employee['phone_number']); ?></td>
                                <td><?php echo htmlspecialchars($employee['sign_in_time']); ?></td>
                                <td><?php echo htmlspecialchars($employee['sign_in_location']); ?></td>
                                <td><?php echo htmlspecialchars($employee['sign_out_time']); ?></td>
                                <td><?php echo htmlspecialchars($employee['sign_out_location']); ?></td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="9" class="text-center">No employees found.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div class="mt-3">
                <button type="button" class="btn btn-info" id="viewSelectedLocationBtn">View Location</button>
                <button type="button" class="btn btn-warning" id="editSelectedBtn">Edit Selected</button>
                <button type="button" class="btn btn-danger" id="deleteSelectedBtn">Delete Selected</button>
            </div>
        </form>
    </div>
</div>

<script>
    // Function to handle View Location action
    document.getElementById('viewSelectedLocationBtn').addEventListener('click', function () {
        handleAction('view_location.php');
    });

    // Function to handle Edit action
    document.getElementById('editSelectedBtn').addEventListener('click', function () {
        handleAction('employee_edit.php');
    });

    // Function to handle Delete action
    document.getElementById('deleteSelectedBtn').addEventListener('click', function () {
        if (confirm('Are you sure you want to delete the selected employees?')) {
            handleAction('employee_delete.php');
        }
    });

    // Helper function to handle actions for selected employees
    function handleAction(actionUrl) {
        var selected = [];
        document.querySelectorAll('input[name="select_employee[]"]:checked').forEach(function (checkbox) {
            selected.push(checkbox.value);
        });
        if (selected.length > 0) {
            var form = document.createElement('form');
            form.method = 'GET';
            form.action = actionUrl;

            var input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'ids';
            input.value = selected.join(',');
            form.appendChild(input);

            document.body.appendChild(form);
            form.submit();
        } else {
            alert("Please select at least one employee.");
        }
    }
</script>

<?php
// Include the footer
include('admin_footer.php');
?>

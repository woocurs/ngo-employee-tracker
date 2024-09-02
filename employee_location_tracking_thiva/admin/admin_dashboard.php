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
?>

<div class="container mt-5">
    <h2 class="text-center">Admin Dashboard</h2>
    <h3 class="mt-4">Employee Details</h3>
    <form id="employeeForm" action="edit_employee.php" method="post">
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
                                                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="10" class="text-center">No employees found matching the criteria.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </form>
    <button type="button" class="btn btn-primary mt-3" onclick="editSelected()">Edit Selected</button>
    <button type="button" class="btn btn-danger mt-3" onclick="confirmDelete()">Delete Selected</button>
  <!--  <button type="button" class="btn btn-warning mt-3" onclick="resetSelected()">Reset Selected</button>--> <!-- Reset Button -->
</div>

<?php
// Close the database connection
$conn->close();

// Include the footer
include('admin_footer.php');
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
            document.getElementById('employeeForm').submit();
        }
    } else {
        alert("Please select at least one employee to delete.");
    }
}

// Edit selected employee
function editSelected() {
    var selected = document.querySelectorAll('input[name="employee_ids[]"]:checked');
    if (selected.length == 1) { // Allow editing only one employee at a time
        var employeeId = selected[0].value;
        window.location.href = 'employee_edit.php?id=' + employeeId;
    } else if (selected.length > 1) {
        alert("Please select only one employee to edit.");
    } else {
        alert("Please select an employee to edit.");
    }
}

// Reset selected employee details
//function resetSelected() {
  //  var selected = document.querySelectorAll('input[name="employee_ids[]"]:checked');
  //  if (selected.length > 0) {
    //    if (confirm("Are you sure you want to reset the details of the selected employees?")) {
     //       document.getElementById('employeeForm').action = 'employee_actions.php?action=reset';
     //       document.getElementById('employeeForm').submit();
      //  }
   // } else {
    //    alert("Please select at least one employee to reset.");
  //  }
//}
</script>
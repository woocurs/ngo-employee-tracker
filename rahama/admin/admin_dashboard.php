<?php
// admin_dashboard.php
session_start();
include('../db_connect.php'); // Ensure the database connection is included

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: ../sign_in.php"); // Redirect to login page if not logged in
    exit();
}

// Initialize variables for search functionality
$searchTerm = '';
$employeeQuery = "
    SELECT e.id, e.name, e.email, e.phone_number, 
           DATE_FORMAT(et.sign_in_time, '%Y-%m-%d %H:%i:%s') AS sign_in_time, 
           et.sign_in_location, 
           DATE_FORMAT(et.sign_out_time, '%Y-%m-%d %H:%i:%s') AS sign_out_time, 
           et.sign_out_location,
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
    ) et ON e.id = et.employee_id";

// Check for search term
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
    $searchTerm = $_POST['search'];
    // Update query to include search functionality
    $employeeQuery .= " WHERE e.name LIKE ? OR e.email LIKE ? OR e.phone_number LIKE ? 
                        OR DATE_FORMAT(et.sign_in_time, '%Y-%m-%d %H:%i:%s') LIKE ? 
                        OR et.sign_in_location LIKE ? 
                        OR DATE_FORMAT(et.sign_out_time, '%Y-%m-%d %H:%i:%s') LIKE ? 
                        OR et.sign_out_location LIKE ?";
}

$employeeQuery .= " ORDER BY e.id ASC";

// Prepare the statement
$stmt = $conn->prepare($employeeQuery);

// Bind parameters if searching
if ($searchTerm) {
    $searchWildcard = "%" . $searchTerm . "%";
    $stmt->bind_param("sssssss", $searchWildcard, $searchWildcard, $searchWildcard, $searchWildcard, $searchWildcard, $searchWildcard, $searchWildcard);
}

// Execute the statement
$stmt->execute();
$employeeResult = $stmt->get_result();

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
    
    <!-- Search Form -->
    <form method="POST" action="" class="mb-4">
        <input type="text" name="search" placeholder="Search by Name, Email, or Phone Number" value="<?php echo htmlspecialchars($searchTerm); ?>" class="form-control" style="width: 300px; display: inline-block;">
        <button type="submit" class="btn btn-primary">Search</button>
        <button type="button" class="btn btn-secondary" onclick="clearSearch()">Clear Search</button>
    </form>

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
                        <th>Sign-In Location</th>
                        <th>Sign-Out Location</th>
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
                                        <a href="../<?php echo ($employee['sign_in_selfie']); ?>" target="_blank">  <i class="fas fa-camera"></i></a>
                                           
                                        </a>
                                    <?php } else { ?>
                                       
                                    <?php } ?>
                                </td>
                                <td>
                                    <?php if ($employee['sign_out_selfie']) { ?>
                                        <a href="../<?php echo ($employee['sign_out_selfie']); ?>" target="_blank">  <i class="fas fa-camera"></i></a>
                                           
                                        </a>
                                    <?php } else { ?>
                                        
                                    <?php } ?>
                                </td>

                                <td>
									 <?php if ($employee['sign_in_location']) { ?>
                                    <a href="https://www.google.com/maps/@<?php echo htmlspecialchars($employee['sign_in_location']); ?>,15z" target="_blank">
                                        <i class="fas fa-map-marker-alt"></i> <!-- Location icon -->
                                    </a>
									<?php } else { ?>
									 <?php } ?>
                                </td>
                                <td>
									 <?php if ($employee['sign_out_location']) { ?>
                                     <a href="https://www.google.com/maps/@<?php echo htmlspecialchars($employee['sign_out_location']); ?>,15z" target="_blank">
                                        <i class="fas fa-map-marker-alt"></i> <!-- Location icon -->
                                    </a>
									<?php } else { ?>
									 <?php } ?>
                                </td>
                                <td>
                                    <a href="employee_edit.php?id=<?php echo htmlspecialchars($employee['id']); ?>" style="color: red;">
                                        <i class="fas fa-edit"></i> <!-- Edit icon -->
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

<!-- Modal for viewing selfie images -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Selfie Image</h5>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<button type="button" class="btn btn-danger" data-dismiss="modal" aria-label="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="selfieImage" src="" alt="Selfie" class="img-fluid">
            </div>
           <!-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>-->
        </div>
    </div>
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

// Function to clear the search input
function clearSearch() {
    document.querySelector('input[name="search"]').value = '';
    document.getElementById('employeeForm').submit(); // Resubmit form to clear search results
}

// Function to view the selfie image in a modal
	/*
	function viewImage(imagePath) {
    var selfieImage = document.getElementById('selfieImage');
    selfieImage.src = imagePath
 // Set the image source to the selected image path
    selfieImage.src = imagePath;
    
    // Show the modal
    $('#imageModal').modal('show');
}
*/




// Function to view the selfie image
function viewImage(imagePath) {
    // Set the image source to the modal's image element
    document.getElementById('selfieImage').src = imagePath;
    // Show the modal
    var imageModal = new bootstrap.Modal(document.getElementById('imageModal'), {
        keyboard: true
    });
    imageModal.show();
}
</script>




<!-- Include jQuery and Bootstrap JS for modal functionality -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>



</body>
</html>
	
	

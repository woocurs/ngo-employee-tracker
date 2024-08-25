<?php
include('../includes/db_connect.php');
include('../includes/functions.php');




// Admin Authentication - Assuming you have a simple admin check
//checkLogin(); // Ensure the admin is logged in


// Fetch all employees
$employee_result = $conn->query("SELECT * FROM employees");

?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
<nav class="navbar" align="right">
           <a href="real-time_map.php" target="_blank" > <button id="view-button">View Real-Time_Map</button></a>
           
  
</nav>
    <h2>Admin Dashboard</h2>

    <!-- Employee Details Table -->
    <h3>All Employees</h3>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>Department</th>
            <th>Position</th>
            <th>Salary</th>
            <th>Join Date</th>
            <th>Actions</th>
        </tr>
        <?php while ($employee = $employee_result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $employee['name']; ?></td>
            <td><?php echo $employee['email']; ?></td>
            <td><?php echo $employee['gender']; ?></td>
            <td><?php echo $employee['department']; ?></td>
            <td><?php echo $employee['position']; ?></td>
            <td><?php echo $employee['salary']; ?></td>
            <td><?php echo $employee['join_date']; ?></td>
            <td>
                <a href="employee_edit.php?id=<?php echo $employee['id']; ?>">Edit</a> | 
                <a href="employee_delete.php?id=<?php echo $employee['id']; ?>" 
                   onclick="return confirm('Are you sure you want to delete this employee?');">Delete</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>

   </body>
</html>
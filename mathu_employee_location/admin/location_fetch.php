<?php
include('../includes/db_connect.php');
include('../includes/functions.php');




// Admin Authentication - Assuming you have a simple admin check
//checkLogin(); // Ensure the admin is logged in



// Fetch employee location history
$location_result = $conn->query("SELECT a.id, e.name, a.action, a.latitude, a.longitude, a.timestamp 
                                  FROM attendance a 
                                  JOIN employees e ON a.employee_id = e.id 
                                  ORDER BY a.timestamp DESC");
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

        <!-- Employee Location Tracking Table -->
    <h3>Employee Location History</h3>
    <table>
        <tr>
	     <th>ID</th>
            <th>Name</th>
            <th>Action</th>
            <th>Latitude</th>
            <th>Longitude</th>
            <th>Timestamp</th>
	    <th>View-Map</th>
		<th>Actions</th>
        </tr>
        <?php while ($location = $location_result->fetch_assoc()): ?>
        <tr>
	    <td><?php echo $location['id']; ?></td>
            <td><?php echo $location['name']; ?></td>
            <td><?php echo ucfirst($location['action']); ?></td>
            <td><?php echo $location['latitude']; ?></td>
            <td><?php echo $location['longitude']; ?></td>
            <td><?php echo $location['timestamp']; ?></td>
	    <td><a href="https://www.google.com/maps/@$location['latitude'],$location['longitude'],15z" target="_blank">View</a></td>
		<td>
                                <a href="history_delete.php?id=<?php echo $location['id']; ?>" 
                   onclick="return confirm('Are you sure you want to delete this history?');">Delete</a>
            </td>

        </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
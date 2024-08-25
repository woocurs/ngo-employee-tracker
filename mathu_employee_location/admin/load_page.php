<?php
if (isset($_GET['page'])) {
    $page = $_GET['page'];
    
    if ($page == 'profile') {
        include 'profile.php';
    } elseif ($page == 'employees') {
        include 'employee_fetch.php';
    } elseif ($page == 'locations') {
        include 'location_fetch.php';
    } else {
        echo "<h2>Page not found</h2>";
    }
} else {
    echo "<h2>Welcome to the Admin Dashboard</h2><p>Select an option from the sidebar to view more details.</p>";
}
?>
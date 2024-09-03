<?php
<<<<<<< HEAD
include('../db_connect.php');
include('functions.php'); // Assuming you put the function in this file

$logo_path = get_logo_path($conn);
?>


=======
$current_page = basename($_SERVER['PHP_SELF']);
?>
>>>>>>> main
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Admin Dashboard</title>
    <style>
        body {
            background-color: #1d2630;
        }
        .navbar {
            margin-bottom: 50px;
            background-color: rgb(9, 153, 110);
            position: fixed;
            padding: 0.5rem 1rem;
            line-height: 1.2;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
        .navbar-brand {
            margin-left: 60px;
            font-size: 30px;
            color: rgb(230, 230, 230);
            font-family: 'Georgia', serif;
            pointer-events: none;
        }
        .nav-item {
            margin-right: 35px;
            font-size: 18px; 
            color: white;
        }

        .container {
            margin-top: 100px;
        }
        h2 {
            color: white;
            text-align: center;
            font-family: 'Georgia', serif;
            font-size: 50px;
            margin-bottom: 20px;
            margin-top: 10px;
        }
        h3 {
            color: rgb(9, 153, 110);
            text-align: center;
            font-family: 'Georgia', serif;
            font-size: 30px;
        }
        .btn-primary {
            background-color: rgb(9, 153, 110);
            border-color: rgb(9, 153, 110);
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .nav-link {
            color: white;
            padding: 8px 16px;
            border-radius: 5px;
        }
        .nav-link:hover {
            color: #1d2630;
        }
        p{
            color: white;
            text-align: center;
            font-family: 'Georgia', serif;
            font-size: 16px;
            margin-bottom: 20px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
	  <a class="navbar-brand" href="#">
            <?php if ($logo_path): ?>
                <img src="<?php echo $logo_path; ?>" alt="Logo" style="height: 50px;">
            <?php else: ?>

            <span>NGO Admin</span>
	   <?php endif; ?>
        </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <!-- Conditionally display the "Dashboard" link -->
                    <?php if($current_page == 'view_location.php' || $current_page == 'employee_edit.php'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                    </li>
                    <?php endif; ?>
                    <?php if($current_page == 'view_location.php' || $current_page == 'employee_edit.php' || $current_page == 'admin_dashboard.php'): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin_logout.php">Logout</a>
                    </li>
<<<<<<< HEAD
		    <li class="nav-item">
                        <a class="nav-link" href="site_settings.php">Settings</a>
                    </li>
		    <li class="nav-item">
                        <a class="nav-link" href="admin_dashboard.php">Admin-Home</a>
                    </li>


=======
                    <?php endif; ?>
>>>>>>> main
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <!-- Your page content here -->
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-9O4pCwN0G0wSPHzI7C2V9wFA2g5HpD6+wZs08oTf3i8LOa0UsM3bmZ6p1tFz6F4O" crossorigin="anonymous"></script>
    
    <!-- Additional JavaScript for Navbar Toggle -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var navbarToggler = document.querySelector('.navbar-toggler');
            var navbarNav = document.querySelector('#navbarNav');
            
            navbarToggler.addEventListener('click', function () {
                navbarNav.classList.toggle('show');
            });
        });
    </script>


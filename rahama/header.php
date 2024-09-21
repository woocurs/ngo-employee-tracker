<?php
include('db_connect.php');
include('admin/functions.php'); // Assuming you put the function in this file

$site_info = get_logo_path($conn); // Fetch the logo path and company name
$logo_path = $site_info['logo_path'];
$company_name = $site_info['name'];
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Sign In Page</title>
    <style>
        body {
            background-color: #1d2630;
        }
        .navbar {
            margin-bottom: 0px;
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
            text-align: center; 
            display: flex; 
            align-items: center;
            justify-content: center; 
        }
           
	.nav-item {
            margin-right: 35px;
            font-size: 18px; 
            color: white;
        }

	

        .container {
            margin-top: 50px;
        }

        }
        .form-container {
            max-width: 400px;
            width: 80%;
            margin: auto;
        }
        input {
            width: 90%;
            height: 50px;
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

/* Change color on hover */
     .nav-link:hover {
          color: #1d2630;
          background-color: white;
      }

/* Change color when clicked */
    .nav-link:active {
        color: #1d2630;
        background-color: #f8f9fa;
      }

/* Indicate active page */
   .nav-link.active {
       color: #1d2630;
       background-color: #e0e0e0;
       font-weight: bold;
       border-radius: 5px;
     }
  
        footer {
            background-color: #1d2630;
            color: #fff;
            text-align: center;
            padding: 20px;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .footer-content p {
            font-size: 14px;
            margin: 0;
        }

        .footer-content a {
            color: #fff;
            text-decoration: none;
        }

        .footer-content a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
 <?php
$current_page = basename($_SERVER['PHP_SELF']);
?>


    <nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <?php if ($logo_path): ?>
                <img src="<?php echo htmlspecialchars($logo_path); ?>" alt="" style="height: 50px;"> <span style="color: rgb(230, 230, 230);"><?php echo htmlspecialchars($company_name); ?></span>

            <?php else: ?>
                <span style="color: rgb(230, 230, 230);"><?php echo htmlspecialchars($company_name); ?></span>
            <?php endif; ?>
        </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item">
                         <a class="nav-link <?php echo ($current_page == 'index.php') ? 'active' : ''; ?>" href="index.php">Home</a>
                </li>
		<li class="nav-item">
                    <a class="nav-link <?php echo ($current_page == 'about_us.php') ? 'active' : ''; ?>" href="about_us.php">About Us</a>
                </li>

                    <li class="nav-item">
                         <a class="nav-link <?php echo ($current_page == 'sign_in.php') ? 'active' : ''; ?>" href="sign_in.php">Sign In</a>

                    </li>
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
                if (navbarNav.classList.contains('show')) {
                    navbarNav.classList.remove('show');
                } else {
                    navbarNav.classList.add('show');
                }
            });
        });
    </script>


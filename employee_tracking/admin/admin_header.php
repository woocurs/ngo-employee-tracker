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
            font-size: 20px; 
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
        p {
            color: rgb(9, 153, 110);
            text-align: center;
            font-family: 'Times New Roman', serif;
            font-size: 15px;
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
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <span class="navbar-brand">NGO Admin</span>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['admin_id'])): ?>
                        <?php if (basename($_SERVER['PHP_SELF']) === 'view_location.php'): ?>
                            <li class="nav-item">
                               <a class="nav-link" href="admin_dashboard.php">Dashboard</a>
                           </li>
                           <?php endif; ?>
                        <li class="nav-item">
                            <a class="nav-link" href="admin_logout.php">Logout</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

<?php
session_start();
ob_start(); // Add this line at the top to buffer output
include('admin_header.php');
include('../db_connect.php');; // Include database connection

// Check if the admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: index.php");
    exit();
}

// Fetch current settings
$settingsQuery = "SELECT company_name, logo FROM settings LIMIT 1";
$settingsResult = $conn->query($settingsQuery);
$settings = $settingsResult ? $settingsResult->fetch_assoc() : null;

// Initialize default values for settings
$companyName = $settings['company_name'] ?? '';
$logo = $settings['logo'] ?? '';

// Update settings
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $companyName = $_POST['company_name'];
    $logo = $settings['logo'];

    // Handle logo upload
    if (!empty($_FILES['logo']['name'])) {
        $targetDir = "uploads/";
        $logo = $targetDir . basename($_FILES['logo']['name']);
        move_uploaded_file($_FILES['logo']['tmp_name'], $logo);
    }

    // Update the database
    $updateQuery = "UPDATE settings SET company_name = ?, logo = ? WHERE id = 1";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("ss", $companyName, $logo);
    $stmt->execute();
    $stmt->close();

    // Refresh the settings page to display updated values
    header("Location: settings.php");
    exit();
}

ob_end_flush();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Settings</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #1d2630;
            color: white;
        }
        .container {
            margin-top: 50px;
        }
        label {
            color: rgb(9, 153, 110);
        }
        .btn-primary {
            background-color: rgb(9, 153, 110);
            border-color: rgb(9, 153, 110);
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-secondary {
            background-color: rgb(9, 153, 110);
            border-color: rgb(9, 153, 110);
        }
        .btn-secondary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        h2 {
            text-align: center;
            font-family: 'Georgia', serif;
            font-size: 30px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Admin Settings</h2>
        <form action="settings.php" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="company_name" class="form-label">Company Name</label>
                <input type="text" class="form-control" id="company_name" name="company_name" value="<?php echo htmlspecialchars($companyName); ?>" required>
            </div>
            <div class="mb-3">
                <label for="logo" class="form-label">Logo</label>
                <input type="file" class="form-control" id="logo" name="logo">
                <?php if ($logo) { ?>
                    <img src="<?php echo htmlspecialchars($logo); ?>" alt="Current Logo" style="margin-top: 10px; height: 50px;">
                <?php } ?>
            </div>
            <button type="submit" class="btn btn-primary">Save Changes</button>
            <button type="reset" class="btn btn-secondary">Reset</button>
        </form>
    </div>
</body>
</html>
<?php
// Include the footer
include('admin_footer.php');
?>

<?php
include('db_connect.php');
session_start();

// Ensure the employee is logged in
if (!isset($_SESSION['employee_id'])) {
    header("Location: sign_in.php");
    exit();
}

$employee_id = $_SESSION['employee_id'];

// Fetch the selfie file paths from the database
$stmt = $conn->prepare("SELECT sign_in_selfie, sign_out_selfie FROM employee_tracking WHERE employee_id = ? ORDER BY sign_in_time DESC LIMIT 1");
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($sign_in_selfie, $sign_out_selfie);
    $stmt->fetch();
    
    // If there is no sign-out selfie, use the sign-in selfie
    $selfie_path = $sign_in_selfie ? $sign_in_selfie : $sign_out_selfie; 
} else {
    $selfie_path = null;
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Selfie</title>
</head>
<body>
    <div class="container">
        <h2>Your Selfie</h2>
        <?php if ($selfie_path && file_exists($selfie_path)): ?>
            <!-- Display the selfie -->
            <img src="<?php echo $selfie_path; ?>?<?php echo time(); ?>" alt="Selfie">
        <?php else: ?>
            <!-- If no selfie is found, show a message -->
            <p>No selfie found.</p>
            <?php 
            // Debug output to check the path
            if ($selfie_path) {
                echo "Selfie path: " . htmlspecialchars($selfie_path);
            }
            ?>
        <?php endif; ?>
    </div>

<?php include '../footer.php'; ?>
</body>
</html>
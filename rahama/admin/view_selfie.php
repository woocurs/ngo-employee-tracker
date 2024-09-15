<?php
include('db_connect.php');

session_start();

if (!isset($_SESSION['employee_id'])) {
    header("Location: sign_in.php");
    exit();
}

$employee_id = $_SESSION['employee_id'];

// Prepare and execute the query to fetch selfie
$stmt = $conn->prepare("SELECT sign_in_selfie, sign_out_selfie FROM employee_tracking WHERE employee_id = ? ORDER BY sign_in_time DESC LIMIT 1");
$stmt->bind_param("i", $employee_id);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows > 0) {
    $stmt->bind_result($sign_in_selfie, $sign_out_selfie);
    $stmt->fetch();
    $selfie_data = $sign_in_selfie ?: $sign_out_selfie; // Prefer sign-out selfie if available
} else {
    $selfie_data = null;
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html>
<head>
    <title>View Selfie</title>
</head>
<body>
    <h2>Your Selfie</h2>
    <?php if ($selfie_data): ?>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($selfie_data); ?>" alt="Selfie" style="max-width: 100%; height: auto;">
    <?php else: ?>
        <p>No selfie found.</p>
    <?php endif; ?>
</body>
</html>
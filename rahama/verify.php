<?php
include('db_connect.php');

if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    // Verify the email and token
    $stmt = $conn->prepare("SELECT id FROM employees WHERE email = ? AND verification_token = ?");
    $stmt->bind_param("ss", $email, $token);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Email verified, update status
        $stmt_update = $conn->prepare("UPDATE employees SET status = 1, verification_token = NULL WHERE email = ?");
        $stmt_update->bind_param("s", $email);
        $stmt_update->execute();

        echo "Your email has been verified. You can now log in.";
    } else {
        echo "Invalid verification link.";
    }
}
?>
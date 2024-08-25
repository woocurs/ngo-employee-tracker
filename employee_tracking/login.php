<?php include 'header.php'; ?>

<?php
//testing
session_start();
include 'db_connect.php'; // Include the database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $password = $_POST['password'];

    // Prepare and execute the query
    $stmt = $conn->prepare("SELECT id, password FROM employees WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->store_result();

    // Check if user exists
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        // Verify password (assuming password is stored in plain text; you should hash it for security)
        if ($password === $hashed_password) {
            // Password is correct, start a new session
            $_SESSION['employee_id'] = $id;
            header("Location: dashboard.php"); // Redirect to dashboard
            exit();
        } else {
            echo "<div style='color: white; textfont-size: 18px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;'>
                    Invalid password.
                  </div>";
        }
        } else {
            echo "<div style='color: white; font-size: 18px; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;'>
                    No user found with that ID.
                  </div>";
        }
        

    $stmt->close();
}
$conn->close();
?>

</body>
</html>

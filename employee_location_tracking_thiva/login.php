<?php
session_start();
include('db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Check if admin login
    $sql = "SELECT * FROM admin WHERE email = ? AND password = ? AND status = 1";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_name'] = $row['name'];
        header("Location: admin/admin_dashboard.php");
        exit();
    }

    // Prepare and execute the query for employee login
    $stmt = $conn->prepare("SELECT id, password FROM employees WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $hashed_password);
        $stmt->fetch();

        if ($password === $hashed_password) {
            $_SESSION['employee_id'] = $id;

            // Capture selfie
            $selfieDataUrl = $_POST['selfie'] ?? '';
            if ($selfieDataUrl) {
                // Convert base64 to binary
                if (preg_match('/^data:image\/(\w+);base64,/', $selfieDataUrl, $type)) {
                    $selfieDataUrl = substr($selfieDataUrl, strpos($selfieDataUrl, ',') + 1);
                    $type = strtolower($type[1]);
                    if (!in_array($type, ['jpg', 'jpeg', 'png'])) {
                        throw new \Exception('Invalid image type');
                    }
                    $selfie = base64_decode($selfieDataUrl);
                } else {
                    throw new \Exception('Invalid image data');
                }

                // Save selfie to database
                $stmt_insert = $conn->prepare("INSERT INTO employee_tracking (employee_id, sign_in_time, sign_in_location, sign_in_latitude, sign_in_longitude, sign_in_selfie) VALUES (?, now(), ?, ?, ?, ?)");
                $sign_in_location = $_POST['sign_in_location'];
                $latitude = $_POST['latitude'];
                $longitude = $_POST['longitude'];
                $stmt_insert->bind_param("issss", $_SESSION['employee_id'], $sign_in_location, $latitude, $longitude, $selfie);

                if (!$stmt_insert->execute()) {
                    echo "Error: " . $stmt_insert->error;
                }
                $stmt_insert->close();
            }

            header("Location: dashboard.php");
            exit();
        } else {
            echo "<script>alert('Invalid password.');  window.location.href = 'sign_in.php';</script>";
        }
    } else {
        echo "<script>alert('No user found with that ID.');  window.location.href = 'sign_in.php';</script>";
    }

    $stmt->close();
}
$conn->close();
?>
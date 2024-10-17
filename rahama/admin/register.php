<?php
include('../db_connect.php');
include 'admin_header.php'; 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        // Employee registration
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];
        $token = bin2hex(random_bytes(50)); // Generate random token for email verification

        // Check if the password has at least 8 characters
        if (strlen($password) < 8) {
            echo "<script>alert('Registration unsuccessful: Password must be at least 8 characters long.'); window.location.href = 'register.php';</script>";
        } elseif ($password !== $confirm_password) {
            // Check if password and confirm password match
            echo "<script>alert('Registration unsuccessful: Passwords do not match!'); window.location.href = 'register.php';</script>";
        } else {
            // Check if the email already exists
            $checkEmailStmt = $conn->prepare("SELECT email FROM employees WHERE email = ?");
            $checkEmailStmt->bind_param("s", $email);
            $checkEmailStmt->execute();
            $checkEmailStmt->store_result();

            if ($checkEmailStmt->num_rows > 0) {
                echo "<script>alert('Registration unsuccessful: User with this email already exists!'); window.location.href = 'register.php';</script>";
            } else {
                // Check if the phone number already exists
                $checkPhoneStmt = $conn->prepare("SELECT phone_number FROM employees WHERE phone_number = ?");
                $checkPhoneStmt->bind_param("s", $phone);
                $checkPhoneStmt->execute();
                $checkPhoneStmt->store_result();

                if ($checkPhoneStmt->num_rows > 0) {
                    echo "<script>alert('Registration unsuccessful: Phone number is already in use by another employee!'); window.location.href = 'register.php';</script>";
                } else {
                    // Proceed with the registration
                    $stmt = $conn->prepare("INSERT INTO employees (name, email, phone_number, password, verification_token) VALUES (?, ?, ?, ?, ?)");
                    $stmt->bind_param("ssiss", $name, $email, $phone, $password, $token);

                    if ($stmt->execute()) {
                        // Send verification email
                        $verifyLink = "https://rahama.woocurs.com/verify.php?email=$email&token=$token";
                        $subject = "Verify your email";
                        $message = "Please click the following link to verify your email: $verifyLink";
                        $headers = "From: noreply@rahamawoocurs.com";
                        mail($email, $subject, $message, $headers);

                        echo "<script>alert('Registration successful! Please verify your email to activate your account.'); window.location.href = 'register.php';</script>";
                    } else {
                        echo "<script>alert('Registration unsuccessful: " . $stmt->error . "'); window.location.href = 'register.php';</script>";
                    }
                }
                $checkPhoneStmt->close();
            }
            $checkEmailStmt->close();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .password-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .password-wrapper input {
            width: 100%;
            padding-right: 40px;
        }

        .password-wrapper i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
    <script>
        function togglePasswordVisibility() {
            var passwordInput = document.getElementById('password');
            var passwordToggle = document.getElementById('passwordToggle');
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordToggle.classList.remove('fa-eye');
                passwordToggle.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                passwordToggle.classList.remove('fa-eye-slash');
                passwordToggle.classList.add('fa-eye');
            }
        }

        function validateForm() {
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;

            // Check if password has at least 8 characters
            if (password.length < 8) {
                alert('Password must be at least 8 characters long.');
                return false;
            }

            // Check if passwords match
            if (password !== confirmPassword) {
                alert('Passwords do not match.');
                return false;
            }

            return true; // Allow form submission
        }
    </script>
</head>
<body><br>
    <h2 style="color:green;margin-top:30px;">Employee Registration</h2>
    <form method="post" action="" onsubmit="return validateForm()">
        <label>Name:</label><input type="text" name="name" required><br>
        <label>Email:</label><input type="email" name="email" required><br>
        
        <div class="password-wrapper">
            <label>Password:</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="" required>
            <i id="passwordToggle" class="fas fa-eye" onclick="togglePasswordVisibility()"></i>
        </div>
		
		<div class="password-wrapper">
            <label>Confirm Password:</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="" required>
        </div>

        <label>Phone Number:</label><input type="tel" name="phone" required><br><br>
        <button type="submit" name="register">Register</button> &nbsp;
        <button type="reset">Reset</button>
    </form>

<?php include ('../footer.php'); ?>
</body>
</html>
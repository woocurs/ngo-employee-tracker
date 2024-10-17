<?php
// reset_password.php
include('db_connect.php');

if (isset($_GET['email']) && isset($_GET['token'])) {
    $email = $_GET['email'];
    $token = $_GET['token'];

    // Check if token is valid
    $checkTokenStmt = $conn->prepare("SELECT employee_id FROM employees WHERE email = ? AND reset_token = ?");
    $checkTokenStmt->bind_param("ss", $email, $token);
    $checkTokenStmt->execute();
    $checkTokenStmt->store_result();

    if ($checkTokenStmt->num_rows > 0) {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $new_password = $_POST['new_password'];
            $confirm_password = $_POST['confirm_password'];

            if ($new_password === $confirm_password && strlen($new_password) >= 8) {
                // Update password and clear reset token
                $stmt = $conn->prepare("UPDATE employees SET password = ?, reset_token = NULL WHERE email = ?");
                $stmt->bind_param("ss", $new_password, $email);
                $stmt->execute();

                echo "<script>alert('Password reset successful! Please sign in.'); window.location.href = 'sign_in.php';</script>";
            } else {
                echo "<script>alert('Passwords do not match or are too short!');</script>";
            }
        }
    } else {
        echo "<script>alert('Invalid or expired token!'); window.location.href = 'forgot_password.php';</script>";
    }
    $checkTokenStmt->close();
}
?>
<?php include('header.php');?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
	<link rel="stylesheet" href="styles.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
	
    <style>
        .password-wrapper {
            position: relative;
            display: inline-block;
            width: 100%;
        }

        .password-wrapper input {
            width: 100%;
            padding-right: 40px; /* Adjust to make room for the icon */
        }

        .password-wrapper .fa-eye,
        .password-wrapper .fa-eye-slash {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            cursor: pointer;
            color: #aaa;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 d-flex justify-content-center">
            <div class="form-container">
    <h2 style="color:green;margin-top:30px;">Reset Password</h2>
    <form method="post" action="">
	                   
					    <div class="mb-3 password-wrapper">
                        <input type="password" name="new_password" id="password" class="form-control" placeholder="New Password" required minlength="8">
                        <i id="passwordToggle" class="fas fa-eye" onclick="togglePasswordVisibility()"></i>
                    </div>
					<div class="mb-3 password-wrapper">
                        <input type="password" name="confirm__password" id="password" class="form-control" placeholder="New Password" required minlength="8">
                        <i id="passwordToggle" class="fas fa-eye" onclick="togglePasswordVisibility()"></i>
                    </div>
					
					  <div class="text-center">
					   <button type="submit" value="Reset Password" class="btn btn-success w-100"/>
                        <button type="reset" value="Clear" class="btn btn-danger w-100 mt-2"/>
						
                    </div>
					   </form>
			</div>
		</div>
	</div>
</div>
       
 
<?php include 'footer.php'; ?>
</body>
</html>
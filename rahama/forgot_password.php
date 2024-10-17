<?php
// forgot_password.php
include('db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Invalid email format.'); window.location.href = 'forgot_password.php';</script>";
        exit();
    }

    // Check if email exists
    $checkEmailStmt = $conn->prepare("SELECT id FROM employees WHERE email = ?");
    if ($checkEmailStmt === false) {
        die('Prepare() failed: ' . htmlspecialchars($conn->error));
    }
    $checkEmailStmt->bind_param("s", $email);
    $checkEmailStmt->execute();
    $checkEmailStmt->store_result();

    if ($checkEmailStmt->num_rows > 0) {
        // Generate reset token and link
        $reset_token = bin2hex(random_bytes(50)); // Secure token
        $reset_link = "https://rahama.woocurs.com/reset_password.php?email=$email&token=$reset_token"; // Send token and email

        // Store reset token in the database (without hashing)
        $stmt = $conn->prepare("UPDATE employees SET reset_token = ? WHERE email = ?");
        if ($stmt === false) {
            die('Prepare() failed: ' . htmlspecialchars($conn->error));
        }
        $stmt->bind_param("ss", $reset_token, $email);
        $stmt->execute();

        // Send reset link to email
        $subject = "Password Reset Request";
        $message = "Please click the link to reset your password: $reset_link";
        $headers = "From: noreply@yourdomain.com";

        if (mail($email, $subject, $message, $headers)) {
            echo "<script>alert('Password reset link has been sent to your email.'); window.location.href = 'sign_in.php';</script>";
        } else {
            echo "<script>alert('Error sending email. Please try again.'); window.location.href = 'forgot_password.php';</script>";
        }
    } else {
        echo "<script>alert('Email does not exist!'); window.location.href = 'forgot_password.php';</script>";
    }

    $checkEmailStmt->close();
}
?>
<?php include('header.php');?>

<!DOCTYPE html>
<html>
<head>
    <title>Forgot Password</title>
	<link rel="stylesheet" href="styles.css">
	 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" />
	 
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 d-flex justify-content-center">
            <div class="form-container">
     <h2 style="color:green;margin-top:30px;text-align:center;">Forgot Password</h2>
    <form method="post" action="">
	                     <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Enter email" required>
                    </div>
					  <div class="text-center">
					   <input type="submit" value="Send Reset Link" class="btn btn-success w-100">
                        <input type="reset" value="Clear" class="btn btn-danger w-100 mt-2">
						  </div>
						  
						  </form>
				 </div>
			 </div>
		 </div>
     </div>
       
<?php include 'footer.php'; ?>    
</body>
</html>
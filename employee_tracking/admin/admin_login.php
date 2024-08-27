<?php
include('admin_header.php');
include('../db_connect.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM employees WHERE email = '$email' AND password = '$password' AND status = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_name'] = $row['name'];
        echo "Session set for admin_id: " . $_SESSION['admin_id'];

        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 d-flex justify-content-center">
            <div class="form-container">
                <h2>NGO EMPLOYEE</h2>
                <h3>Admin Login</h3>
                <form method="post">
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Enter Email" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password" required>
                    </div>
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
                    <?php endif; ?>
                    <div class="text-center">
                        <input type="submit" value="Login" class="btn btn-primary w-100 mt-4">
                        <input type="reset" value="Reset" class="btn btn-primary w-100 mt-2">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('admin_footer.php'); ?>


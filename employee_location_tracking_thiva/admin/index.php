<?php
include('admin_header.php');
include('../db_connect.php');
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM admin WHERE email = '$email' AND password = '$password' AND status = 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_name'] = $row['name'];
        header("Location: admin_dashboard.php");
        exit();
    } else {
        $error = "Invalid email or password";
    }
}
?>

<div class="container" style=" margin-top: 150px;">
        <div class="row justify-content-center">
            <div class="col-md-6 d-flex justify-content-center">
                <div class="form-container" style="max-width: 400px; width: 80%; margin: auto;">
                <div style="text-align: center;">
                        <h2 style="margin-left: -45px;">ADMIN LOGIN</h2>
                    </div>
                    <form method="post" style="text-align: center;">
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Enter Email" required style="width: 90%; height: 50px; ">
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" class="form-control" placeholder="Enter Password" required style="width: 90%; height: 50px;">
                        </div>
                        <?php if (isset($error)): ?>
                            <div class="alert alert-danger mt-3"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <div class="text-center" style="width: 90%; height: 80px;">
                            <input type="submit" value="Sign In" class="btn btn-success w-100" style="height: 50px;">
                            <input type="reset" value="Reset" class="btn btn-success w-100 mt-2" style="height: 50px;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


<?php include('admin_footer.php'); ?>


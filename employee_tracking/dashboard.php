<?php
session_start();
if (!isset($_SESSION['employee_id'])) {
    header("Location: login.html");
    exit();
}
?>
<?php include 'header.php'; ?>>

<div class="d-flex align-items-center justify-content-center" style="min-height: 55vh;">
    <div class="form-container">
        <h2>NGO EMPLOYEE</h2>
        <h3>Welcome, Employee ID: <?php echo htmlspecialchars($_SESSION['employee_id']); ?>!</h3>
        <p class="text-center">This is your dashboard.</p>
        <div class="text-center">
            <form action="logout.php" method="post">
                <input type="submit" value="Sign Out" class="btn btn-danger w-100">
            </form>
        </div>
    </div>
</div>




<?php include 'footer.php'; ?>


<?php include 'header.php'; ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 d-flex justify-content-center">
            <div class="form-container">
                <h2>NGO EMPLOYEE</h2>
                <h3>SIGN IN</h3>
                <form action="login.php" method="post">
                    <div class="mb-3">
                        <input type="text" name="id" class="form-control" placeholder="Enter ID">
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">
                    </div>
                    <div class="text-center">
                        <input type="submit" value="Sign In" class="btn btn-success w-100">
                        <input type="reset" value="Reset" class="btn btn-success w-100 mt-2">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<?php
include('../includes/db_connect.php');
include('../includes/functions.php');

//checkLogin();


extract($_POST);

if(isset($save))
{

if($email=="" || $password=="" )
	{
	$err="<font color='red'>fill all the fileds first</font>";	
	}
else{
mysqli_query($conn,"update admin set email='$email',password='$password' where id='".$_GET['id']."'");
$err="<font color='blue'> updated successfully </font>";
}
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $q=mysqli_query($conn,"select * from admin where id='".$_GET['id']."'");
    $res=mysqli_fetch_array($q);
}





   

?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h2>Edit Your Profile</h2>
    <form method="post" action="">
        <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
        
        <label>Email:</label><input type="email" name="email" value="<?php echo $res['email']; ?>" required><br>
        <label>Password:</label><input type="password" name="password" value="<?php echo $res['password']; ?>" required><br>
        <button type="submit" name="save">Update</button>
         <button type="reset" value="reset">Reset</button>

    </form>
</body>
</html>
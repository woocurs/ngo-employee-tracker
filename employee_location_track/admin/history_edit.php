<?php
include('../includes/db_connect.php');
include('../includes/functions.php');

//checkLogin();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM attendance WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $employee = $stmt->get_result()->fetch_assoc();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['employee_id'];
    $name = $_POST['name'];
    $action = $_POST['action'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $timestamp = $_POST['timestamp'];
   
    $stmt = $conn->prepare("UPDATE attendance SET id=?,name=?, action=?, latitude=?, longitude=?, timestamp=?, WHERE id=?");
    $stmt->bind_param("sssssssi", $id, $name, $action, $latitude, $longitude, $timestamp );

    if ($stmt->execute()) {
        header("Location: location_fetch.php");
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Employee</title>
    <link rel="stylesheet" href="../styles.css">
</head>
<body>
    <h2>Edit Location History</h2>
    <form method="post" action="">
        <input type="hidden" name="eid" value="<?php echo $attendance['id']; ?>">
<input type="number" name="id" value="<?php echo $attendance['employee_id']; ?>">
        <label>Name:</label><input type="text" name="name" value="<?php echo $employee['name']; ?>" required><br>
        <label>Email:</label><input type="email" name="email" value="<?php echo $employee['email']; ?>" required><br>
        <label>Gender:</label>
        <select name="gender">
            <option value="Male" <?php if ($employee['gender'] == 'Male') echo 'selected'; ?>>Male</option>
            <option value="Female" <?php if ($employee['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            <option value="Other" <?php if ($employee['gender'] == 'Other') echo 'selected'; ?>>Other</option>
        </select><br>
        <label>Department:</label><input type="text" name="department" value="<?php echo $employee['department']; ?>"><br>
        <label>Position:</label><input type="text" name="position" value="<?php echo $employee['position']; ?>"><br>
        <label>Salary:</label><input type="text" name="salary" value="<?php echo $employee['salary']; ?>"><br>
        <label>Join Date:</label><input type="date" name="join_date" value="<?php echo $employee['join_date']; ?>"><br>
        <button type="submit">Update</button>
    </form>
</body>
</html>
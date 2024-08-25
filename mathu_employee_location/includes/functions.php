<?php
session_start();

// Check if the user is logged in
function checkLogin() {
    if (!isset($_SESSION['employee_id'])) {
        header("Location: dashboard.php");
        exit();
    }
}
// Log the admin out
function Adlogout() {
    session_unset();
    session_destroy();
    header("Location:index.php");
}



// Log the user out
function logout() {
    session_unset();
    session_destroy();
    header("Location:../index.php");
}

// Redirect the user if already logged in
function redirectIfLoggedIn() {
    if (isset($_SESSION['employee_id'])) {
        header("Location: employee/dashboard.php");
        exit();
    }
}

// Encrypt passwords
function encryptPassword($password) {
    return password_hash($password, PASSWORD_BCRYPT);
}

// Verify passwords
function verifyPassword($password, $hashedPassword) {
    return password_verify($password, $hashedPassword);
}
?>
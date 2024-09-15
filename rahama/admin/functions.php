<?php
//include('../db_connect.php');


function get_logo_path($conn) {
    $result = $conn->query("SELECT logo_path, name FROM site_settings WHERE id = 1 LIMIT 1");
    $row = $result->fetch_assoc();
    return $row ? $row : ['logo_path' => null, 'name' => 'Your Company Name'];
}?>
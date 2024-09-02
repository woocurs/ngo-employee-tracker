<?php
//include('../db_connect.php');


function get_logo_path($conn) {
    $result = $conn->query("SELECT logo_path FROM site_settings ORDER BY id DESC LIMIT 1");
    $row = $result->fetch_assoc();
    return $row ? $row['logo_path'] : null;
}
?>

<?php
// Close the database connection
if (isset($conn) && $conn instanceof mysqli) {
    $conn->close();
}
?>

<footer>
    <div class="footer-content">
        <p>&copy; 2024 NGO Company. All rights reserved.</p>
        <p style="font-size: 12px">Emergency Contact: <a href="tel:+94123456789">+94 123 456 789</a></p>
    </div>
</footer>

</body>
</html>
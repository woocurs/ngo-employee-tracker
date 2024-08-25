<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar" align="right">
                      
  <br> <a href="dashboard.php" target="_blank" > <button class="logout-button">Home</button></a>
 <a href="logout.php" target="_blank" > <button class="logout-button">SignOut</button></a>
       


</nav>

    <div class="container">
        <div class="sidebar"><br><br><br>
            <button onclick="loadPage('profile')">Your Profile </button>
            <button onclick="loadPage('employees')">Employee Management</button>
            <button onclick="loadPage('locations')">Location History</button>
                    </div>
        <div class="content" id="content-area">
            <!-- Content will be loaded here dynamically -->
            <h2>Welcome to the Admin Dashboard</h2>
            <p>Select an option from the sidebar to view more details.</p>
        </div>
    </div>

   <script>
    function loadPage(page) {
        var xhr = new XMLHttpRequest(); // Create a new XMLHttpRequest object
        xhr.open('GET', 'load_page.php?page=' + page, true); // Prepare the GET request
        xhr.onreadystatechange = function () { // Define the callback function
            if (xhr.readyState == 3 && xhr.status == 200) { // Check if request is complete and successful
                document.getElementById('content-area').innerHTML = xhr.responseText; // Update the content area
            }
        };
        xhr.send(); // Send the request
    }
</script>
</body>
</html>
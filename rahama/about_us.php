<?php include('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Organization Employee Location Tracking System</title>
    <!-- Bootstrap CSS 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">-->
<style>
/* styles.css */
#g-img:hover {
    transform: scale(1.1); /* Slight zoom effect */
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.5); /* Adds shadow */
    border: 2px solid #ff0000; /* Red border on hover */
}
</style>

<script>
    document.getElementById('g-img').onclick = function() {
        this.style.border = '5px solid red'; // Changes border color to red when clicked
        this.style.width = '250px'; // Changes width to 250px
    }
</script>

</head>
<body style= color:white;" class="d-flex flex-column min-vh-100">
    
    <div class="container mt-5"> 
        <h1 class="text-center">About RAHAMA</h1>
        <p class="lead text-center">Non-profit Organization</p>

        <!-- Our Purpose Section -->
        <div class="row mt-5">
            <div class="col-md-6">
                <h3>Our Purpose</h3>
                <p>
                    The RAHAMA system is designed to help effectively manage their field staff. 
                    By providing real-time location updates, the system ensures that employees are where they need to be, when they need to be, which is crucial for project execution and transparency. Efficiently manage and track employee locations for better project oversight.
                </p><br><br>
<h3>Our History</h3>
                <p>
                   The Recovery and Humanitarian Action Management Agency (RAHAMA) was registered as an NGO in 2012 and took over part of the work that FORUT implemented in Sri Lanka till 2010. Initially, RAHAMA focused on recovery and development integrated with resettlement in the Northern Province. RAHAMA was funded by the Norwegian Embassy in Colombo and worked on shelter, water, sanitation, livelihoods, and securing land rights for around 3,000 internally displaced persons.
                </p>
            </div>
            <div class="col-md-6" style="margin-top:100px;">
                <img id="g-img" src="uploads/img/rahama.jpg" alt="RAHAMA img" class="img-fluid h-78 w-80 rounded shadow" style="width:auto;height:auto;border:2px solid green;">
            </div>
        </div>

        <!-- Our Vision Section -->
        <div class="row mt-4">
            <div class="col-md-6">
                <img id="g-img"  src="uploads/img/image.png"  alt="Our Team" class="img-fluid h-78 w-80 rounded shadow" >
            </div>
            <div class="col-md-6"><br>
                <h3>Our Vision</h3>
                
                <p>
                    A nation in peaceful coexistence with social justice, where poverty is overcome. All citizens are free to achieve their fullest potential and participate in civic life with dignity and security in a drug and alcohol-free society.
                </p>
           <br>

        <!-- Our Mission and History Section -->
        
                <h3>Our Mission</h3>
                <p style="margin-bottom:200px;">
                    Our mission is to improve respect for the rights of the population by improving livelihood assets of all deprived households through rights-based models, creating durable change through skills education, and advocacy.
                </p>
	 
                </div>
        </div>
                
        </div>
            

    <?php include('footer.php'); ?>
    <!-- Bootstrap JS
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
</body>
</html>
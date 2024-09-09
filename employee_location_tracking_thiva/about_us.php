<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>About Us</title>
    <style>
        body {
            background-color: #f4f4f4;
        }
        .content {
            margin-top: 90px;
        }
        .content img {
            max-width: 90%;
            height: auto;
            border-radius: 10px;
            margin-top: -40px;
        }
        h2 {
            color: #1d2630;
            font-family: 'Georgia', serif;
            text-align: center;
            font-size: 36px;
            margin-bottom: 20px;
        }
        .content p {
            font-family: 'Georgia', serif;
            font-size: 20px;
            color: rgb(211, 211, 211);
            margin-top: -40px;
        }
    </style>
</head>
<body>
    <?php include 'header.php'; ?>
    
    <div class="container content">
        <h2>About to RAHAMA</h2>
        <br>
        <div class="row">
            <div class="col-md-6">
                <!-- Replace with your image -->
                <img src="image.png" alt="Image">
            </div>
            <div class="col-md-6 d-flex align-items-center">
        <br>
        
                    <p>
                    <b>Vision</b>
                    <br>
                    A nation in peaceful coexistence with social justice, with poverty overcome, where all citizens are free to achieve their fullest potential and participate in civic life with dignity and security in a drug and alcohol-free society..
                    <br>
                    <br>
                    <b>Mission</b>
                    <br>
                    The mission of The RAHAMA is to improve respect for the rights of the population by improving livelihood assets of all deprived households through rights-based models by creating durable change through skills education, and advocacy..
                    <br>
                    <br>
                    <b>Our history</b>
                    <br>
                    The Recovery and Humanitarian Action Management Agency (RAHAMA) was registered as an NGO in 2012 and took on a part of the work that FORUT implemented in Sri Lanka till 2010. RAHAMA initially concentrated its efforts in the Northern Province and recovery and development were integrated with resettlement. At the beginning, RAHAMA was funded by the Norwegian Embassy in Colombo and focused on shelter, water, sanitation, livelihoods and securing land rights for about 3,000 affected internally displaced persons. 
                    </p>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>
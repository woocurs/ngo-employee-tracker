<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Home Page</title>
    <style>
        body {
            background-color: #f4f4f4;
		display:block;
        }
        .content {
            margin-top:0px;
        }
        .content img {
            max-width: 90%;
            height: auto;
            border-radius: 10px;
            margin-top: -50px;
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
    
    <div class="container content mt-0" >
        <h2><br>Welcome to Rahama</h2><br>
        <div class="row  ">
            <div class="col-md-6">
                <!-- Replace with your image -->
                <img src="uploads/img/image.png" alt="Image">
            </div>
            <div class="col-md-6 d-flex align-items-center  ">
                <br>
                <br>
                <p>
                   <br> FORUT Norway, a leading Humanitarian Action agency, decided to discontinue its direct implementation in 2010 after a long duration of services in Sri Lanka. One of the imperative reasons for the said withdrawal was to empower partner institutions to link with other prospects too while operating as autonomous entities. Secondly, since the Sri Lankan population had entered into a new epoch under the post-war era, local capacities could be utilized to implement projects on humanitarian action.
                </p>
            </div>
        </div>

    </div>
    <?php include 'footer.php'; ?>
</body>

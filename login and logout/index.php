<?php
//session_start();

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Welcome || NotesDuniya</title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <!--Self Defined CSS-->
        <link rel="stylesheet" href="style.css" type="text/css">
        <style type="text/css">
            #banner_content {
              border-radius: 20px;
              background-color: rgba(0, 0, 0, 0.8);
              margin-top: 200px;
                }
                #banner_image {
            height:701px;
            text-align: center;
            color: #f8f8f8;
            background: url("images/banner3.jpg") no-repeat center center;
            background-size: cover;
        }
         @media only screen and (max-width: 360px) {
            
            #banner_image {
            height:620px;
        }
        </style>
    </head>

    <body>
        <!--Header-->
        <?php include 'resource/header_2.php'; ?>
         <!--end of Header-->
         
         <!--Main Content-->
        <div id="content">
            <div id = "banner_image">
                <div class="container">	
                    <center>
                        <div id="banner_content">
                            <h2 style="color:white">Access Engineering Notes for Free</h2>
                            <br/>
                            <a  href="signup.php" class="btn btn-warning btn-lg active">Get Today</a>
                        </div>
                    </center>
                </div>
            </div>
        </div>
        <!--Main Content end-->

        <!--Footer-->
        <?php include 'resource/footer.php'?>
        <!--Footer end-->

        <!--jQuery library--> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!--Latest compiled and minified JavaScript--> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    </body> 
</html>
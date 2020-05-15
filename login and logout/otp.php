<?php
session_start();
if (strlen($_SESSION['Email']) == 0) {
  header('location:logout.php');
  }
$email = $_SESSION['Email'];
//echo $email;
$status = $_SESSION['status'] ;
//Connection to database
include 'resource/connection.php';
if (isset($_POST['otp'])){
    $otp = mysqli_real_escape_string($con, $_POST['otp_name']);
    $select_query = "select * from signup where Email = '$email' ";
    $result = mysqli_query($con, $select_query) or die(mysqli_error($con));
    $row = mysqli_fetch_array($result);
    $otp1 = $row['code'];
    if ($otp == $otp1){
        $status = 'Verified';
        $update_name_query = "UPDATE signup SET status = '$status' WHERE Email = '$email'";
        $update_name_result = mysqli_query($con, $update_name_query) or die(mysqli_error($con));
        $_SESSION['status'] = $status ;
        header("location:home.php");
    }else{
        echo "<script>alert('Registration Failed')</script>";
        $sql = " DELETE FROM `signup` WHERE Email = '$email' ";
        $result_1 = mysqli_query($con, $sql) or die(mysqli_error($con));

        header("location:signup.php");

    }

}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>OTP Verification</title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <!--style.css-->
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
     <style type="text/css">
        #banner_image1 {
            height:701px;
            
            color: #f8f8f8;
            background: url("images/banner6.jpg") no-repeat center center;
            background-size: cover;
        }
        .padding{
            padding-top: 60px;
        }
        #banner_content{
            border-radius: 10px;
            position: ;
            margin: 0%;
            margin-left: 30%;
            margin-top: 10%;
            padding : 0%;
            padding-left : 2%;
             padding-right : 2%;
             padding-bottom : 2%;
            padding: none;
            background: url("images/banner7.jpg") no-repeat center center; 
            background-size: cover;
            background-color: rgba(0, 0, 0, 0.7);
            max-width:600px;
        }

        @media only screen and (max-width: 360px) {
            .padding_button{
                margin-left: 100px;
            }
            .sign{
                margin-bottom: 60px;
            }#banner_content{
                border-radius: 10px;
                position: relative;
                margin: 0%;
                margin-left: 0%;
                margin-top: 100px;
                padding : 2%;
                
                padding: none;
                background-color: rgba(0, 0, 0, 0.6);
                max-width:600px;
            }
            #banner_image1 {
            height:600px;
        }


        }
    </style>

    <body >

        <!-- Header -->
        <?php include 'resource/header_3.php'; ?>
        <!--Header end-->

        

        <!--signup form-->
        <div >
            <div id = "banner_image1">
                <div >
        <div class="container-fluid " >
            <div class="row">
                <div class="container ">
                    <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3" id="banner_content">
                        <div>
                            <center><h2 ><span class="glyphicon glyphicon-user"></span> OTP Verification</h2></center>
                            <form  action="otp.php" method="POST"><hr>
                                
                                <div class="form-group">
                                    <label for="firstname">Email</label>
                                    <input type="email" class="form-control"  value="<?php echo $email ?>" name="Email" readonly>
                                </div>
                                
                                <div class="form-group">
                                    <label for="firstname" class="paddings">OTP</label>
                                    <input type="number" class="form-control"  placeholder="OTP" maxlength="6" name="otp_name"  required>
                                </div>
                                <br><br>
                                <button type="submit" name="otp" class="btn btn-primary padding_button"><span class="glyphicon glyphicon-user"></span> Verify</button>
                                    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div></div></div>
        <!--signup form-->


        <!--Footer-->
        <?php include 'resource/footer.php'?>
        <!--Footer end-->

        <!--jQuery library--> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!--Latest compiled and minified JavaScript--> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


    </body> 
</html>
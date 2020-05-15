<?php 

session_start();
$em = $_SESSION['Email'];
// if anyone opens directly this page it transfer to you at logout.php
if (strlen($_SESSION['Email']) == 0) {
  header('location:logout.php');
  } 
include 'resource/connection.php';
if (isset($_POST['pass'])){
        $pass_1 = md5($_POST['pass_1']);
        $pass_2 = $_POST['pass_2'];
        $pass_3 = $_POST['pass_3'];

        if (($pass_2 != $pass_3) and (strlen($pass_2) != strlen($pass_3)) ){
            echo "<script>alert('Confirm Password did not match')</script>";
        }
        else{

        $select_query = "select * from signup where Password = '$pass_1' AND Email = '$em'";
        //echo $select_query;
        $result = mysqli_query($con, $select_query) or die(mysqli_error($con));
        $data = mysqli_fetch_assoc($result);
        $pass = $data['Password'];
        if ($pass == $pass_1){
            $pass_encrypted = md5($_POST['pass_2']);
            $update_name_query = "UPDATE signup SET Password = '$pass_encrypted' WHERE Email = '$em'";
            $update_name_result = mysqli_query($con, $update_name_query) or die(mysqli_error($con));
            echo "<script>alert('password changed')</script>";

            
        }
        else{
            echo "<script>alert('Old Password did not match')</script>";}
        }
        //echo "<script>alert('You are logged out')</script>";
        //echo ("<script>location.href='logout.php'</script>");

}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Change Password</title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <!--SelfDefine CSS-->
        <link rel="stylesheet" href="style.css" type="text/css" >
    </head>
    <style type="text/css">
         #banner_image1 {
            height:651px;
            
            color: #f8f8f8;
            background: url("images/banner10.jpg") no-repeat center center;
            background-size: cover;
        }
        @media screen and (max-width: 360px) {
            #banner_image1 {
            height:565px;
            
            color: #f8f8f8;
            background: url("images/banner10.jpg") no-repeat center center;
            background-size: cover;
        }
              body {
            font-size: 15px;
            
            }
    </style>
    <body style="padding-top: 50px;">
        <!-- Header -->
        <?php include 'resource/header.php' ;?>
        <!--Header End-->

        <!--Changepasswor content -->
            <div id = "banner_image1">
        <div class="row">
            <div class="container_fluid ">
                <div class="col-lg-4 col-xs-10 col-xs-offset-1 col-lg-offset-4 col-md-6 col-md-offset-2">
                    <h2 class="padding"><span class="glyphicon glyphicon-cog"></span> Change Password</h2>
                    <form  action="changepassword.php" method="POST">
                        <div class="form-group">
                            <label for="password" >Old Password</label>
                            <input class="form-control" placeholder="Old Password" type="password" name="pass_1" pattern=".{6,}"   required>
                        </div>
                        <div class="form-group">
                            <label for="password" >New Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="pass_2" pattern=".{6,}" required>
                        </div>
                        <div class="form-group">
                            <label for="password" >Confirm New Password</label>
                            <input type="password" class="form-control" placeholder="Password" name="pass_3" pattern=".{6,}" required>
                        </div>
                        <br><br>
                        <button type="submit" name="pass" class="btn btn-block btn-primary "><span class="glyphicon glyphicon-log-in"></span> Change</button>
                    </form>
                </div>
            </div>
        </div></div>
        <!--Change password content -->
        
        <!--Footer-->
        <?php include 'resource/footer.php'?>
        <!--Footer end-->


        <!--jQuery library--> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!--Latest compiled and minified JavaScript--> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



    </body> 
</html>
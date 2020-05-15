<?php
session_start();
//logged_in_redirect();
include 'mailfunction.php';
date_default_timezone_set("Asia/Kolkata");
//echo "fsdfs".date("Y-m-d h:i:sa")."hvj";

//Connection to database
include 'resource/connection.php';
if (isset($_POST['signup'])){
    $sql = " DELETE FROM `signup` WHERE status = 'Not Verified' ";
        $result_1 = mysqli_query($con, $sql) or die(mysqli_error($con));
    //Register user
    $name = mysqli_real_escape_string($con, $_POST['Name']);
    $email = mysqli_real_escape_string($con, $_POST['Email']);
    //Email Validation ==> We already validate it by using html
    $password = mysqli_real_escape_string($con, $_POST['Password']);
    //Check Length of password if it is greater than or equal to 6 then it validates 
    if (strlen($password) >= 6){
        //for only numeric in contact 
        $contact = $_POST['Contact'];
        if (is_numeric($contact)) {
            //Check for the existing user with help of databse
            $select_query = "select * from signup where Email = '$email' or Contact = '$contact' ";
            $result = mysqli_query($con, $select_query) or die(mysqli_error($con));
            $user = mysqli_fetch_assoc($result);
            if ($user){
                if($user['Email']===$email){
                    echo "<script>alert('Email Address Alredy Exist')</script>";
                } 
                if($user['Contact']===$contact){
                    echo "<script>alert('Contact Alredy Exist')</script>";
                }
            }
            //register the user if there is no error
           
            else{
                $date = date('Y-m-d h:i:sa');
                $status="Not Verified";
                $code=rand(100000,999999);
                $pass = md5($_POST['Password']) ;//Enctrypted password
                $user_registration_query = "insert into signup (Name, Email, Password, Contact,status,code,date) values ('$name', '$email', '$pass', '$contact','$status','$code','$date') ";
                $user_registration_submit = mysqli_query($con, $user_registration_query) or die(mysqli_error($con));
                //echo "<script>alert('User Succesfully Registered')</script>";
                //$_SESSION['Email'] = $email;
                //header('location:home.php');
                
                    if(isset($user_registration_submit)){
                        $mail_status = sendOTP($_POST['Email'],$code);
                        //echo $mail_status;
                        $_SESSION['Email'] = $email;
                        $_SESSION['status'] = $status;
                        header("location:otp.php");
                        }
                        else
                        {
                        echo "<script>alert('Data not inserted');</script>";
                        }
                                             

                                    }
                                    } 
                                    else{
                                    echo "<script>alert('Wrong Mobile Number')</script>";
                                    }
                                

                                }else{
                                echo "<script>alert('Minimum 6 Digits required')</script>";
                            }

    
}    

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sign Up</title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <!--style.css-->
        <link rel="stylesheet" href="style.css" type="text/css">
    </head>
     <style type="text/css">
    
        #banner_image1 {
            height:701px;
            
            color: #f8f8f8;
            background: url("images/banner3.jpg") no-repeat center center;
            background-size: cover;
        }
        .padding{
            padding-top: 5px;
        }
        #banner_content{
            border-radius: 10px;
            position:relative ;
            margin: 0%;
            margin-left: 30%;
            margin-top: 10%;
            padding : 1%;
            padding-left : 1%;
            padding-right : 1%;
            
            background-color: rgba(0, 0, 0, 0.7);
            max-width:600px;
        }

        
         @media only screen and (max-width: 768px) {
            #banner_content{
            
            position:relative ;
            margin: 0%;
            margin-left: 20%;
            margin-top: 5%;
            padding : 1%;
            padding-left : 1%;
            padding-right : 1%;
            padding: none;
            background-color: rgba(0, 0, 0, 0.7);
            max-width:400px;
        }


            }
        @media only screen and (max-width: 1198px) {
            .padding_button{
                margin-left: 60px;

            
        }
        }
        @media only screen and (max-width: 448px) {
            .padding_button{
                margin-top: 0px;
                margin-left: 80px;
                margin-bottom: 2px;

            }
            body{
                margin-top: 50px;
            }
            #banner_content{
                margin-left: 6%;
                
                
            }
            .padding{

                padding: 5%;
                margin: 0%;
            }#banner_image1 {
            height:650px;
            
            
        }
        }
    </style>

    <body >

        <!-- Header -->
        <?php include 'resource/header_2.php'; ?>
        <!--Header end-->

        

        <!--signup form-->
        <div >
            <div >
                <div id = "banner_image1">
        <div class="container ">
            <div class="row">
                <div class="container" >
                    <div class="col-lg-4  col-sm-5 col-md-4" id="banner_content">
                        <div>
                            <center><h2 class="padding"><span class="glyphicon glyphicon-user"></span> SIGN UP</h2></center>
                            <form  action="signup.php" method="POST"><hr>
                                <div class="form-group">
                                    <label for="name" >Name</label>
                                    <input class="form-control" placeholder="Name" name="Name"  required>
                                </div>
                                <div class="form-group">
                                    <label for="firstname" class="paddings">Email</label>
                                    <input type="email" class="form-control"  placeholder="Email"  name="Email" required>
                                </div>
                                <div class="form-group">
                                    <label for="firstname" class="paddings">Password</label>
                                    <input type="password" class="form-control" placeholder="Password(at least contain 6 digit)"  name="Password" required>
                                </div>
                                <div class="form-group">
                                    <label for="firstname" class="paddings">Contact</label>
                                    <input type="tel" class="form-control"  placeholder="Contact" minlength="10" maxlength="10" size="10" name="Contact"  required>
                                </div>
                                <br><br>
                                <button type="submit" name="signup" class="btn btn-primary padding_button"><span class="glyphicon glyphicon-user"></span> Sign Up</button>
                                    
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
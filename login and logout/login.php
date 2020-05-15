<?php
session_start();
//sttusj

//Connection to database
include 'resource/connection.php';
//if login button is pressed or set
if (isset($_POST['login'])){
        $date = date('Y-m-d h:i:sa');
        
    // takes all data from form
        $email = $_POST['email'];
        $password = ($_POST['password']);
        //Escaping from special characters
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = md5($_POST['password']);
        //use select query to select the data form the database.
        $select_query = "select * from signup where Email = '$email' AND Password = '$password'";
        $result = mysqli_query($con, $select_query) or die(mysqli_error($con));
        $total_rows_fetched = mysqli_num_rows($result);

         $date = date('Y-m-d h:i:sa');
        $user_registration_query = "insert into login (email, date) values ('$email','$date') ";
        $user_registration_submit = mysqli_query($con, $user_registration_query) or die(mysqli_error($con));
        //If row fetched is equalto one means email id is registerd then login it
        if ($total_rows_fetched == 1){
            $_SESSION['Email'] = $email; 
            $select_query_1 = "select * from signup where Email = '$email' and status = 'Verified'";
            $result_query = mysqli_query($con, $select_query_1) or die(mysqli_error($con));
            $total_rows_fetched_1 = mysqli_num_rows($result_query);
            //echo $total_rows_fetched_1;
            //$row = mysqli_fetch_array($result_query);
            $select_query_2 = "select * from studentform where Email = '$email' ";
            $result_query_2 = mysqli_query($con, $select_query_2) or die(mysqli_error($con));
            $total_rows_fetched_2 = mysqli_num_rows($result_query_2);
            $row = mysqli_fetch_array($result_query_2);
            $sem=$row['sem'];
            
            
                
            if (($total_rows_fetched_1 != 0) and ($total_rows_fetched_2 !=0)){
                //echo "<script>alert('Login Successfull')</script>";
                $_SESSION['Email'] = $email;
                $_SESSION['sem'] = $sem;
                //$status = 'yes';
                //$date = date('Y-m-d h:i:sa');
                //$user_registration_query = "insert into login (email, date,status,sem) values ('$email','$date','$status','$sem') ";
                //$user_registration_submit = mysqli_query($con, $user_registration_query) or die(mysqli_error($con));
                    header('location:home2.php');
                }elseif($total_rows_fetched_1 !=0 ){
                    $_SESSION['Email'] = $email;
                    $sem = 'no';
                    $status = 'yes';
                    $date = date('Y-m-d h:i:sa');
                //$user_registration_query = "insert into login (email, date,status,sem) values ('$email','$date','$status','$sem' ) ";
                //$user_registration_submit = mysqli_query($con, $user_registration_query) or die(mysqli_error($con));
                    //$_SESSION['sem'] = $sem;
                    header('location:home.php');
                }else{
                     
                
                echo "<script>alert('Login Failed')</script>";
                echo ("<script>location.href='login1.php'</script>");
            }

}


                    
        }

 // Sign Up in Login page
    if (isset($_POST['signup_login'])){
        header('location:signup.php');
       
        }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Login</title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <!--Style.Css-->
        <link rel="stylesheet" href="style.css" type="text/css">
         
    </head>
    <style type="text/css">
        .padding{
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .padding_button{
            margin-left: 240px;
            padding-left: 20px;
            padding-right: 20px;

        }

        #banner_image1 {
            height:701px;
            text-align: left;
            color: #f8f8f8;
            background: url("images/banner5.png") no-repeat center center;
            background-size: cover;
        }
        #banner_content{
            border-radius: 10px;
            position: relative ;
            margin: 0%;
            margin-left: 30%;
            margin-top: 10%;
            padding : 0%;
            padding-left : 2%;
             padding-right : 2%;
             padding-bottom : 2%;
            padding: none;
            background-color: rgba(0, 0, 0, 0.7);
            max-width:600px;
        }
        @media only screen and (max-width: 987px) {
            #banner_image1 {
            height:590px;}
            #banner_content{
            
            position:relative ;
            margin: 0%;
            margin-left: 15%;
            margin-top: 10%;
            padding : 1%;
            padding-left : 1%;
            padding-right : 1%;
            padding: none;
            background-color: rgba(0, 0, 0, 0.7);
            max-width:400px;
        }
         @media only screen and (max-width: 768px) {
            #banner_content{
            
            position:relative ;
            margin: 0%;
            margin-left: 20%;
            margin-top: 10%;
            padding : 1%;
            padding-left : 1%;
            padding-right : 1%;
            padding: none;
            background-color: rgba(0, 0, 0, 0.7);
            max-width:400px;
        }
        @media only screen and (max-width: 611px) {
            #banner_content{
            
            position:relative ;
            margin: 0%;
            margin-left: 10%;
            margin-top: 10%;
            padding : 1%;
            padding-left : 1%;
            padding-right : 1%;
            padding: none;
            background-color: rgba(0, 0, 0, 0.7);
            max-width:400px;
        }
        @media only screen and (max-width: 414px) {
            #banner_image1 {
            height:800px;}
            #banner_content{
            
            position:relative ;
            margin: 0%;
            margin-left: 5%;
            margin-top: 20%;
            padding : 3%;
            padding-left : 3%;
            padding-right : 3%;
            padding: none;
            background-color: rgba(0, 0, 0, 0.7);
            max-width:400px;
        }


        @media only screen and (max-width: 386px) {
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
                margin-top: 25%;
                padding : 0%;
                padding-left : 2%;
                 padding-right : 2%;
                 padding-bottom : 2%;
                padding: none;
                background-color: rgba(0, 0, 0, 0.6);
                max-width:600px;
            }
            #banner_image1 {
            height:570px;
        }


        }
    </style>

    <body>
        <!-- Header -->
        <?php include 'resource/header_2.php'; ?>
        <!--Header End-->

        <br>

        <!--Login Form-->
        <div>
            <div id = "banner_image1">
                <div >
        <div class="container-fluid decor_bg " >
            <div class="row">
                <div class="container " >
                    <div class="col-lg-4 col-lg-offset-4 col-md-6 col-md-offset-3" id="banner_content">
                        <h2 class="padding"><span class="glyphicon glyphicon-log-in"></span> LOGIN</h2>
                        <form  action="login.php" method="POST" >
                            <div class="form-group">
                                <label for="email" >Email-Id</label>
                                <input class="form-control" placeholder="Email-id" type="email" name="email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"  required>
                            </div>
                        
                            <div class="form-group">
                                <label for="password" class="paddings">Password</label>
                                <input type="password" class="form-control" placeholder="Password" name="password" pattern=".{6,}" required>
                                
                            </div>
                            <br><br>
                            <button type="submit" name="login" class="btn btn-primary padding_button"><span class="glyphicon glyphicon-log-in"></span> Login</button>
                        </form>
                 
                        <br><br>

                        <center>
                        <form  action="login.php" method="POST">
                            <p>Don't Have an Account?Register</p>
                            <button type="submit" class="btn btn-primary" name="signup_login"><span class="glyphicon glyphicon-user"></span> SignUp</button>
                        </form>
                        
                        
                        </center>


                    </div>
                </div>
            </div>
        </div></div></div></div>
        
        
        <!-- End of Login Form-->
                           
        <!--Footer-->
        <?php include 'resource/footer.php'?>

        <!--Footer end-->

        <!--jQuery library--> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

        <!--Latest compiled and minified JavaScript--> 
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>
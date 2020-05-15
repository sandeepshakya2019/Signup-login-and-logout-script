<?php 
session_start();
$email = $_SESSION['Email'];
//$status = $_SESSION['status'] ;
// if anyone opens the page direcly the it send to logout.php
if (strlen($_SESSION['Email']) == 0) {
  header('location:logout.php');
  } 

//if button whose name is create is pressed then it takes to createnewplan.php page

include 'resource/connection.php';

function emailfetch($con, $email) {
    global $email;
    $select_query = "SELECT name, Email, contact FROM signup where Email = '$email' ";
    $select_query_result = mysqli_query($con, $select_query) or die(mysqli_error($con));
    $row = mysqli_fetch_array($select_query_result);
    echo $row['Email'];
}
if (isset($_POST['fillup'])){
    $email = $_SESSION['Email'];
    $class = mysqli_real_escape_string($con, $_POST['class']);
    $sem = mysqli_real_escape_string($con, $_POST['choose']);
    $branch = mysqli_real_escape_string($con, $_POST['branch']);
    
    function semfetch($con, $email,$sem) {
        global $email;
        global $sem;
        $select_query = "SELECT email, class, sem FROM studentform where email = '$email' and sem = '$sem' ";
        $select_query_result = mysqli_query($con, $select_query) or die(mysqli_error($con));
        $row = mysqli_fetch_array($select_query_result);
        return $row['sem'];
    }
    if ((semfetch($con,$email,$sem)) == $sem){
        echo "<script>alert('Sem Already Fill')</script>";
        echo ("<script>location.href='home2.php'</script>");
    }
    else{
        semfetch($con,$email,$sem);
    $student_added_query = "insert into studentform (email, class,branch, sem) values ('$email', '$class', '$branch', '$sem')";
    $student_added_submit = mysqli_query($con, $student_added_query) or die(mysqli_error($con));

    $_SESSION['Email'] = $email;
    $_SESSION['sem'] = $sem;
    $_SESSION['branch'] = $branch;

    header('location:home2.php');
}
}

?>
<?php if(strlen($_SESSION['Email']) != 0) { ?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Home</title>
        <!-- Bootstrap Core CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <link rel="stylesheet" href="style.css" type="text/css">
        <style type="text/css">
        @media only screen and (max-width: 360px) {
            .padding_button{
                margin-left: 100px;

            }
            
   


        }
        </style>
    </head>

    <body style="padding-top: 40px;" onload="noBack();" 
    onpageshow="if (event.persisted) noBack();" onunload="">
        <!-- Header -->
        <?php include 'resource/header.php'; ?>
        <!--Header End--> 

        <!--Home Page content -->
        
            <div >
            <div id = "banner_image1">
                <div >
        <div class="container-fluid  " id="content">
            <div class="row">
                <div class="container ">
                    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4" >
                        <div>
                            <center><h2 class="padding"><span class="glyphicon glyphicon-user"></span> Your Details</h2></center>
                            <form  action="home.php" method="POST"><hr>
                                
                                <div class="form-group">
                                    <label for="firstname" >Email</label>
                                    <input type="email" class="form-control"  value='<?php emailfetch($con,$email)?>' name='email' readonly>
                                </div>
                                <div class="form-group">
                                    <label for="firstname" >Class</label>
                                    <input type="class" class="form-control" value="B.Tech"  name="class" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="firstname" >Branch</label>
                                    <input type="class" class="form-control" value="Electronics & Communication"  name="branch" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="firstname" >Sem</label>
                                    <select class="form-control" id="inlineFormCustomSelectPref" name="choose" required>
                                    <option value="First">Choose</option>
                                    <option value="First">First</option>
                                    <option value="Second">Second</option>
                                    <option value="Third">Third</option>
                                    <option value="Fourth">Fourth</option>
                                    
                                </select>
                                </div>
                                <br><br>
                                <button type="submit" name="fillup" class="btn btn-primary padding_button"><span class="glyphicon glyphicon-user"></span> Fill up</button>
                                    
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div></div></div>


        
        <!--end of Home Page content -->

            <!--Footer-->
            <?php include"resource/footer.php"?>
            <!--Footer end-->

            <!--jQuery library--> 
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

            <!--Latest compiled and minified JavaScript--> 
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

           

    </body> 
</html>
<?php } else { 
    echo "<script>alert('You are Logged out')</script>";
    echo ("<script>location.href='login.php'</script>");
}
?>

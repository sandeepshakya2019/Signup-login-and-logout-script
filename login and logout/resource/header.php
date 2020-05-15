<?php

 
if(isset($_GET['id']))
{
   //include 'donate1.php';

  //include 'resource/connection.php';

    
      
    $ema = $_SESSION['Email'];
    date_default_timezone_set("Asia/Kolkata");
    $date1 = date('Y-m-d h:i:sa');
    //$donate = donate_open1($_SESSION['Email']);
    $user_registration_query = "insert into donation (email, status, money, open, date) values ('$ema', 'no', '0', 'yes','$date1') ";
    $user_registration_submit = mysqli_query($con, $user_registration_query) or die(mysqli_error($con));
   // header('location:donate.php')
}

?>

<div class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>                        
                    </button>
                    <?php if ((isset($_SESSION['sem'])) == False)  { ?>
                        <a class="navbar-brand" href="home.php">NotesDuniya</a>
                    <?php } elseif (isset($_SESSION['sem'])) { ?>
                        <a class="navbar-brand" href="home2.php">NotesDuniya</a>
                    
                    <?php }?>
                        
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav navbar-right">

                            <?php if (isset($_SESSION['Email'])) { ?>
                            
                            <li><a href="changepassword.php"><span class="glyphicon glyphicon-cog"></span> Change Password</a></li>
                            <li><a> <span class="glyphicon glyphicon-user"></span><?php echo $_SESSION['Email']." " ?></a></li>
                            
                            <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> LogOut</a></li>
                            <?php } else{ ?>

                            
                            <li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                            <?php } ?>
                        
                    </ul>
                </div>
            </div>
        </div>



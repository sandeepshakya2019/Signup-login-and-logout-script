
<?php 
    session_start();
    echo "<script>alert('You are logged out')</script>";
    
    session_unset();
    session_destroy();
    echo ("<script>location.href='login.php'</script>");
  ?>

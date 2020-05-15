<?php 
use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\Exception;
  include 'resource/connection.php';
    function sendOTP($email,$otp){
	
	require 'PHPMailer-master/src/Exception.php';
	require 'PHPMailer-master/src/PHPMailer.php';
	require 'PHPMailer-master/src/SMTP.php';
	//require 'vendor/autoload.php'; 
	  
	$mail = new PHPMailer(true); 
	  
	
	    $mail->SMTPDebug = 0;                                        
	    $mail->isSMTP();                                             
	    $mail->Host       = 'smtp.gmail.com;';                     
	    $mail->SMTPAuth   = true;                              
	    $mail->Username   = 'sandeepshakya135@gmail.com';                  
	    $mail->Password   = 'Avsirphysics';                         
	    $mail->SMTPSecure = 'tls';                               
	    $mail->Port       = 587;   
	  
	    $mail->setFrom('sandeepshakya135@gmail.com');            
	    $mail->addAddress($email); 
	    //$mail->addAddress('receiver2@gfg.com', 'Name'); 
	       
	    $mail->isHTML(true);                                   
	    $mail->Subject = 'OTP Verification'; 
	    $mail->Body    = '<h1 style = "color:orange">Welcome || To NotesDuniya</h1><br><h3>Now You are the Registered User of <b><i>NotesDuniya</i></b><br><br>Your Email-Id is : '.$email.'<br><br>Your OTP is - '.$otp.'<br><br><br>If you have any <i>Feedback</i> then send us at <b><i>sandeepshakya135@gmail.com</i></b>'; 
	    //$mail->AltBody = 'Body in plain text for non-HTML mail clients'; 
	    $mail->send();
	}
	  
	    
	?> 
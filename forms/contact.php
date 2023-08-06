<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
require('PHPMailer.php');
require('SMTP.php');
require('Exception.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if(isset($_POST['name'])){
  $mail = new PHPMailer(true);
  try {
    //Server settings
    $mail->isSMTP();
    $mail->CharSet = 'UTF-8';
    $mail->SMTPDebug = 0;                                           //Enable verbose debug output
    //Send using SMTP
    $mail->Host       = 'smtp.hostinger.com';                       //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                       //Enable SMTP authentication
    $mail->Username   = '';                          //SMTP username
    $mail->Password   = '';                               //SMTP password
    $mail->SMTPSecure = 'ssl';                                      //Enable implicit TLS encryption
    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('noreply@aerobotix.in', 'Aerobotix Tech Solutions');
    $mail->addAddress('info@aerobotix.in');     //Add a recipient    
    $mail->addReplyTo('info@aerobotix.in', 'Aerobotix Tech Solutions');   
   
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Contact from ". $_POST['name'];
    $mail->Body    = 'Subject : '.$_POST['subject'].'<br>'.
                      'Email : '.$_POST['email'].'<br>'.
                      'Message : '.$_POST['message'];
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
    if (!$mail->Send()) {
        echo "Mail is not sent please try again!!!";
    } else {
        echo "OK";
    }

    //Send thank you to user
    //Recipients
    $mail1 = new PHPMailer(true);
    $mail1->isSMTP();
    $mail1->CharSet = 'UTF-8';
    $mail1->SMTPDebug = 0;                                           //Enable verbose debug output
    //Send using SMTP
    $mail1->Host       = 'smtp.hostinger.com';                       //Set the SMTP server to send through
    $mail1->SMTPAuth   = true;                                       //Enable SMTP authentication
    $mail1->Username   = '';                          //SMTP username
    $mail1->Password   = '';                               //SMTP password
    $mail1->SMTPSecure = 'ssl';                                      //Enable implicit TLS encryption
    $mail1->Port       = 465;

    $mail1->setFrom('noreply@aerobotix.in', 'Aerobotix Tech Solutions');
    $mail1->addAddress($_POST['email']);     //Add a recipient    
    $mail1->addReplyTo('info@aerobotix.in', 'Aerobotix Tech Solutions');   
   
    //Content
    $mail1->isHTML(true);                                  //Set email format to HTML
    $mail1->Subject = "Thank you for contact Aerobotix Tech Solutions";
    $mail1->Body    = 'Hello '.$_POST['name'].',<br>'.
     'Thank you for reaching out to us. We appreciate your interest in our company and are happy to help answer any questions you may have. We will respond to your inquiry as soon as possible. Thank you again for your interest, and we look forward to hearing from you soon. '.
     '<br><br> Regards <br><br> Aerobotix Tech Solutions';
    
    if (!$mail1->Send()) {
        // echo "Mail is not sent please try again!!!";
    } else {
        // echo "OK";
    }

} catch (Exception $e) {
    // echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}

<?php

require_once('phpmailer/Exception.php'); //retrieving packages
require_once('phpmailer/PHPMailer.php'); 
require_once('phpmailer/SMTP.php'); 

 $MAIL = new PHPMailer(TRUE);

$to = array('admin@domain.com'); //address where emails should be send
$subject = "New Membership Application"; //subject line
$content = file_get_contents("php://input"); //content received from the client

try {
   $MAIL->setFrom('emailer@domain.com', 'Sender name');
   $MAIL->CharSet = 'utf-8';

   if (count($to)>=2) {
       $MAIL->addAddress($to[0]);
       $MAIL->addCC($to[1]);                	
   }  
   else 
   { 
       $MAIL->addAddress($to[0]); 
   }
   
   $MAIL->Subject = $subject;

   $MAIL->isHTML(TRUE);
   $MAIL->Body = $content;
   

   
   $MAIL->isSMTP(); //initializing SMTP 
   
   /* SMTP server */
   $MAIL->Host = 'smtp-1234.example.domain.com';

   $MAIL->SMTPAuth = TRUE;
   
   
   
   /* SMTP username */
   $MAIL->Username = 'sender@domain.com';
   
   /* SMTP password */
   $MAIL->Password = 'yourpassword';
   
   /* SMTP port */
   $MAIL->Port = 587;
   $result = $MAIL->send();
   unset($MAIL);	
}
catch (Exception $e)
{
   echo $e->errorMessage();
}
catch (\Exception $e)
{
   
   echo $e->getMessage();
}

?>
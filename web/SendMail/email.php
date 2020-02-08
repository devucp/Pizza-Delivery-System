<?php
/* 1. Install Composer in the pc (It will set the path variable automatically)
   2. Now in command prompt make your website as your current directory
   3. type composer require phpmailer/phpmailer command (will install this library)
   4. Write the below code to send an email
 */

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//Load composer's autoloader
require 'vendor/autoload.php';
$name= $_GET['name'];
$email= $_GET['email'];
$db = new mysqli("127.0.0.1", "root", "", "yummypizza");
$res = mysqli_query($db, "SELECT email from login");

	$mail = new PHPMailer(true);                              // Passing `true` enables exceptions
	try {
		//Server settings
		//$mail->SMTPDebug = 2;                                 // Enable verbose debug output
		$mail->isSMTP();                                      // Set mailer to use SMTP
		
	  // Set parameters for SMTP  
	$mail->SMTPOptions = array(
	'ssl' => array(
	'verify_peer' => false,
	'verify_peer_name' => false,
	'allow_self_signed' => true
	)
	);


		$mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'nachiketbhuta@gmail.com';                 // SMTP username
		$mail->Password = 'mehul1965';                           // SMTP password
		$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
		
		$mail->Port = 587;                                    // 587 TCP port to connect to

		//Recipients
		$mail->setFrom('nachiketbhuta@gmail.com');
		$mail->addAddress($email);
		//$mail->addAddress('bhattyash031@gmail.com');
		//$mail->addAddress('dishantchandura@gmail.com');// Add a recipient
		//$mail->addAddress('ellen@example.com');               // Name is optional
		
		//$mail->addReplyTo('info@example.com', 'Information');
		//$mail->addCC('cc@example.com');
		//$mail->addBCC('bcc@example.com');

		//Attachments
		//$mail->addAttachment('ReadMe.txt');         // Add attachments
		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

		//Content
		$mail->isHTML(true);                                  // Set email format to HTML
		$mail->Subject = 'Yummy Pizza Special Subscriber';
		$mail->Body    = '<b>'.$name.'  you are now special customer of <a href="http://localhost:8085/web/index.php">yummy pizza</a>';
		$mail->AltBody = 'you will recieve all the voucher codes and promos , thank you!!!';

		$mail->send();
		
		//echo 'Message has been sent to '. $email . '<br/>';
	} catch (Exception $e) {
		echo 'Message could not be sent. Mailer Error: ', $mail->ErrorInfo;
	}
 echo "<script>window.location='http://localhost:8085/web/index.php';</script>";
?>
<?php
// Include the database configuration file


session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
$statusMsg = '';


$fname = $_POST['fname'];
$message = $_POST['message'];

$email = $_POST['email'];


if(isset($_POST["send"])){
   
            // $insert = $conn->query("INSERT into officer ( fname, national_id, age, email, telephone, from_prison, to_prison,shift, dateoftransfer) 
            // VALUES ('".$fname."', '".$idno."','".$age."', '".$email."', '".$phone."', '".$from."', '".$to."', '".$shift."','".$tdate."')");
            // if($insert){
              
               
                 /* Exception class. */
             
         
              
                 $form_data = array("fname" => $fname, "message" => $message, "email"=>$email);
              
                 $message = "Dear " . $form_data['fname'] . "\r\n";
               
                 $message .= nl2br( $form_data['message']  );
                 
               
                 $message .= nl2br("\n\nThank You. ");     
                 
                
              
              
              
                 //PHPMailer Object
                 $mail = new PHPMailer(); // create a new object
                 $mail->IsSMTP(); // enable SMTP
                 $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
                 $mail->SMTPAuth = true; // authentication enabled
                 $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
                 
                 $mail->Host = "mail.tclfoundation.co.ke";
                 $mail->Port = 465; // or  465/25/ 587 
                 $mail->IsHTML(true);
                 $mail->Username = "management@tclfoundation.co.ke"; // Enter your Email
                 $mail->Password = "management2022"; // Enter your Email Password
                 $mail->SetFrom("management@tclfoundation.co.ke");
                 $mail->Subject = "Morgue Management System";
                 $mail->Body = $message;
                 $mail->AddAddress($email);
              
                 if (!$mail->Send()) {
                     echo "Mailer Error: " . $mail->ErrorInfo;
                 } else {
                     echo "<script>
                         alert('Mail Sent Successfully');
                         window.location.href='../index.php';
                        
                         </script>";
                        //  window.location.href='officertransfer.php';
                 }

            }else{
                $statusMsg = "Failed, please try again.";
            } 
//}

// Display status message
?>
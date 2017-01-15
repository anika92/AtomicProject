<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');
include_once ('../../../vendor/phpmailer/phpmailer/class.phpmailer.php');
include_once('../../../vendor/autoload.php');
use App\Bitm\SEIP1292\Book\Book;
$obj= new Book();
$allData= $obj->index();
$trs="";
$sl=0;
foreach($allData as $data):
    $sl++;
    $trs.="<tr>";
    $trs.="<td>$sl</td>";
    $trs.="<td>$data->id</td>";
    $trs.="<td>$data->title</td>";
    $trs.="</tr>";
endforeach;
$html=<<<BITM
<div class="table-responsive">
        <table class="table">
            <thead>
            <tr>
                <th>SL#</th>
                <th>ID</th>
                <th>Book Title</th>

           </tr>
            </thead>
            <tbody>
                 $trs
            </tbody>
        </table>
BITM;

//Create a new PHPMailer instance
$mail = new PHPMailer;
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// =0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;
//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';
//Set the hostname of the mail server

// use
$mail->Host = 'smtp.gmail.com';
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 465;
//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'ssl';
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "anikacste@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "PLZHELPUSALLAH1212";
//Set who the message is to be sent from
$mail->setFrom('anikacste@gmail.com', 'First Last');
//Set an alternative reply-to address
$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress($_POST['email'], 'John Doe');
//Set the subject line
$mail->Subject = 'book';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
//Replace the plain text body with one created manually
$mail->AltBody = 'This is a plain-text message body';
//Attach an image file
///$mail->addAttachment('images/phpmailer_mini.png');
//send the message, check for errors
$mail->Body=$html;
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
    echo "Message sent!";
}
<?php
$statusMsg='';
if(isset($_FILES["file"]["name"])){
    $fname=trim($_POST['fname']);
    $lname=trim($_POST['lname']);
    $email=$_POST['email'];
    $location=trim($_POST['location']);
    $academic=$_POST['academic'];
    $skill=$_POST['skill'];
    $avail=trim($_POST['avail']);
    $apply=trim($_POST['apply']);
$fromemail =  $email;
$subject="New registration";
$email_message = '<h2>Contact Request Submitted</h2>
                    <p><b>First Name:</b> '.$fname.'</p>
                    <p><b>Last Name:</b> '.$lname.'</p>
                    <p><b>Email:</b> '.$email.'</p>
                    <p><b>Location:</b> '.$location.'</p>
                    <p><b>Academic:</b> '.$academic.'</p>
                    <p><b>Skills:</b> '.$skill.'</p>
                    <p><b>Avaibility:</b> '.$avail.'</p>
                    <p><b>Apply For:</b> '.$apply.'</p>;                  
$email_message.="Please find the attachment";
$semi_rand = md5(uniqid(time()));
$headers = "From: ".$fromemail;
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";
 
    $headers .= "\nMIME-Version: 1.0\n" .
    "Content-Type: multipart/mixed;\n" .
    " boundary=\"{$mime_boundary}\"";
 
if($_FILES["file"]["name"]!= ""){  
    $strFilesName = $_FILES["file"]["name"];  
    $strContent = chunk_split(base64_encode(file_get_contents($_FILES["file"]["tmp_name"])));  
    
    
    $email_message .= "This is a multi-part message in MIME format.\n\n" .
    "--{$mime_boundary}\n" .
    "Content-Type:text/html; charset=\"iso-8859-1\"\n" .
    "Content-Transfer-Encoding: 7bit\n\n" .
    $email_message .= "\n\n";
 
 
    $email_message .= "--{$mime_boundary}\n" .
    "Content-Type: application/octet-stream;\n" .
    " name=\"{$strFilesName}\"\n" .
    //"Content-Disposition: attachment;\n" .
    //" filename=\"{$fileatt_name}\"\n" .
    "Content-Transfer-Encoding: base64\n\n" .
    $strContent  .= "\n\n" .
    "--{$mime_boundary}--\n";
}
$toemail="akshay.matre@sprigrer.in";  
 
if(mail($toemail, $subject, $email_message, $headers)){
   $statusMsg= "Email send successfully with attachment";
}else{
   $statusMsg= "Not sent";
}
}
?>
<?php
$statusMsg='';
if(isset($_FILES["file"]["name"])){
   $email = $_POST['email'];
    $name = $_POST['name'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
$fromemail =  $email;
$subject="Uploaded file attachment";
$email_message = '<h2>Contact Request Submitted</h2>
                    <p><b>Name:</b> '.$name.'</p>
                    <p><b>Email:</b> '.$email.'</p>
                    <p><b>Subject:</b> '.$subject.'</p>
                    <p><b>Message:</b><br/>'.$message.'</p>';
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
<!DOCTYPE html>
<html>
    <head><title>Send attachment on email</title></head>
    <body>
        
        <!-- Display submission status -->
<?php if(!empty($statusMsg)){ ?>
    <p><?php echo $statusMsg; ?></p>
<?php } ?>

<!-- Display contact form -->
<form method="post" action="" enctype="multipart/form-data">
    <div class="form-group">
        <input type="text" name="name" class="form-control"  placeholder="Name" required="">
    </div>
    <div class="form-group">
        <input type="email" name="email" class="form-control"  placeholder="Email address" required="">
    </div>
    <div class="form-group">
        <input type="text" name="subject" class="form-control"  placeholder="Subject" required="">
    </div>
    <div class="form-group">
        <textarea name="message" class="form-control" placeholder="Write your message here" required=""></textarea>
    </div>
    <div class="form-group">
        <input type="file" name="file" class="form-control">
    </div>
    <div class="submit">
        <input type="submit" name="submit" class="btn" value="SEND MESSAGE">
    </div>
</form>

</body>

</html>
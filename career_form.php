<?php	
include('connection.php');
if($_SERVER["REQUEST_METHOD"]=="POST"){
/* Getting file name */
$fname=trim($_POST['fname']);
$lname=trim($_POST['lname']);
$email=$_POST['email'];
$location=trim($_POST['location']);
$academic=$_POST['academic'];
$skill=$_POST['skill'];
$avail=trim($_POST['avail']);
$apply=trim($_POST['apply']);
$resume = $_FILES['resume']['name'];
 
/* Location */
// $filepath = "upload/" . $resume;
// $uploadOk = 1;
// $resumeFileType = pathinfo($filepath,PATHINFO_EXTENSION);

// Check image format
if($resumeFileType != "pdf" && $resumeFileType != "doc") {
 $uploadOk = 0;
}

if($uploadOk == 0){
 echo 0;
}else{
	$sql="insert into career_reg_tb(fname, lname, email, location, academic, skill, avail, apply, resume) values('$fname', '$lname', '$email','$location','$academic','$skill','$avail', '$apply', '$resume')";
	$rs=mysqli_query($con,$sql); 
	echo $sql;
 /* Upload file */
//  move_uploaded_file($_FILES["resume"]["tmp_name"], $filepath);
//  	if($rs) {
//     	$data = array(
//         'status'=>'success',
//         'message'=>'You data saved Successfully'

// 	  );
// 	  echo json_encode($data);
// 	} else{
// 		$data = array(
//         'status'=>'fail',
//         'message'=>'Some Problem Occured!!!'
// 	  );
// 	  echo json_encode($data);
// 	}
 
// }
}
?>
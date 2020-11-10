<?php
if(isset($_POST['submit'])){

$fname=$_POST['fname'];
$lname=$_POST['lname'];
$email=$_POST['email'];
$location=$_POST['location'];
$academic=$_POST['academic'];
$skill=$_POST['skill'];
$avail=$_POST['avail'];
$apply=$_POST['apply'];

if(isset($_FILES['resume']['name'])){
	$fn=$_FILES['resume']['name'];
	$ext=explode(".", $fn);
	$cn=count($ext);
	if($ext[$cn-1]=='pdf' || $ext[$cn-1]=='doc'){
	$tm=$_FILES['resume']['tmp_name'];
	move_uploaded_file($tm, "upload/".$fn);

	$con=mysqli_connect("localhost","root","","sprigrerdb");
	$ins="INSERT INTO career_reg_tb SET fname='$fname',lname='$lname',email='$email',location='$location',academic='$academic',skill='$skill',avail='$avail',apply='$apply',resume='$fn'";

	$con->query($ins);
}else{
	echo "file type not allowed";
}
}
}
?>
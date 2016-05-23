<?php
//ikelia paveiksleli
session_start();
ini_set('display_errors', 0);   
$id=$_SESSION['user'];
mkdir("users/$id/");
$target_dir = "users/$id/";
$target_file = $target_dir . basename($_FILES["image"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

if($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg"
|| $imageFileType == "gif" ) {
	unlink("users/$id/profile");
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
	rename($target_file,$target_dir . "profile");
}   
else
{
echo '<script type="text/javascript">' , 
    'alert("Pasirinktas failas, nėra paveikslėlis");' , '</script>';	
}    	
header("Refresh:0; url=myprofile.php");
?>
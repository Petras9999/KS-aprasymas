<?php
session_start();
$id=$_SESSION['user'];
unlink("users/$id/profile");
header("Refresh:0; url=myprofile.php");
?>
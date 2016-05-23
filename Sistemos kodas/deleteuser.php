<?php
//istrina vartotoja is privataus kambario
session_start();
$room_id=$_SESSION['room'];
ini_set('display_errors', 0); 
include_once 'dbconnect.php';
mysql_select_db("veislini_petskt");
$url = "{$_SERVER['REQUEST_URI']}";
$nickname = substr("$url", 16);
$results=mysql_query("SELECT * FROM user WHERE username='$nickname'");
$userRow=mysql_fetch_array($results);
$user2=$userRow['user_id'];

$myresults=mysql_query("SELECT * FROM user WHERE user_id=".$_SESSION['user']);
$myuserRow=mysql_fetch_array($myresults);
$user=$myuserRow['username'];
if($user2>0)
{
mysql_query("UPDATE is_in_private SET invitedby='' WHERE username='$nickname'");
mysql_query("UPDATE is_in_private SET inprivate='0' WHERE username='$nickname'");
mysql_query("UPDATE is_in_private SET room_id='0' WHERE username='$nickname'");
}
else
{
mysql_query("UPDATE is_in_private_guest SET inprivate='0' WHERE guestname='$nickname'");
mysql_query("UPDATE is_in_private_guest SET invitedby='' WHERE guestname='$nickname'");
mysql_query("UPDATE is_in_private_guest SET room_id='0' WHERE guestname='$nickname'");
}
header("Location: privateroom.php");
?>
<?php
//vartotojo,svecio pridejimas i privatu kambari
session_start();
$room_id=$_SESSION['room'];
ini_set('display_errors', 0); 
include_once 'dbconnect.php';
mysql_select_db("veislini_petskt");

$url = "{$_SERVER['REQUEST_URI']}";
$nickname = substr("$url", 13);
$results=mysql_query("SELECT * FROM user WHERE user_id='$nickname'");
$userRow=mysql_fetch_array($results);
$user2=$userRow['user_id'];

$myresults=mysql_query("SELECT * FROM user WHERE user_id=".$_SESSION['user']);
$myuserRow=mysql_fetch_array($myresults);
$user=$myuserRow['username'];

echo $nickname;
if($user2>0)
{
mysql_query("UPDATE is_in_private SET invitedby='$user' WHERE user_id='$nickname'");
mysql_query("UPDATE is_in_private SET inprivate='1' WHERE invitedby='$user'");
mysql_query("UPDATE is_in_private SET room_id='$room_id' WHERE invitedby='$user'");

}
else
{
mysql_query("UPDATE is_in_private_guest SET inprivate='1' WHERE guestname='$nickname'");
mysql_query("UPDATE is_in_private_guest SET invitedby='$user' WHERE guestname='$nickname'");
mysql_query("UPDATE is_in_private_guest SET room_id='$room_id' WHERE guestname='$nickname'");
}
header("Location: privateroom.php");
?>
<?php
session_start();
ini_set('display_errors', 0);
include_once 'dbconnect.php';
if (!isset($_SESSION['user'])) 
{
    header("Location: index.php");
} 
else if (isset($_SESSION['user']) != "") 
{
    header("Location: home.php");
}
if (isset($_GET['logout'])) //istrina reikiamus svecio arba vartotojo duomenis
{
	$gname=$_SESSION['username'];
	$user_id = $_SESSION['user'];
    $results = mysql_query("SELECT * FROM user WHERE user_id=" . $_SESSION['user']); //paima visus duomenis is eilutes
    $row = mysql_fetch_row($results);
    mysql_query("UPDATE user SET visability='0' WHERE user_id=" . $_SESSION['user']);
	mysql_query("UPDATE is_in_private SET visability='0' WHERE user_id=" . $_SESSION['user']);
	mysql_query("UPDATE is_in_private SET inprivate='0' WHERE user_id=" . $_SESSION['user']);
	mysql_query("UPDATE is_in_private SET room_id='0' WHERE user_id=" . $_SESSION['user']);
	mysql_query("UPDATE is_in_private SET invitedby='' WHERE user_id=" . $_SESSION['user']);
	mysql_query("DELETE FROM guest WHERE guestname ='$user_id'");
	mysql_query("DELETE FROM is_in_private_guest WHERE guestname ='$gname'");
	mysql_query("DELETE FROM user_room WHERE user_id ='$user_id'");
    session_destroy();
    header("Location: index.php");
}
mysql_close();
?>

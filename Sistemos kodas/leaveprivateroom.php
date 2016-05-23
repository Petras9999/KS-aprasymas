<?php
//kai vartotojas,svecias savo noru palieka privatu kambari
session_start();
ini_set('display_errors', 0);
include_once 'dbconnect.php';
$_SESSION['check']=0;
if (!isset($_SESSION['user'])) 
{
    header("Location: index.php");
} 
else if (isset($_SESSION['user']) != "") 
{
    header("Location: home.php");
}

if ($_SESSION['username']=='')
    {
    $user_id = $_SESSION['user'];
	mysql_query("UPDATE is_in_private SET inprivate='0' WHERE user_id=" . $_SESSION['user']);
	mysql_query("UPDATE is_in_private SET room_id='0' WHERE user_id=" . $_SESSION['user']);
	mysql_query("UPDATE is_in_private SET invitedby='' WHERE user_id=" . $_SESSION['user']);
	header("Location: home.php");
    }
else
	{
	$gname=$_SESSION['username'];
	mysql_query("UPDATE is_in_private_guest SET room_id='0' WHERE guestname='$gname'");
	mysql_query("UPDATE is_in_private_guest SET inprivate='0' WHERE guestname='$gname'");
	mysql_query("UPDATE is_in_private_guest SET invitedby='' WHERE guestname='$gname'");
	header("Location: home.php");
	}
mysql_close();
?>

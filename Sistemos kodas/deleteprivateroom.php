<?php
//istrina privatu kambari
session_start();
$room_id=$_SESSION['room'];
ini_set('display_errors', 0);
$servername = "localhost";
$username = "veislini_petskt";
$password = "Petras123";
$dbname = "veislini_petskt";

if ($_SESSION['private']==$_SESSION['user'])
{
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
//zinutems istrinti
$sql = "SELECT room_id FROM message";
$num_rows= "SELECT COUNT(*) FROM message";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		if($row['room_id'] == $_SESSION['room'])
		{
        include_once 'dbconnect.php';			
        mysql_query("DELETE FROM message WHERE room_id =". $_SESSION['room']);
		}
    }
}
$_SESSION['room']=0;
//sveciams
$sql3 = "SELECT invitedby,inprivate,room_id FROM is_in_private_guest";
$num_rows3= "SELECT COUNT(*) FROM is_in_private_guest";
$result3 = $conn->query($sql3);
if ($result3->num_rows > 0) {
    while($row3 = $result3->fetch_assoc()) {
     include_once 'dbconnect.php';
	 $res3 = mysql_query("SELECT * FROM user WHERE user_id=" . $_SESSION['user']);
     $userRow3 = mysql_fetch_array($res3);	
     $user = $userRow3['username'];
        if($row3['invitedby'] == $user)
		{
		mysql_query("UPDATE is_in_private_guest SET inprivate='0' WHERE invitedby='$user'");
		mysql_query("UPDATE is_in_private_guest SET room_id='0' WHERE invitedby='$user'");
		mysql_query("UPDATE is_in_private_guest SET invitedby='' WHERE invitedby='$user'");
		}
    }
}

//vartotojams
$sql2 = "SELECT invitedby,inprivate,room_id FROM is_in_private";
$num_rows2= "SELECT COUNT(*) FROM is_in_private";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
     include_once 'dbconnect.php';
	 mysql_query("UPDATE is_in_private SET inprivate='0' WHERE username='$user'");
	 mysql_query("UPDATE is_in_private SET room_id='0' WHERE username='$user'");
	 $res2 = mysql_query("SELECT * FROM is_in_private WHERE user_id=" . $_SESSION['user']);
     $userRow2 = mysql_fetch_array($res2);	
     $user = $userRow2['username'];
        if($row2['invitedby'] == $user)
		{
		mysql_query("UPDATE is_in_private SET inprivate='0' WHERE invitedby='$user'");
		mysql_query("UPDATE is_in_private SET room_id='0' WHERE invitedby='$user'");
		mysql_query("UPDATE is_in_private SET invitedby='' WHERE invitedby='$user'");
		}
    }
}
$conn->close();
include_once 'dbconnect.php';
mysql_query("DELETE FROM user_room WHERE user_id =". $_SESSION['user']);
mysql_query("DROP TABLE $user");
$_SESSION['private']=0;
}
header("Location: home.php");
?>
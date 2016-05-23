<?php
//atvaizduoja nariu sarasa privaciame kambaryje
session_start();
ini_set('display_errors', 0); 
$servername = "localhost";
$username = "veislini_petskt";
$password = "Petras123";
$dbname = "veislini_petskt";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
include_once 'dbconnect.php';
if ($_SESSION['username'] == '')
{
$res = mysql_query("SELECT * FROM is_in_private WHERE user_id=" . $_SESSION['user']);
$userRow = mysql_fetch_array($res);	
$room_id = $userRow['room_id'];

$sql = "SELECT username,visability,invitedby,room_id FROM is_in_private";
$num_rows= "SELECT COUNT(*) FROM is_in_private";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		if ($row['visability']== 1 && $row['room_id']==$room_id )
		{
       echo "<a href=usersprofile.php?{$row['username']} \" \>{$row['username']}</a><br>";
		}
    }
}

$sql2 = "SELECT guestname,invitedby,room_id FROM is_in_private_guest";
$num_rows2= "SELECT COUNT(*) FROM is_in_private_guest";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
		
      if ($row2['room_id']==$room_id )
		{
         echo "{$row2['guestname']} [Svečias]</a><br>";
		}
    }
}
}
else
{
	$gname=$_SESSION['username'];
$res = mysql_query("SELECT * FROM is_in_private_guest WHERE guestname='$gname'");
$userRow = mysql_fetch_array($res);	
$room_id= $userRow['room_id'];

$sql = "SELECT username,visability,invitedby,room_id FROM is_in_private";
$num_rows= "SELECT COUNT(*) FROM is_in_private";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		if ($row['visability']== 1 && $row['room_id']==$room_id )
		{
       echo "<a href=usersprofile.php?{$row['username']} \" \>{$row['username']}</a><br>";
		}
    }
}
$sql2 = "SELECT guestname,invitedby,room_id FROM is_in_private_guest";
$num_rows2= "SELECT COUNT(*) FROM is_in_private_guest";
$result2 = $conn->query($sql2);
if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
		
      if ($row2['room_id']==$room_id )
		{
         echo "{$row2['guestname']} [Svečias]</a><br>";
		}
    }
}	
	
}
$conn->close();
?>
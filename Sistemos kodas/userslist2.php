<?php
//vartotojai,sveciai kuriuos galima pasalinti is privataus kambario
session_start();
include_once 'dbconnect.php';
$res = mysql_query("SELECT * FROM is_in_private WHERE user_id=" . $_SESSION['user']);
$userRow = mysql_fetch_array($res);	
$user = $userRow['username'];
$room_id=$userRow['room_id'];
ini_set('display_errors', 0); 
$servername = "localhost";
$username = "veislini_petskt";
$password = "Petras123";
$dbname = "veislini_petskt";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT username,visability,invitedby,room_id FROM is_in_private";
$num_rows= "SELECT COUNT(*) FROM is_in_private";
$result = $conn->query($sql);


if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		if ($row['visability']== 1 && $row['invitedby']==$user )
		{
       echo "<a href=deleteuser.php?{$row['username']} \" \>{$row['username']}</a><br>";
		}
    }
}

$sql2 = "SELECT guestname,invitedby FROM is_in_private_guest";
$num_rows2= "SELECT COUNT(*) FROM is_in_private_guest";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) { //ciklas visoms eilutems is lenteles atvaizduoti
    while($row2 = $result2->fetch_assoc()) {
      if ($row2['invitedby']==$user )
		{
		echo "<a href=deleteuser.php?{$row2['guestname']} \" \>{$row2['guestname']}[Svečias]</a><br>";
		}
    }
}

$conn->close();
?>
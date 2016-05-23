<?php
//rodo zinutes privaciame kambaryje
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
$sql = "SELECT username, time, text, room_id FROM message";
$num_rows= "SELECT COUNT(*) FROM message";
$result = $conn->query($sql);

include_once 'dbconnect.php';


if ($_SESSION['username'] == '') //atvaizduoti vartotojui
{
$roomres = mysql_query("SELECT * FROM is_in_private WHERE user_id=" . $_SESSION['user']);
$roomRow = mysql_fetch_array($roomres);
$room_id =$roomRow['room_id'] ;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		if($row['room_id'] == $room_id)
        echo $row["time"]." / " . $row["username"]. " | " . $row["text"]. "<br>";
    }
}
}
else // atvaizduoti sveciui
{
$gname=$_SESSION['username'];
$gres = mysql_query("SELECT * FROM is_in_private_guest WHERE guestname='$gname'");
$roomRow = mysql_fetch_array($gres);
$room_id =$roomRow['room_id'] ;

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		if($row['room_id'] == $room_id)
        echo $row["time"]." / " . $row["username"]. " | " . $row["text"]. "<br>";
    }
}	
}
$conn->close();
?>
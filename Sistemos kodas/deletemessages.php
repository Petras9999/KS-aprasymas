<?php
//istrina zinutes is privataus kambario
session_start();
ini_set('display_errors', 0);
if ($_SESSION['private']==$_SESSION['user'])
{
$servername = "localhost";
$username = "veislini_petskt";
$password = "Petras123";
$dbname = "veislini_petskt";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
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
$conn->close();
header("Location: privateroom.php");
}
else
header("Location: home.php");
?>
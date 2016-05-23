<?php
//vartotojai,sveciai kuriuos galima prideti i privatu kambari
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


$sql = "SELECT username,user_id,visability,inprivate FROM is_in_private";
$num_rows= "SELECT COUNT(*) FROM is_in_private";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		if ($row['visability']== 1 && $row['inprivate']== 0)
        echo "<a href=adduser.php?{$row['user_id']} \" \>{$row['username']}</a><br>";
    }
}

$sql2 = "SELECT guestname,inprivate FROM is_in_private_guest";
$num_rows2= "SELECT COUNT(*) FROM is_in_private_guest";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {
if ($row2['inprivate']== 0)
        echo "<a href=adduser.php?{$row2['guestname']} \" \>{$row2['guestname']}[Svečias]</a><br>";
    }
}

$conn->close();
?>
<?php
//zinuciu atvaizdavimui pagrindiniame kambaryje
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

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
		if($row['room_id'] == 1)
        echo $row["time"]." / " . $row["username"]. " | " . $row["text"]. "<br>";
    }
}
$conn->close();
?>
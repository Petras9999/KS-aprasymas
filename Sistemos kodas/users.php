<?php
//atvaizduoja vartotoju sarasa
ini_set('display_errors', 0); 

$servername = "localhost";
$username = "veislini_petskt";
$password = "Petras123";
$dbname = "veislini_petskt";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT username,visability FROM user";
$num_rows= "SELECT COUNT(*) FROM user";
$result = $conn->query($sql);

if ($result->num_rows > 0) { //ciklas visoms eilutems is lenteles atvaizduoti
    while($row = $result->fetch_assoc()) {
		if ($row['visability']== 1)
        echo "<a href=usersprofile.php?{$row['username']} \" \>{$row['username']}</a><br>";
    }
}

$sql2 = "SELECT guestname FROM guest";
$num_rows2= "SELECT COUNT(*) FROM guest";
$result2 = $conn->query($sql2);

if ($result2->num_rows > 0) {
    while($row2 = $result2->fetch_assoc()) {

        echo "{$row2['guestname']} [Svečias]</a><br>";
    }
}
$conn->close();
?>
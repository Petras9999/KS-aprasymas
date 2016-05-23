<?php
if (!mysql_connect("localhost", "veislini_petskt", "Petras123")) 
{ // tikrina ar prisijungia prie db
    die('prisijungimo klaida ! --> ' . mysql_error());
}
if (!mysql_select_db("veislini_petskt")) 
{  //tikrina ar yra tokia db
    die('tokios duomenų bazės nėra ! --> ' . mysql_error());
}
?>

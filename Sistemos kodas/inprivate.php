<?php
//tikrina ar vartotojas,svecias buvo pasalintas is privataus kambario
 session_start();
 ini_set('display_errors', 0);
include_once 'dbconnect.php';
if ($_SESSION['username'] == '')
{
$res = mysql_query("SELECT * FROM is_in_private WHERE user_id=" . $_SESSION['user']);
$userRow = mysql_fetch_array($res);	
$user= $userRow['inprivate'];
$_SESSION['check']=$user;
if($_SESSION['check']==0)
{
echo '<script type="text/javascript">alert("Buvote pašalintas iš privataus kambario"); </script>';
echo '<script type="text/javascript">location.reload();  </script>';
}	
}
else
{
$guestname=$_SESSION['username'];
$gres = mysql_query("SELECT * FROM is_in_private_guest WHERE guestname='$guestname'");
$guestRow = mysql_fetch_array($gres);	
$guest= $guestRow['inprivate'];	
$_SESSION['check']=$guest;
if($_SESSION['check']==0)
{
echo '<script type="text/javascript">alert("Buvote pašalintas iš privataus kambario"); </script>';
echo '<script type="text/javascript">location.reload();  </script>';
}
}
mysql_close();
?>
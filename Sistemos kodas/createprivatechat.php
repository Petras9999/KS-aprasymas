<?php
//privataus kambario kurimui,tik vartotojams
session_start();
ini_set('display_errors', 0);
include_once 'dbconnect.php';  

if ($_SESSION['private']==$_SESSION['user'])
{
header("Location: home.php");
}

if ($_SESSION['username'] !='')
{
header("Location: home.php");	
}

if (!isset($_SESSION['user'])) 
{
    header("Location: index.php");
}

if (isset($_POST['kurti']))
{	
$roomname = mysql_real_escape_string($_POST['pavadinimas']);
$capacity = mysql_real_escape_string($_POST['talpa']);
mysql_query("INSERT INTO user_room(user_id,room_name) VALUES('$_SESSION[user]','$roomname')");
$_SESSION['private']=$_SESSION['user']; //privataus kambario kurejo identifikacijai
$roomres = mysql_query("SELECT * FROM user_room WHERE user_id=" . $_SESSION['user']);
$roomRow = mysql_fetch_array($roomres);
$_SESSION['room']=$roomRow['room_id']; //privataus kambario,zinutems identifikacijai,
$room_id=$_SESSION['room'];
$results = mysql_query("SELECT * FROM user WHERE user_id=" . $_SESSION['user']);
$userRow = mysql_fetch_array($results);
$user = $userRow['username'];

mysql_query("UPDATE is_in_private SET inprivate='1' WHERE user_id=" . $_SESSION['user']);
mysql_query("UPDATE is_in_private SET room_id='$room_id' WHERE user_id=" . $_SESSION['user']);

header("Location: privateroom.php");
}

$results = mysql_query("SELECT * FROM user WHERE user_id=" . $_SESSION['user']);
$userRow = mysql_fetch_array($results);
$row = mysql_fetch_row($results);


 
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pokalbių kambario kūrimas</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="chatstyle.css" />
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
      <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
	<!--<meta http-equiv="Refresh" content="3">-->
        <div class="container">
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">	   
                        <a class="navbar-brand" <label>Sveiki <?php echo $userRow['username'];
						echo $_SESSION['username'];
						?>,</label>
                            <a class="navbar-brand"
							
                               <?php 	
                               if ($_SESSION['username'] =='')
                               {
                               Echo "<a href=myprofile.php> Mano profilis ";     
                               }

                               ?> 
                               <a class="navbar-brand"
                               
                               <a class="navbar-brand navbar-right" <a href="home.php">Atgal </a>
                                        <div id="navbar" class="collapse navbar-collapse">
                                        </div>
                    </div>
                </div>
			</nav>
            <br><br><br><br>                
        </div>
                                        <div class="container-fluid">
                                            <div class="col-md-9">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">Pokalbių kambario kūrimas</div>												
                                                        <form id="chat" action="" method="post">														
                                                            <div class="input-group"> <br>								
                                                                Pokalbių kambario pavadinimas:
																<input type="text" name="pavadinimas" </><br>
									                         <div class="col-md-20 col-lg-3 " align="left">
                                                            <br>
                                                            <input type="submit" name="kurti" class="btn btn-primary" value='Išsaugoti'</input>
                                                            <a href="home.php" class="btn btn-primary">Grįžti</a>                 
                                                            </div>															
                                                             </div> 
                                                            </div>
                                                        </form>                                                 
                                                </div>
                                            </div>
                                        </div> 
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
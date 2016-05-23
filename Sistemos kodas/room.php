<?php
session_start();
ini_set('display_errors', 0);
include_once 'dbconnect.php';
$check = $_SESSION['check'];
if (!isset($_SESSION['user'])) 
{
    header("Location: index.php");
}
if ($_SESSION['username'] == '')
{
$res = mysql_query("SELECT * FROM is_in_private WHERE user_id=" . $_SESSION['user']);
$userRow = mysql_fetch_array($res);
$id=$userRow['room_id'];
$roomdata=mysql_query("SELECT * FROM user_room WHERE room_id='$id'");
$room=mysql_fetch_array($roomdata);	
}
else
{
$a=$_SESSION['username'];
$res = mysql_query("SELECT * FROM is_in_private_guest WHERE guestname='$a'");
$userRow = mysql_fetch_array($res);
$id=$userRow['room_id'];
$roomdata=mysql_query("SELECT * FROM user_room WHERE room_id='$id'");
$room=mysql_fetch_array($roomdata);		
}

if ($check==0)
{
header("Location: home.php");	
}
else
{
if(isset($_POST['btn-chat']))	
  {  
   date_default_timezone_set('Africa/Nairobi');
   $text = mysql_real_escape_string($_POST['text']);
   $laikas= date('H:i:s');   
   
  if($_SESSION['username'] == '')
    mysql_query("INSERT INTO message(text,user_id,username,time,room_id) VALUES('$text','$_SESSION[user]','$userRow[username]','$laikas','$userRow[room_id]')");
	else {
	$gname=$_SESSION['username'];
	$gres = mysql_query("SELECT * FROM is_in_private_guest WHERE guestname='$gname'");
    $roomRow = mysql_fetch_array($gres);	
    mysql_query("INSERT INTO message(text,username,time,room_id) VALUES('$text','$_SESSION[username]','$laikas','$roomRow[room_id]')");   
	}	

  }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Privatus kambarys</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="chatstyle.css" />
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js" type="text/javascript"></script>
<script language="javascript" type="text/javascript">

$(document).ready(function(){
  refreshPUsers();
  refreshMessages();
  refreshMeniu()
});
	
function refreshPUsers(){
    $('#online').load('usersinprivateroom.php', function(){
       setTimeout(refreshPUsers, 300);
    });
}

function refreshMessages(){
    $('#chat-output').load('privatechatmessages2.php', function(){
       setTimeout(refreshMessages, 300);
    });
}

function refreshMeniu(){
    $('#checkroom').load('inprivate.php', function(){
       setTimeout(refreshMeniu, 300);
    });
}

</script>
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
                               <?php 
                               if ($_SESSION['username'] =='')
								Echo "<a href=home.php> Pagrindinis pokalbių kambarys";								
                               ?>	
                               <a class="navbar-brand navbar-right" <a href="home.php">Atgal </a>
							   <a class="navbar-brand" id="checkroom">                              
                               </a>   
                                        <div id="navbar" class="collapse navbar-collapse">
                                        </div>
                    </div>
                </div>
			</nav>
            <br><br><br><br>                
        </div>
                                        <div class="container-fluid">   <!-- Chato bei online useriu langas-->
                                            <div class="col-md-9">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading"><?php
													echo $room['room_name'] ." kambarys";
													?></div>
                                                    <ul class="list-group" id="chat-output"> 
													<!-- talpinama zinute lange-->																																				
													</ul>
													
                                                    <div class="panel-body">
                                                        <form id="chat" method="post">														
                                                            <div class="input-group">
                                                                <input type="text" name="text" class="form-control" id="chat-input" /> <!-- rasoma zinute-->
                                                                <span class="input-group-btn">
                                                                    <button type="submit" name="btn-chat" class="btn btn-default">Siųsti</button> <!--issiunciama zinute-->
                                                                </span>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" align="center ">Vartotojai šiame kambaryje</div>
                                                        <div class="list-group" id="online">				
                                                        </div>
                                                    </div>
                                                </div>   
                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            <div class="col-md-20 col-lg-3 " align="left">
											 <form action="leaveprivateroom.php" method="" enctype="multipart/form-data">                                        
															<input type="submit" class="btn btn-primary" value='Palikti pokalbių kambarį'><br><br>
                                                        </form>
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
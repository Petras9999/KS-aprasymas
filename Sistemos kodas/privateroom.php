<?php
session_start();
ini_set('display_errors', 0);
include_once 'dbconnect.php';

if (!isset($_SESSION['user'])) 
{
    header("Location: index.php");
}

if ($_SESSION['username'] == '')
{
$res = mysql_query("SELECT * FROM user WHERE user_id=" . $_SESSION['user']);
$userRow = mysql_fetch_array($res);	
$roomres = mysql_query("SELECT * FROM user_room WHERE user_id=" . $_SESSION['user']);
$roomRow = mysql_fetch_array($roomres);
}
else
{
header("Location: home.php");	
}

if ($_SESSION['private']!=$_SESSION['user'])
header("Location: home.php");	

if(isset($_POST['btn-chat']))	
  {  
   date_default_timezone_set('Africa/Nairobi');
   $text = mysql_real_escape_string($_POST['text']);
   $laikas= date('H:i:s');      
  if($_SESSION['username'] == '')
    mysql_query("INSERT INTO message(text,user_id,username,time,room_id) VALUES('$text','$_SESSION[user]','$userRow[username]','$laikas','$_SESSION[room]')");  
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
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
  refreshTable();
  refreshUsers();
  refreshPUsers();
  refreshRUsers();
});
function refreshTable(){
    $('#chat-output').load('privatechatmessages.php', function(){
       setTimeout(refreshTable, 100);
    });
}
	
function refreshUsers(){
    $('#online-users').load('usersinprivateroom.php', function(){
       setTimeout(refreshUsers, 300);
    });
}
function refreshPUsers(){
    $('#online').load('userslist.php', function(){
       setTimeout(refreshPUsers, 300);
    });
}

function refreshRUsers(){
    $('#online2').load('userslist2.php', function(){
       setTimeout(refreshRUsers, 300);
    });
}

function istrintizinutes()
{
$('#veiksmai').load('deletemessages.php', function(){
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
													echo $roomRow['room_name']." kambarys";
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
                                                        <div class="list-group" id="online-users">				
                                                        </div>
                                                    </div>
                                                </div>   
                                            </div>
                                        </div>
                                        <div class="panel-footer">
                                            <div class="col-md-20 col-lg-3 " align="left">
                                            </div> 
                                        </div>
                                         <input type="" id="veiksmai" class="btn btn-primary" onclick="istrintizinutes();" value='Ištrinti žinutes'> </div><br><br>										
										 <form action="deleteprivateroom.php" method="" enctype="multipart/form-data">                                        
															<input type="submit" class="btn btn-primary" value='Panaikinti pokalbių kambarį'><br><br>
                                                        </form>
														    <div class="row">
															   <div class="col-md-3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" align="center ">Pridėti vartotoją į kambarį</div>
                                                        <div class="list-group" id="online">														
                                                        </div>
                                                    </div>
                                                </div>  
                                                <div class="col-md-3">
                                                    <div class="panel panel-default">
                                                        <div class="panel-heading" align="center ">Šalinti vartotoją iš kambario</div>
                                                        <div class="list-group" id="online2">														
                                                        </div>
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
<?php
session_start();
ini_set('display_errors', 0);     //isjungia warningus ir kitus pranesimus
include_once 'dbconnect.php';
if (!isset($_SESSION['user'])) 
{
    header("Location: index.php");
}
if ($_SESSION['username'] == '')
{
$res = mysql_query("SELECT * FROM user WHERE user_id=" . $_SESSION['user']);
mysql_query("UPDATE user SET visability='1' WHERE user_id=" . $_SESSION['user']);
mysql_query("UPDATE is_in_private SET visability='1' WHERE user_id=" . $_SESSION['user']);
$userRow = mysql_fetch_array($res);	
}
if(isset($_POST['btn-chat'])) //zinutes rasymui
  {  
   date_default_timezone_set('Africa/Nairobi');
   $text = mysql_real_escape_string($_POST['text']);
   $laikas= date('H:i:s');   
  if($_SESSION['username'] == '')
    mysql_query("INSERT INTO message(text,user_id,username,time,room_id) VALUES('$text','$_SESSION[user]','$userRow[username]','$laikas','1')");
    else {
    mysql_query("INSERT INTO message(text,username,time,room_id) VALUES('$text','$_SESSION[username]','$laikas','1')");   
	}
  }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Pagrindinis puslapis</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="chatstyle.css" />
		<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script language="javascript" type="text/javascript">
$(document).ready(function(){
  refreshTable();
  refreshUsers();
  refreshMeniu()
});
function refreshTable(){
    $('#chat-output').load('chat.php', function(){
       setTimeout(refreshTable, 100);
    });
}
	
function refreshUsers(){
    $('#online-users').load('users.php', function(){
       setTimeout(refreshUsers, 300);
    });
}

function refreshMeniu(){
    $('#meniu').load('meniu.php', function(){
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
							   </a>
                               <a class="navbar-brand" id="meniu">
                               
                               </a>
                               <a class="navbar-brand navbar-right" <a href="logout.php?logout">Atsijungti </a>
                                        <div id="navbar" class="collapse navbar-collapse">
                                        </div>
                    
                </div>
			</nav>
            <br><br><br><br>                
        </div>
                                        <div class="container-fluid">   <!-- Chato bei online useriu langas-->
                                            <div class="col-md-9">
                                                <div class="panel panel-default">
                                                    <div class="panel-heading">Pokalbių kambarys</div>
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
                                                        <div class="panel-heading" align="center ">Prisijungę vartotojai</div>
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
        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="js/bootstrap.min.js"></script>
    </body>
</html>
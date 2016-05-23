<?php
//kito vartotojo profilio perziurai
session_start();
include_once 'dbconnect.php';
mysql_select_db("veislini_petskt");
if (!isset($_SESSION['user'])) 
{
    header("Location: index.php");
}

$result = mysql_query("SELECT * FROM user WHERE user_id=" . $_SESSION['user']);
$userow = mysql_fetch_array($result);
mysql_close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Mano profilis</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="chatstyle.css" />
    </head>
    <body>	
        <div class="container">
            <nav class="navbar navbar-inverse navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">	  	
                        <a class="navbar-brand" <label>Sveiki 
                                <?php
                                echo $userow['username']; ?>,</label>	
                            <a class="navbar-brand navbar-right" <a href="logout.php?logout"> Atsijungti</a>			
                                <div id="navbar" class="collapse navbar-collapse">
                                </div>
                    </div>
                </div>
			</nav>
            <br><br>               
        </div>	
<?php
if(!mysql_connect("localhost","veislini_petskt","Petras123"))
{
     die('prisijungimo klaida ! --> '.mysql_error());
}
if(!mysql_select_db("veislini_petskt")) 
{
     die('tokios duomenų bazės nėra ! --> '.mysql_error()); 
}
$url = "{$_SERVER['REQUEST_URI']}";
$nickname = substr("$url", 18);
$results=mysql_query("SELECT * FROM user WHERE username='$nickname'");
$userRow=mysql_fetch_array($results);
mysql_close(); //Uždarome db
?>	
	
<div class="container">
    <div class="row">
        <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
        </div>
        <div class="col-xs-12 col-sm-12 col-md-111 col-lg-10 col-xs-offset-10 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 toppad" >  
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><label><?php echo $userRow['username'] ?></label> profilis</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?php $usersid= $userRow['user_id']; echo "users/$usersid"?>/profile" 					
						class="img-circle img-responsive"> </div>
                        <div class=" col-md-9 col-lg-9 "> 
                            <table class="table table-user-information">
                                <tbody>
                                    <tr>
                                        <td>El. paštas</td>
                                        <td><label><?php echo $userRow['email'] ?></label></td>
                                    </tr>
                                    <tr>
                                        <td>Vardas:</td>
                                        <td><label><?php echo $userRow['first_name'] ?></label></td>
                                    </tr>
                                    <tr>
                                        <td>Pavardė</td>
                                        <td><label><?php echo $userRow['last_name'] ?></label></td>
                                    </tr>                

                                    <tr>
                                        <td>Amžius</td>
                                        <td><label><?php echo $userRow['age'] ?></label></td>
                                    </tr>
                                    <tr>
                                        <td>Šalis</td>
                                        <td><label><?php echo $userRow['country'] ?></label></td>
                                    </tr>
                                    <tr>
                                        <td>Lytis</td>
                                        <td><label><?php echo $userRow['gender'] ?></label></a></td>
                                    </tr>                          
                                    <tr>
                                        <td></td>
                                        <td></td>
                                    </tr> 
                                </tbody>
                            </table>
                            <div class="col-md-3 col-lg-3 " align="left">
                                <a href="home.php" class="btn btn-primary">Grįžti</a>                 
                            </div>
                        </div>
                    </div>
                </div>	
                <div class="panel-footer">
                    <div class="col-md-20 col-lg-3 " align="left">
                    </div> 
                </div>
    </body>
     <!-- Bootstrap core JavaScript
     ================================================== -->
     <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
     <!-- Include all compiled plugins (below), or include individual files as needed -->
     <script src="js/bootstrap.min.js"></script>
</html>
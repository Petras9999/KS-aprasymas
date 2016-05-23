<?php
session_start();
ini_set('display_errors', 0);     
include_once 'dbconnect.php';

if ($_SESSION['username'] !='') //neleis sveciui perziureti savo profilio
{
header("Location: home.php");	
}

if (!isset($_SESSION['user'])) 
{
    header("Location: index.php");
}
$results = mysql_query("SELECT * FROM user WHERE user_id=" . $_SESSION['user']);
$userRow = mysql_fetch_array($results);
$row = mysql_fetch_row($results);
    if (isset($_POST['updateemail']))
	{
	$mail = mysql_real_escape_string($_POST['email']);
    mysql_query("UPDATE user SET email='$mail' WHERE user_id=". $_SESSION['user']);
	$results = mysql_query("SELECT * FROM user WHERE user_id=" . $_SESSION['user']);
    $userRow = mysql_fetch_array($results);
    $row = mysql_fetch_row($results);
	}

	if (isset($_POST['updatefname']))
	{
	$fname = mysql_real_escape_string($_POST['fname']);
    mysql_query("UPDATE user SET first_name='$fname' WHERE user_id=". $_SESSION['user']);
    $results = mysql_query("SELECT * FROM user WHERE user_id=" . $_SESSION['user']);
    $userRow = mysql_fetch_array($results);
    $row = mysql_fetch_row($results);
	}
	
	if (isset($_POST['updatelname']))
	{
	$lname = mysql_real_escape_string($_POST['lname']);
    mysql_query("UPDATE user SET last_name='$lname' WHERE user_id=". $_SESSION['user']);
	$results = mysql_query("SELECT * FROM user WHERE user_id=" . $_SESSION['user']);
    $userRow = mysql_fetch_array($results);
    $row = mysql_fetch_row($results);
	}
	
	if (isset($_POST['updateage']))
	{
	$age = mysql_real_escape_string($_POST['age']);
    mysql_query("UPDATE user SET age='$age' WHERE user_id=". $_SESSION['user']);
	$results = mysql_query("SELECT * FROM user WHERE user_id=" . $_SESSION['user']);
    $userRow = mysql_fetch_array($results);
    $row = mysql_fetch_row($results);
	}
	
	if (isset($_POST['updatecountry']))
	{
	$country = mysql_real_escape_string($_POST['country']);
    mysql_query("UPDATE user SET country='$country' WHERE user_id=". $_SESSION['user']);
	$results = mysql_query("SELECT * FROM user WHERE user_id=" . $_SESSION['user']);
    $userRow = mysql_fetch_array($results);
    $row = mysql_fetch_row($results);
	}
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
                                <?php echo $userRow['username']; ?>,</label>	
                            <a class="navbar-brand navbar-right" <a href="logout.php?logout"> Atsijungti</a>			
                                <div id="navbar" class="collapse navbar-collapse">
                                </div>
                    </div>
                </div>
			 </nav>
            <br><br>              
        </div>	
                                <div class="container">
                                    <div class="row">
                                        <div class="col-md-5  toppad  pull-right col-md-offset-3 ">
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-111 col-lg-10 col-xs-offset-10 col-sm-offset-0 col-md-offset-0 col-lg-offset-0 toppad" >  
                                            <div class="panel panel-info">
                                                <div class="panel-heading">
                                                    <h3 class="panel-title">Mano profilis</h3>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-3 col-lg-3 " align="center"> <img alt="User Pic" src="<?php $usersid= $userRow['user_id']; echo "users/$usersid"?>/profile" class="img-circle img-responsive"> </div>
                                                        <div class=" col-md-9 col-lg-9 "> 
														<form class="table table-user-information" method="post">
                                                            <table class="table table-user-information">
                                                                <tbody>
                                                                    <tr>
                                                                        <td>El. paštas</td>
                                                                        <td><button type="submit" name="updateemail" class="btn btn-default" >Išsaugoti</button> &nbsp; <input type="text" name="email" value="<?php echo $userRow['email'] ?>" </input></td>																	
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Vardas:</td>
                                                                        <td><button type="submit" name="updatefname" class="btn btn-default" >Išsaugoti </button> &nbsp; <input type="text" name="fname" value="<?php echo $userRow['first_name'] ?>" </input></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Pavardė</td>
                                                                        <td><button type="submit" name="updatelname" class="btn btn-default" >Išsaugoti </button> &nbsp; <input type="text" name="lname" value="<?php echo $userRow['last_name'] ?>" </input></td>
                                                                    </tr>                

                                                                    <tr>
                                                                        <td>Amžius</td>
                                                                        <td><button type="submit" name="updateage" class="btn btn-default" >Išsaugoti </button> &nbsp; <input type="number" name="age" min="7" max="99" value="<?php echo $userRow['age'] ?>" </input></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Šalis</td>
                                                                        <td><button type="submit" name="updatecountry" class="btn btn-default" >Išsaugoti </button> &nbsp; <input type="text" name="country" value="<?php echo $userRow['country'] ?>" </input></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>Lytis</td>
                                                                        <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Vyras </a></td>
                                                                    </tr>                          
                                                                    <tr>
                                                                        <td></td>
                                                                        <td></td>
                                                                    </tr> 
                                                                </tbody>
                                                            </table>
															</form>
                                                            <div class="col-md-3 col-lg-3 " align="left">
                                                                <a href="home.php" class="btn btn-primary">Grįžti</a>                 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>	
                                                <div class="panel-footer">
                                                    <div class="col-md-20 col-lg-3 " align="left">
                                                        <form action="upload.php" method="post" enctype="multipart/form-data">
                                                            <input type="file"  name="image" id="image">
                                                            <br>
                                                            <input type="submit" class="btn btn-primary" value='Įkelti avatarą'>	                                 
                                                        </form>
														 <form action="deleteavatar.php" method="post" enctype="multipart/form-data">
                                                            <input type="submit" class="btn btn-primary" value='Ištrinti avatarą'>
                                                        </form>
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
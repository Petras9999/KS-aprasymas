<?php
session_start();
include_once 'dbconnect.php';

if (isset($_SESSION['user']) != "") 
{
    header("Location: home.php");
}
if (isset($_POST['btn-login']))
	{
    $username = mysql_real_escape_string($_POST['username']);
    $upass = mysql_real_escape_string($_POST['pass']);
    $res = mysql_query("SELECT * FROM user WHERE username='$username'");
    $row = mysql_fetch_array($res);
    if ($row['password'] == md5($upass)) 
	{
        $_SESSION['user'] = $row['user_id'];//sesija vartotojui
        header("Location: home.php");
    } 
	else 
	{
        ?>
        <script> alert("Neteisingai įvesti duomenys arba tokio vartotojo nėra");</script>
        <?php
    }
}

if (isset($_POST['btn-guestlogin'])) 
{
    $gname = mysql_real_escape_string($_POST['guestname']);
    mysql_query("INSERT INTO guest(guestname) VALUES('$gname')");
	 mysql_query("INSERT INTO is_in_private_guest(guestname) VALUES('$gname')");
    $_SESSION['user'] = $gname; //sesija sveciui
	$_SESSION['username'] = $gname;
    header("Location: home.php");
}
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="http://v4-alpha.getbootstrap.com/favicon.ico">
        <title>Internetinis chatas</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="chatstyle.css" />
        <!-- Bootstrap core CSS -->
		<script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>	
    </head>  
    <body>
 <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">  
                <h1 class="display-3"></h1>	
                <p></p><center><h1>Internetinė pokalbių svetainė</h1></center><p></p>
            </div>
        </div>
        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
                <div class="col-md-4">
                    <center>
                        <h3>Prisijungti svečiu</h3>
                    </center>
                    <div id="guestlogin-form">
                        <form id="guestlogin" method="post">	
                            <table align="right" border="0">
                                <tr>
                                    <td>
                                        <div class="form-group">
                                            <label for="nickname">Slapyvardis</label>
                                            <input type="text" name="guestname" placeholder="" class="form-control" minlength="4" required />
                                        </div>
                                    </td>
                                </tr>
                                <br>
                                <tr>
                                    <td>
                                        <button type="submit" name="btn-guestlogin" class="btn btn-block btn-danger btn-lg"> Prisijungti</button>
                                    </td>
                                </tr>
                                <tr>
                                </tr>
                            </table>
                        </form>
                    </div>
                </div>
                <div class="col-md-4">
                    <h2></h2>
                    <p></p>
                </div>
                <div class="col-md-4">
                    <center>
                        <h3>Vartotojo prisijungimas</h3>
                    </center> 
                    <div id="login-form">
                        <form id="userlogin" method="post">
                            <br>
                            <table align="right" border="0">
                                <tbody><tr>
                                        <td>
                                            <div class="form-group">
                                                <label for="username">Vartotojo vardas</label>
                                                <input type="text" name="username" placeholder="" class="form-control" required="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="form-group">
                                                <label for="password">Slaptažodis</label>
                                                <input type="password" name="pass" placeholder="" class="form-control" required="">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button type="submit" name="btn-login" class="btn btn-block btn-danger btn-lg">Prisijungti</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td><a href="register.php">Registruotis</a></td>
                                    </tr>
                                </tbody></table>
                        </form>
                    </div>

                </div>
            </div>
            <hr>	  
            <div class="panel-footer">
                <div class="col-md-15 col-lg-3 " align="left">
                    <p><h4>Bendrauk su betkuo apie viską<h4></p>
                            <p><h4>Susipažnk su žmonėmis<h4></p>
                                    <p><h4>Tai visiškai nemokamai<h4></p>
                </div> 
            </div> 
        </div> <!-- /container -->
                                            <!-- Bootstrap core JavaScript
                                            ================================================== -->
                                            <!-- Placed at the end of the document so the pages load faster -->
         <script src="./index_files/jquery.min.js"></script>
         <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
         <script src="./index_files/bootstrap.min.js"></script>
         <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="./index_files/ie10-viewport-bug-workaround.js"></script>      
    </body>
</html>
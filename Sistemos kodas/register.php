<?php
session_start();
if (isset($_SESSION['user']) != "") {
    header("Location: home.php");
}
include_once 'dbconnect.php';
if (isset($_POST['btn-signup'])) {
    $uname = mysql_real_escape_string($_POST['uname']);
    $upass = md5($_POST['pass']);
    $mail = mysql_real_escape_string($_POST['mail']);
    $fname = mysql_real_escape_string($_POST['fname']);
    $lname = mysql_real_escape_string($_POST['lname']);
    $age = mysql_real_escape_string($_POST['age']);
    $country = mysql_real_escape_string($_POST['country']);
    $gender = mysql_real_escape_string($_POST['gender']);
    if (mysql_query("INSERT INTO user(username,password,email,first_name,last_name,age,country,gender) VALUES('$uname','$upass','$mail','$fname','$lname','$age','$country', '$gender')")) 
	{
		mysql_query("INSERT INTO is_in_private(username) VALUES('$uname')");
        ?>
        <script>alert('Sėkmingai užregistruota ');</script>
        <?php
    } 
	else 
	{
        ?>
        <script>alert('Vartotojas arba el.paštas jau yra naudojamas');</script>
        <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Registracija</title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link type="text/css" rel="stylesheet" href="chatstyle.css" />
    <div class="jumbotron">
        <div class="container">  
            <h1 class="display-3"></h1>	
            <p></p><center><h1>Registracija</h1></center><p></p>
        </div>
    </div>
    <!-- Bootstrap -->
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>	
    <div style="text-align:left"
         <div id="login-form">
            <form method="post">
                <table align="center" width="30%" border="0">
                    <tr>
                        <td><input type="text" name="uname" class="form-control" placeholder="Vartotojo vardas" minlength="4" required/></td>
                    </tr>
                    <tr>
                        <td><input type="password" name="pass" class="form-control" placeholder="Slaptažodis" minlength="6" required/></td>
                    </tr>
                    <tr>
                        <td><input type="email" name="mail" class="form-control" placeholder="El. Paštas" minlength="4" required/></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="fname" class="form-control" placeholder="Vardas" minlength="3" /></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="lname" class="form-control" placeholder="Pavardė" minlength="3" /></td>
                    </tr>
                    <tr>
                        <td><input type="number" name="age"  min="7" max="99" class="form-control" placeholder="Amžius" /></td>
                    </tr>
                    <tr>
                        <td><input type="text" name="country" class="form-control" placeholder="Šalis" minlength="4"/></td>
                    </tr>
                    <tr>
                        <td> <input type="radio" name="gender" value="Vyras" checked>
                            Vyras 
                            <input type="radio" name="gender" value="Moteris" checked>
                            Moteris
                        </td>
                    </tr>  
                    <tr>
                    <br>
                    <tr>
                        <td><br><button type="submit" name="btn-signup" class="btn btn-block btn-danger btn-lg">Registruotis</button></td>
                    </tr>
                    <tr>
                        <td><a href="index.php">Grįžti</a></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
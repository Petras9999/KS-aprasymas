<?php 
//tikrinimas (ar vartotojas buna pridetas i privatu kambari)
session_start();
ini_set('display_errors', 0);
include_once 'dbconnect.php';
$guestname=$_SESSION['username'];
                               if ($_SESSION['username'] =='')
                               {
								if($_SESSION['private']==$_SESSION['user'])
								   {
								Echo "<a href=privateroom.php> Mano pokalbių kambarys";   
								   }
								else
								   {
								      $resultuser = mysql_query("SELECT * FROM is_in_private WHERE user_id=" . $_SESSION['user']);
                                      $resultuserRow = mysql_fetch_array($resultuser);	
                                      $inprivate = $resultuserRow['inprivate'];	
                                      if($inprivate==0)
								        {								
                                          Echo "<a href=createprivatechat.php> Kurti pokalbių kambarį"; 
								        }
								      else
								        {
								         Echo "<a href=room.php> Privatus kambarys";
                                         if	($_SESSION['check'] ==0)
										   {
											 echo '<script type="text/javascript">alert("Buvote pridėtas į privatų kambarį"); </script>';
											  $_SESSION['check']=1;	 
	                                       }		 									
								        } 
								   }							   		   
                               }
							   else
							   {
							     $resultguest = mysql_query("SELECT * FROM is_in_private_guest WHERE guestname='$guestname'");
                                 $resultguestRow = mysql_fetch_array($resultguest);	
                                 $inprivate2 = $resultguestRow['inprivate'];
								 if ($inprivate2==1)
								 {									
								 Echo "<a href=room.php> Privatus kambarys";                         
                                  if($_SESSION['check'] ==0)
									{
								      echo '<script type="text/javascript">alert("Buvote pridėtas į privatų kambarį"); </script>';
								      $_SESSION['check']=1;	 
	                              }								 
								 }								 
							   }
                               ?>
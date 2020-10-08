<?php
session_start();
$now=date('Y-m-d');
$c_date="2016-01-31";
	$_SESSION['not_expired']="";
if($now==$c_date){
	
	header("Location: Expiredpage.php");
	
}
else{
	$_SESSION['not_expired']="yes";
	 header("Location: app/main.php");
 }
?>

<?php
session_start();

if(!isset($_SESSION['user_']))
{
	header("Location: index.php");
}
else if(isset($_SESSION['user_'])!="")
{
	header("Location: home.php");
}
if(isset($_GET['logout']))
{
	//session_destroy();
	unset($_SESSION['user_']);
	//$_SESSION['not_expired']="";
	header("Location: index.php");
}
?>
<?php
session_start();
include '../common/inc.common.php';

$emailErr="";
$email="";
if($_SESSION['not_expired']=="yes"){
	if(isset($_SESSION['user_'])!="")
{
	 header("Location:main.php");
}

if(isset($_POST['btn-login']))
{	
	$s_empid = $_REQUEST['s_empid'];
 	$upass =$_REQUEST['pass'];
   $type = $_REQUEST['type'];
	//$res=mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");
	//$row=mysqli_fetch_array($res);
	

$tableName = "staff";
$cond = "WHERE s_empid='$s_empid'";
$row = $Cobj->getDataRawObj($tableName, $cond);
	//echo sizeof($row);
	//print_r($row);exit();
	
	// we had md5 for encryption if($row[0]['password']==md5($upass))
	if($row[0]['password']==($upass))
	{
		$_SESSION['user_'] = $row[0]['s_name'];
		$_SESSION['s_empid'] = $row[0]['s_empid'];
		$_SESSION['type'] = 1;
		//$_SESSION['login_type'] = "admin";
		
	    header("Location:main.php");
	}
	else
	{
		?>
        <script>alert('Invalid Login details');</script>
        <?php
	}
	
}
}
if($_SESSION['not_expired']==""){
	 header("Location:../Expiredpage.php");
}
?>

<!DOCTYPE html>
<html lang="ja-jp">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
 <link rel="shortcut icon" href="image001.ico" type="image/png/icon">
<link rel="stylesheet" href="style.css" type="text/css">
<title> Menu - セルフオーダー マネージャー</title> 
</head>
<body>

<div class="container">

	<center><img class="logo" src="../../images/h_logo.png" alt=""></center>

	<div id="login-form" class="card" style="background-image: url('../../images/h_logo.png');">
	<h2>セルフオーダー マネージャー</h2>

		<form method="post" autocomplete="off">

				<div class="input-border">
				<input type="text" name="s_empid" class="text" required /> <span class="error"> <?php echo $emailErr;?></span>
				<label>ID</label>
				<div class="border"></div>
				</div>

				<div class="input-border">
				<input type="password" name="pass" class="text" required />
				<label>Password</label>
				<div class="border"></div>
				</div>

					<div class="form-group">
									<div class="" >
														<SELECT   NAME='type' id="type" class="form-control select select-primary" data-toggle="select" data-toggle="select" >
															<OPTION VALUE=3 >他のユーザー</OPTION>
															<OPTION VALUE=1 >ADMIN</OPTION>
														</SELECT>
									</div>
					</div>

			<input type="submit" name="btn-login" class="btn" value="Log in" >
		</form>
	</div>
</div>
<!---------------------------------------------------------------------------------------->

<div class="bottomfooter">
        <span> ® <script type="text/javascript">
            document.write(new Date().getFullYear());
          </script> Yunokawa Prince Hotel Nagisatei • All Rights Reserved</span>
</div>
</body>
</html>
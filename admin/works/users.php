
<?php

session_start();
include '../common/inc.common.php';
//print_r($_SESSION);
if(isset($_REQUEST['si_id'])){
$si_id = $_REQUEST['si_id'];
$tableName = "staff";
$cond = "WHERE s_empid='$si_id'";
$dataarr = $Cobj->getDataRawObj($tableName, $cond);
}
?>


<script type="text/javascript">
    
	$(document).ready(function(){
	var frm = $('#contactForm1');

    frm.submit(function (e) {

        e.preventDefault();// to prevent the origibnal form submit

        $.ajax({
          	url: "../works/users_info.php", // Url to which the request is send
				type: "POST",             // Type of request to be send, called as method
				data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
				contentType: false,       // The content type used when sending data to the server.
				cache: false,             // To unable request pages to be cached
				processData:false,
           // data: frm.serialize(),
            success: function (data) {
			edit(data);
                console.log('Submission was successful.');
                console.log(data);
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
        });
    });
	});
	
	
	function edit(data){
	alert(data);
	//location.reload('../app/index.php');
	//window.location.href = '../clients/size.php';
	loadContainer('../works/users.php');
	}
	
function delet(id){


		var r = confirm("Please Confirm");
	 
		if (r == true) {
			$.ajax({
			url: "../works/can_size.php", // Url to which the request is send
			type: "POST",        
			data:"id="+id+"&mode=delete",
				 dataType: "json",
			
				  success: function(data){
					 // alert(data);
					  if(data=="deleted"){
						  alert("deleted sucessfully");
						  }
					  else{
						  alert("DELETED SUCESSFULLY");
						  //location.reload();
						  	loadContainer('../works/users.php');
					  }
				  }
			
		});
		

}
}
	
function sub_cat(){
var ss_mc_id=$("#si_mc_id").val();

   $.ajax({
type: "POST",
url: "../fetch/fetch_sub_cat.php",
data: "ss_mc_id="+ss_mc_id,
cache: false,

success: function(html) {    
$("#sub_cat").html( html );
}
});
		
	}		
	
	
</script>









<!DOCTYPE html>
<html lang="ja" class="no-js">
	<!--<![endif]-->
	<!-- start: HEAD -->
	<head>
		<title>STAFF</title>
		<!-- start: META -->
		<meta charset="UTF-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link rel="stylesheet" href="admin/app/style.css" type="text/css">
		
		<!-- end: META -->		
		<link rel="shortcut icon" href="favicon.ico" />
			<style>
			.has-error{ border: 1px solid rgb(213, 61, 61) !important; background: #FFF4F4 !important;}
			.has-success{ border: 1px solid #239E08 !important; background: #E1FFE1 !important; }
		
			</style>
	</head>

	<body>

			<form action="clients/addStudentInfo.php" name="contactForm1"  id="contactForm1" method="POST" style="margin-left:2%">

				<div id="main">
				<h1>Staff</h1>

					<h3 style="text-align: center;">追加</h3>

					<table>

					<tr>
						<td> ユーザーCD</td> 
						<td><input type="text" name="s_empid" id="s_empid" size="30" value="<?php echo$dataarr[0]['s_empid'] ?>" required></td>
					</tr>

					<tr>
						<td>氏名</td>
						<td><input type="text" name="s_name" id="s_name" size="30" value="<?php echo$dataarr[0]['s_name'] ?>" required></td>
					</tr> 


					<tr>
						<td> 電話番号</td> 
						<td><input type="text" name="s_mobile" id="s_mobile" size="30" value="<?php echo$dataarr[0]['s_mobile'] ?>" required></td>
					</tr>
					<tr>
						<td> パスワード </td> 
						<td><input type="password" name="password" id="password" size="30" value="<?php echo$dataarr[0]['password'] ?>" required> </td>
					</tr>



					<tr>
						<td></td>
					<td>
					<input type="text" readonly hidden value="<?php echo $dataarr[0]['s_empid']?>" name="si_id">
					</td>
					</tr>
					</table>

							<div style="margin-top:20px;">
								<input type="submit" value="Submit Form" />
								<input type="button" onclick="loadContainer('../works/users.php')" value='refresh' class="refresh-btn"/>
							</div>
			</form>

		
		
		<div style="margin-top: 20px;">
		
				<table cellpadding="2px" cellspacing="2px"  width="90%" height="5px" style="background: whitesmoke;">
				
				<tr style="background:#76BAC5; font-size:16px;"><th style="padding-left:20px;">Ref.No </th><th>ユーザーCD</th><th>氏名</th><th>電話番号</th> <th> <th>変更</th><th>削除</th> </th></tr>
				
											<?php
											
											$tableName = "size";
											$cond = "WHERE si_stat='A'";
											//$class_array = $Cobj->getDataRawObj($tableName, $cond);

											$sql="select * from staff";
											$class_array = $Cobj->union($sql);

											//print_r(count($class_array));exit();
											for($i=0;$i<count($class_array);$i++){
												$id=$class_array[$i]['s_empid'];
												
												$sno=$i+1;
												echo "<tr>";
												echo "<td  style='padding-left:20px;'>".$sno ."  </td>";
												echo "<td>".$class_array[$i]['s_empid']."  </td>";
												echo "<td>".$class_array[$i]['s_name']."  </td>";
												echo "<td>".$class_array[$i]['s_mobile']."  </td>";

												echo "<td style='float:right;'>
											
												<td><a href=javascript:loadContainer('../works/users.php?si_id=".$class_array[$i]['s_empid']."')>
												<img src='../assets/nithin/images/pencil.png' height='15' width='15' ></a> &nbsp;&nbsp;&nbsp;&nbsp;</td>";
												echo "<td><input type='image' src='../assets/nithin/images/close.png''  name='delete' id='delete' value='' onclick='delet($id)'> </td></td>";
												echo "</tr>";
											}
											
											?>
				
				</table>
		</div>

	 
	  
	  
	  
    </div>
	</body>
	<!-- end: BODY -->
</html>
	
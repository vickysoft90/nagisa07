<?php
session_start();
include '../common/inc.common.php';
//print_r($_SESSION);
if(isset($_REQUEST['si_id'])){
$si_id = $_REQUEST['si_id'];
$tableName = "drinks";
$cond = "WHERE d_refid='$si_id'";
$dataarr = $Cobj->getDataRawObj($tableName, $cond);
}
?>


<script type="text/javascript">
    
	$(document).ready(function(){
	var frm = $('#contactForm1');

    frm.submit(function (e) {

        e.preventDefault();// to prevent the origibnal form submit

        $.ajax({
          	url: "../drinks/drinks_listinfo.php", // Url to which the request is sent
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
	loadContainer('../drinks/drinks_list.php');
	}
	
function delet(id){


		var r = confirm("Please Confirm");
	 
		if (r == true) {
			$.ajax({
			url: "../drinks/can_size_drinks.php", // Url to which the request is sent
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
						  	loadContainer('../drinks/drinks_list.php');
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
		<title>Drinks</title>
		<!-- start: META -->
		<meta charset="utf-8" />
		<!--[if IE]><meta http-equiv='X-UA-Compatible' content="IE=edge,IE=9,IE=8,chrome=1" /><![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<meta name="apple-mobile-web-app-status-bar-style" content="black">
		<meta content="" name="description" />
		<meta content="" name="author" />
		<link rel="stylesheet" href="admin/style.css" type="text/css">
		
		<!-- end: META -->		
		<link rel="shortcut icon" href="favicon.ico" />
		<style>
		   .has-error{ border: 1px solid rgb(213, 61, 61) !important; background: #FFF4F4 !important;}
		   .has-success{ border: 1px solid #239E08 !important; background: #E1FFE1 !important; }
	   
		</style>

  
  
	</head>

	<body>

		<form action="drink_listinfo.php" name="contactForm1"  id="contactForm1" method="POST"enctype="multipart/form-data" style="margin-left: 2%;">
			<div id="main">
			<h1>Drinks</h1>

		<h3 style="text-align: center;">Modify</h3>

		<table>

		<tr>
			<td>CD1</td> 
			<td><input type="text" name="CD1" id="CD1" size="20" value="<?php echo$dataarr[0]['CD1'] ?>" required></td>
		</tr>

		<tr>
		<td>CD2</td>
		<td><input type="text" name="CD2" id="CD2" size="20" value="<?php echo$dataarr[0]['CD2'] ?>" required></td>
		</tr> 

		<tr>
			<td>Product name</td> 
			<td><input type="text" name="product" id="product" size="30" value="<?php echo$dataarr[0]['product'] ?>" required></td>
		</tr>
		<tr>
			<td> Price </td> 
			<td><input type="number" name="price" id="price" size="10" value="<?php echo$dataarr[0]['price'] ?>" required> </td>
		</tr>

		<tr>
			<td> Category </td> 
			<td><input type="text" name="category" id="category" size="30" value="<?php echo$dataarr[0]['category'] ?>" required> </td>
		</tr>

		<tr>
			<td> stock </td> 
			<td><select id="stock" name="stock" required>
				<?php 
				if ($dataarr[0]['stock']=='可用') { echo "<option selected='selected' value=" . $dataarr[0]['stock'] .">可用</option> <option value='品切れ'>品切れ</option>"; }
				elseif ($dataarr[0]['stock']=='品切れ') {  echo "<option selected='selected' value='品切れ'>品切れ</option><option value='可用'>可用</option> "; }
				else { echo "<option selected='selected' value=''></option><option value=" . $dataarr[0]['stock'] .">可用</option> <option value='品切れ'>品切れ</option>";}
				?>
			</select></td>
		</tr>

		<tr>
			<td> Drink description </td> 
			<td><input type="text" name="drinkinfo" id="drinkinfo" size="30" value="<?php echo$dataarr[0]['drinkinfo'] ?>" required> </td>
		</tr>

		<tr>
			<td> Drink image </td> 
			<td><input type="file" name="file" id="productimage" value="<?php echo $dataarr[0]['productimage'] ?>" > </td>
		</tr>



		<tr>
			<td></td>

			<td>
			<input type="text" readonly hidden value="<?php echo $dataarr[0]['d_refid']?>" name="si_id">
			</td>
		</tr>

		</table>
				<div style="margin-top: 20px;">
				<input type="submit" value="登録" name="but_upload"/>
				<input type="button" onclick="loadContainer('../drinks/drinks_list.php','Filter student')" value='Refresh' />
				</div>
		</form>
	 

	 

		</form>
		
		<div style="margin-top: 20px;">
		
		<table  width="99%" height="10px" style="background: whitesmoke; margin-bottom:30px; ">
		
		<tr style="background:#ecdfa8; font-size:16px;"><th  style='padding-left:20px; width:8%;'>Ref </th><th style="width: 8%;">CD1</th><th style="width: 8%;">CD2</th><th>Name</th><th>Price</th><th>Category</th><th>Stock</th><th style="width: 20%;">Description</th><th style="width: 10%;">Image</th>  <th> <th>変更</th><th>削除</th> </th></tr>
		<?php
		
//$tableName = "size";
//$cond = "WHERE si_stat='A'";
//$class_array = $Cobj->getDataRawObj($tableName, $cond);

$sql="select * from drinks";
 $class_array = $Cobj->union($sql);

		//print_r(count($class_array));exit();
		for($i=0;$i<count($class_array);$i++){
			$id=$class_array[$i]['d_refid'];
			
			$sno=$i+1;
			echo "<tr>";
			echo "<td  style='padding-left:20px;'>".$sno ."  </td>";
			echo "<td>".$class_array[$i]['CD1']."  </td>";
		    echo "<td>".$class_array[$i]['CD2']."  </td>";
            echo "<td>".$class_array[$i]['product']."  </td>";
            echo "<td>".$class_array[$i]['price']."  </td>";
            echo "<td>".$class_array[$i]['category']."  </td>";
            echo "<td>".$class_array[$i]['stock']."  </td>";
            echo "<td>".$class_array[$i]['drinkinfo']."  </td>";
			echo "<td>".$class_array[$i]['productimage']."  </td>";

			echo "<td style='float:right;'>
			<td><a href=javascript:loadContainer('../drinks/drinks_list.php?si_id=".$class_array[$i]['d_refid']."')>
			<img src='../assets/nithin/images/pencil.png' height='15' width='15' ></a> &nbsp;&nbsp;&nbsp;&nbsp;</td>";
			echo "<td><input type='image' src='../assets/nithin/images/close.png' height='' width='' name='delete' id='delete' value='' onclick='delet($id)'></td></td>";
			echo "</tr>";
		}
		
		?>
		
		</table>
		</div>

	 
	  
	  
	  
    </div>
	</body>
	<!-- end: BODY -->
</html>
	
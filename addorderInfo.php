<?php
session_start();
header("Content-Type: text/html; charset=UTF-8");  

include 'common/inc.common.php';
//if(isset($_SESSION['us_id_add'])){
	
	$sql="select max(or_order_id) oderid  from confirmedorders";
	$colarr = $Cobj->union($sql);
	$oderid=$colarr[0]['oderid'];
	$oderid=$oderid+1;
   
  $prd_room=$_POST['roomno'];
  $prd_guest=$_POST['guestname'];
 $prd_name=$_POST['prd_name'];
 $pro_prc=$_POST['pro_prc'];
 $qty=$_POST['qty'];
 
 for($t=0;$t<sizeof($qty);$t++){
 $InputArr['productname']=$prd_name[$t];
 $InputArr['productprice']=$pro_prc[$t];
  $InputArr['productquantity']=$qty[$t];
  
  //json_encode($data, JSON_UNESCAPED_UNICODE);

    $InputArr['or_order_id']=$oderid;
    $InputArr['or_userid']=$_SESSION['useridmap'];
   $InputArr['order_notes']=$_POST['order_notes'];
   $InputArr['guestname']=$_POST['guestname'];
   $InputArr['roomno']=$_POST['roomno'];
   $InputArr['tableno']=$_POST['tableno'];
    $res = $Cobj->addNewData("confirmedorders", $InputArr, "");
	 
 }
 
 echo json_encode($oderid);

//}


?>

<?php
session_start();
include '../common/inc.common.php';

$status=$_POST['status'];
$ordate=$_POST['ordate'];

$login_type=$_SESSION['type'];
//$user_id=$_SESSION['user_id'];
$limit_start=0;
$limit_end=$_POST['tb_size'];
$page_number=$_POST['page_number'];
$search=$_POST['search'];
  $src="";
if($search!="")
{  $src .=" and ( c_name like '%$search%' or or_order_id like '%$search%' ) ";}


if($page_number!="0")
{
	$limit_start=$page_number*$limit_end;
	$limit_end=$limit_end;
	
}
if($page_number==0){
$limit_start=0;
$limit_end=$_POST['tb_size'];
}
//for new conditons stock_size,colour,or_itemname,or_qty,or_order_id,or_update,or_phone,or_refid,or_userid,or_itemrefid
$whr ="";
if($ordate!=""){
	//$whr .=" and updated =";
		$whr .= " and  DATE(updated) = '$ordate' ";

}



$sql="SELECT * from confirmedorders 

 where or_stat='A' $whr $src
 
ORDER BY or_order_id desc
LIMIT $limit_start , $limit_end";

/*
$sql="SELECT t1 . * , brand.*,main_category.*,sub_category.*,product.*
FROM (
SELECT *
FROM stock where st_stat='A'
)t1
left outer join product on t1.st_pr_id=product.pr_id
left outer join main_category on product.pr_mc_id=main_category.mc_id
left outer join sub_category on product.pr_sc_id=sub_category.sc_id 
left outer join brand on product.pr_br_id=brand.br_id

 where st_stat='A' $whr $src

ORDER BY pr_id
LIMIT $limit_start , $limit_end";
*/
 $SectionArray = $Cobj->union($sql);
 


 
 
echo json_encode($SectionArray);
//print_r($SectionArray);
?>
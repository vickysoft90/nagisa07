

<?php

session_start();
//print_r($_SESSION);
if($_SESSION['not_expired']=="yes"){

include'../common/inc.config.php';
 function DateFormat($value)
{
	if($value != "0000-00-00" &&  !empty($value))	
		return date('d-m-Y', strtotime($value));
	else
		return "";
}

$completed_refid=$_REQUEST['completed_refid'];
$type=$_REQUEST['type'];
$priority=$_REQUEST['priority'];
$current_date=$_REQUEST['intervals'];
$whr='';
$whrr="";
if($completed_refid!=''){
$whr .="  and  completed_refid=$completed_refid ";
$whrr .="  and  bill_by_refid=$completed_refid ";

}
if($type!=0){
$whr .="  and  type=$type ";
}
if($priority!=0){
$whr .="  and  priority=$priority ";
}

$att='';
$current_datee=date('Y-m-d');
if($current_date=='day'){
	$whrr .= " and  DATE(a.updated) = '$current_datee' ";
	$whr .= " and  DATE(completed_date) = DATE(NOW())";
	$att .=" and  DATE(dated) = DATE(NOW())";
}
if($current_date=='week'){
	$whrr .= " and  a.updated > DATE_SUB('$current_datee', INTERVAL 7 DAY) ";
	$whr .= " and  YEARWEEK(`completed_date`, 1) = YEARWEEK(CURDATE(), 1)";
	$att .= " and  YEARWEEK(`dated`, 1) = YEARWEEK(CURDATE(), 1)";
}
if($current_date=='month'){
$DD=DATE('m');
	$whrr .= " and a.updated >= DATE_SUB('$current_datee', INTERVAL 1 MONTH) ";
		$whr .= " and MONTH(completed_date)= $DD ";
		$att .=" and MONTH(dated)= $DD ";
}
if($current_date=='year'){
$DD=DATE('Y');
	$whrr .= " and a.updated >= DATE_SUB('$current_datee', INTERVAL 1 year) ";
		$whr .= " and YEAR(completed_date)= $DD ";
		$att .= " and YEAR(dated)= $DD ";
}

$sql="select * from clients
left join users on users.user_id=clients.user_id

 where clients.stat='A' $whr order by completed_date";

$res=mysqli_query($conn,$sql);
//$row=mysqli_fetch_array($res);

require('fpdf.php');




//INSERT INTO invoice(invoice_ref_id,product_ref_id,qty,amount)
//VALUES ($last_id,$productID,$qty,$amt),
      // ('Task 2','2010-01-01','2010-01-02','Description 2'),
      // ('Task 3','2010-01-01','2010-01-02','Description 3');
 
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
//$pdf->Setx(20);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(20,15,'','LBT','','');
$pdf->Cell(95,15,'BWDA FINANCE LTD.','BT','','');
$pdf->Setx(41);
$pdf->SetFont('Arial','',10);
$pdf->Cell(84,25,',','','','');
$pdf->SetFont('Arial','',10);
//$pdf->Setx(30);
$pdf->MultiCell(81,5,'BWDA FINANCE LIMITED,
Near Reddiyar Mill,
Villupuram-DT.','BRT','C','');
$pdf->ln(1);
//$pdf->Setx(20);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(10,10,'S.NO','LBTR','','C');
$pdf->Cell(14,10,'COM_NO','LBTR','','C');
$pdf->Cell(28,10,'NAME','LBTR','','C');
$pdf->Cell(14,10,'HOURS','LBTR','','C');
$pdf->Cell(30,10,'COMPLETED BY','LBTR','','C');
$pdf->Cell(20,10,'DATE ','LBTR','','C');
$pdf->Cell(80,10,'DESCRIPTION','LBTR','','C');
//$pdf->Cell(10,10,'QTY','LBTR','','C');

//$pdf->Cell(10,10,'VAT','LBTR','','C');
//
$sno=1;
$pdf->ln(10);

$compno='';
//$name=$_REQUEST['name'];
while($row=mysqli_fetch_array($res)){

//$pdf->Setx(20);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(10,10,$sno,'LBTR','','C');
$pdf->Cell(14,10,$row['refid'],'LBTR','','C');
$adname=$row['name'];
$adname=strtolower($adname);
$adname=ucfirst($adname);
$pdf->Cell(28,10,$adname,'LBTR','','');
$pdf->Cell(14,10,$row['hours'].":".$row['min'],'LBTR','','C');
$pdf->Cell(30,10,$row['completed_by'],'LBTR','','C');
$pdf->Cell(20,10,DateFormat($row['completed_date']),'LBTR','','C');
$arr=trim($row['description']);
$arr=strtolower($arr);
$arr=ucfirst($arr);
$len=strlen($arr);
if($len>80){
	$nam=str_split($arr, 80);
	$na=$nam[0];
	
	$pr=strripos($na," ");
	$p1=strripos($na," ");
	if($p1=="79"){
	$first = substr($arr, 0, 80);
	$new_add_s_l = substr($arr, 81);	
	}else	{
		$first = substr($arr, 0, $p1+1);
		$new_add_s_l = substr($arr, $p1+1);
	}
}else{
$first = $arr;
		$new_add_s_l = "";
}

$pdf->Cell(80,5,$first,'LTR','','');
$pdf->ln();
$pdf->setX(126);
$pdf->Cell(80,5,$new_add_s_l,'LBR','','');
//$pdf->Cell(30,10,DateFormat($row['exp_date']),'LBTR','','C');
//$pdf->Cell(10,10,$row['vat'],'LBTR','','C');
$pdf->ln();
$sno=$sno+1;

$compno .= $row['refid'].',';
}

$compn=trim($compno,',');
$RR='';
if($completed_refid!=''){
$RR .="  and  admin_id=$completed_refid ";
}
IF($compn!=''){$RR .= " and attempts.clients_refid in($compn) ";}

//************************************************ for attempts
$sql="select * from attempts
where stat='A'  $RR $att
ORDER BY refid desc";
$res=mysqli_query($conn,$sql);

$pdf->ln(10);


$pdf->SetFont('Arial','',10);
//$pdf->Setx(30);

//$pdf->ln(20);
//$pdf->Setx(20);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(106,10,'  ATTEMPTS REPORT ','LBTR','','');
$pdf->ln(10);
//$pdf->Setx(20);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(10,10,'S.NO','LBTR','','C');
$pdf->Cell(14,10,'COM_NO','LBTR','','C');
$pdf->Cell(28,10,'ADMIN NAME','LBTR','','C');
//$pdf->Cell(25,10,'UNIT PRICE','LBTR','','C');
$pdf->Cell(14,10,'HOURS','LBTR','','C');
$pdf->Cell(10,10,'VISITS','LBTR','','C');
$pdf->Cell(20,10,'DATED','LBTR','','C');
$pdf->Cell(100,10,'REVIEWS','LBTR','','C');

$pdf->SetFont('Arial','',8);
$pdf->ln(10);
$sno=1;
while($row=mysqli_fetch_array($res)){
if($row['visit']==1){$a="Direct";}else{$a='Online';}
$adname=$row['admin_name'];
$adname=strtolower($adname);
$adname=ucfirst($adname);
$arr=trim($row['reviews']);
$arr=strtolower($arr);
$arr=ucfirst($arr);
$len=strlen($arr);
$len=strlen($arr);
if($len>80){
	$nam=str_split($arr, 80);
	$na=$nam[0];
	
	$pr=strripos($na," ");
	$p1=strripos($na," ");
	if($p1=="79"){
	$first = substr($arr, 0, 80);
	$new_add_s_l = substr($arr, 81);	
	}else	{
		$first = substr($arr, 0, $p1+1);
		$new_add_s_l = substr($arr, $p1+1);
	}
}else{
$first = $arr;
		$new_add_s_l = "";
}
//$pdf->Setx(20);
//$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,$sno,'LBTR','','C');
$pdf->Cell(14,10,$row['clients_refid'],'LBTR','','R');
$pdf->Cell(28,10,$adname,'LBTR','','L');
$pdf->Cell(14,10,$row['hours'].":".$row['min'],'LBTR','','R');
$pdf->Cell(10,10,$a,'LBTR','','R');
$pdf->Cell(20,10,$row['dated'],'LBTR','','C');
$pdf->Cell(100,5,$first,'LTR','','L');
$pdf->ln();
$pdf->setX(106);
$pdf->Cell(100,5,$new_add_s_l,'LBR','','L');
$pdf->ln();
$sno=$sno+1;
//$compno .= $row['refid'].',';

}

//
$pdf->ln(10);
$pdf->Setx(20);
$pdf->Cell(110,10,'COMPLETED REPORT.','','','');

$pdf->AddPage();
$pdf->ln(10);
$pdf->Setx(20);
$pdf->Cell(110,10,'BILLING REPORT.','','','');

$sql="select * from invoice a 
left join invoice_details  b on b.invoice_ref_id=a.ref_id
left join  tb_products  c on c.productID=b.product_ref_id
where a.stat='A' $whrr
 ";
$res=mysqli_query($conn,$sql);
$sno=1;
$pdf->ln(12);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,'S.NO','LBTR','','C');
$pdf->Cell(70,10,'NAME','LBTR','','C');
//$pdf->Cell(25,10,'UNIT PRICE','LBTR','','C');
$pdf->Cell(10,10,'QTY','LBTR','','C');
$pdf->Cell(30,10,'BILL BY','LBTR','','C');
$pdf->Cell(30,10,'BILL NO','LBTR','','C');
$pdf->Cell(35,10,'UPDATED','LBTR','','C');
//$pdf->Cell(30,10,'MFG','LBTR','','C');$pdf->Cell(30,10,'EXP','LBTR','','C');$pdf->Cell(10,10,'VAT','LBTR','','C');
//
//$sno=1;
$pdf->ln(10);
$b='';
while($row=mysqli_fetch_array($res)){
$a=$row['invoice_ref_id'];
$b .= $a.",";

//$pdf->Setx(20);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,$sno,'LBTR','','C');
$pdf->Cell(70,10,strtoupper($row['name']."-".$row['brand_name']),'LBTR','','');
//$pdf->Cell(25,10,$row['price'],'LBTR','','C');
$pdf->Cell(10,10,$row['qty'],'LBTR','','C');
//$pdf->Cell(30,10,DateFormat($row['mfg_date']),'LBTR','','C');
$pdf->Cell(30,10,$row['bill_by'],'LBTR','','C');
$pdf->Cell(30,10,$row['invoice_ref_id'],'LBTR','','C');
$pdf->Cell(35,10,$row['updated'],'LBTR','','C');
//$pdf->Cell(10,10,$row['vat'],'LBTR','','C');
$pdf->ln(10);
$sno=$sno+1;
}


$pdf->Cell(60,10,'Powered by codeomega - IT SERVICES.','','','C');



$pdf->Output('enggreport.pdf','I');
}

?>
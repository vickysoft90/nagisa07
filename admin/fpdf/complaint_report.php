

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


$user_id=$_REQUEST['user_id'];
$clientname=$_REQUEST['clientname'];
$current_date=$_REQUEST['intervals'];

$whr='';
if($current_date=='day'){
	//$whr .= " and  DATE(b.updated) = '$current_date' ";
	$whr .= " and  DATE(dated) = DATE(NOW())";
}
if($current_date=='week'){
	//$whr .= " and  b.updated > DATE_SUB('$current_date', INTERVAL 7 DAY) ";
	$whr .= " and  YEARWEEK(`dated`, 1) = YEARWEEK(CURDATE(), 1)";
}
if($current_date=='month'){
$DD=DATE('m');
	//$whr .= " and b.updated >= DATE_SUB('$current_date', INTERVAL 1 MONTH) ";
		$whr .= " and MONTH(dated)= $DD ";
}
if($current_date=='year'){
$DD=DATE('Y');
	//$whr .= " and b.updated >= DATE_SUB('$current_date', INTERVAL 1 MONTH) ";
		$whr .= " and YEAR(dated)= $DD ";
}

//$resl=mysqli_query($conn,$sqll);


$sql=" select * from clients
		where stat='A' and user_id=$user_id $whr 
		ORDER BY dated desc";

$res=mysqli_query($conn,$sql);
//$row=mysqli_fetch_array($res);

require('fpdf.php');




//INSERT INTO invoice(invoice_ref_id,product_ref_id,qty,amount)
//VALUES ($last_id,$productID,$qty,$amt),
      // ('Task 2','2010-01-01','2010-01-02','Description 2'),
      // ('Task 3','2010-01-01','2010-01-02','Description 3');
 
$pdf = new FPDF('L','mm','A4');
$pdf->AddPage();
$pdf->Setx(20);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(20,15,'','LBT','','');
$pdf->Cell(120,15,'BWDA -IT REQUEST ','BTR','','');
$pdf->Cell(112,15,'COMPLAINTS REPORT.','BTR','','');
$pdf->Setx(41);
$pdf->SetFont('Arial','',10);
$pdf->Cell(84,25,',','','','');
$pdf->SetFont('Arial','',10);
//$pdf->Setx(30);

$pdf->ln(20);
$pdf->Setx(20);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(252,10,'  BRANCH NAME  :    '.$clientname,'LBTR','','');
$pdf->ln(10);
$pdf->Setx(20);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,'S.NO','LBTR','','C');
$pdf->Cell(17,10,'COM_NO','LBTR','','C');
//$pdf->Cell(25,10,'UNIT PRICE','LBTR','','C');
$pdf->Cell(20,10,'DATED','LBTR','','C');
$pdf->Cell(25,10,'COMPLETED','LBTR','','C');
$pdf->Cell(40,10,'COMPLETED BY','LBTR','','C');
$pdf->Cell(15,10,'HOURS','LBTR','','C');
$pdf->Cell(145,10,'DESCRIPTION','LBTR','','C');
//$pdf->Cell(30,10,'EXP','LBTR','','C');$pdf->Cell(10,10,'VAT','LBTR','','C');
//
$sno=1;
$pdf->ln(10);
$compno='';
$pdf->SetFont('Arial','',10);
while($row=mysqli_fetch_array($res)){
$desc=$row['description'] ;
$bb=str_split($desc, 140);
if($row['status']==1){$a="YES";}else{$a='NO';}

$pdf->Setx(20);
//$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,$sno,'LBTR','','C');
$pdf->Cell(17,10,$row['refid'],'LBTR','','R');
//$pdf->Cell(25,10,$row['price'],'LBTR','','C');
//$pdf->Cell(10,10,$row['p_quantity'],'LBTR','','C');
//$pdf->Cell(40,10,$row['created'],'LBTR','','C');
$pdf->Cell(20,10,DateFormat($row['dated']),'LBTR','','C');
$pdf->Cell(25,10,DateFormat($row['completed_date']),'LBTR','','C');
$pdf->Cell(40,10,$row['completed_by'],'LBTR','','C');
$pdf->Cell(15,10,$row['hours'].":".$row['min'],'LBTR','','C');

$pdf->Cell(145,10,ucfirst($bb[0])."...",'LBTR','','');
$pdf->ln(10);
$sno=$sno+1;


$compno .= $row['refid'].',';
}
$compn=trim($compno,',');
if($compn==''){$compn='-1';}else{$compn=$compn;}
//for invoice report*******************************************************************************
$sql="select * from invoice
where invoice.client_refid in($compn)
ORDER BY ref_id desc";
$res=mysqli_query($conn,$sql);

$pdf->ln(10);


$pdf->SetFont('Arial','',10);
//$pdf->Setx(30);

//$pdf->ln(20);
$pdf->Setx(20);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(106,10,'  BILLING REPORT ','LBTR','','');
$pdf->ln(10);
$pdf->Setx(20);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,'S.NO','LBTR','','C');
$pdf->Cell(17,10,'COM_NO','LBTR','','C');
$pdf->Cell(17,10,'BILLNO','LBTR','','C');
//$pdf->Cell(25,10,'UNIT PRICE','LBTR','','C');
$pdf->Cell(17,10,'AMOUNT','LBTR','','C');
$pdf->Cell(45,10,'BILL BY','LBTR','','C');
$pdf->Cell(40,10,'UPDATED','LBTR','','C');
$pdf->SetFont('Arial','',10);
$pdf->ln(10);
$sno=1;
while($row=mysqli_fetch_array($res)){
//if($row['status']==1){$a="YES";}else{$a='NO';}

$pdf->Setx(20);
//$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,$sno,'LBTR','','C');
$pdf->Cell(17,10,$row['client_refid'],'LBTR','','R');
$pdf->Cell(17,10,$row['ref_id'],'LBTR','','R');
$pdf->Cell(17,10,$row['grand_total'],'LBTR','','R');
$pdf->Cell(45,10,$row['bill_by'],'LBTR','','R');
$pdf->Cell(40,10,$row['updated'],'LBTR','','R');


$pdf->ln(10);
$sno=$sno+1;


//$compno .= $row['refid'].',';
}

//*************************************************for attempts


 $sql="select * from attempts
where attempts.clients_refid in($compn)
ORDER BY refid desc";
$res=mysqli_query($conn,$sql);

$pdf->ln(10);


$pdf->SetFont('Arial','',10);
//$pdf->Setx(30);

//$pdf->ln(20);
$pdf->Setx(20);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(102,10,'  ATTEMPTS REPORT ','LBTR','','');
$pdf->ln(10);
$pdf->Setx(20);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,'S.NO','LBTR','','C');
$pdf->Cell(17,10,'COM_NO','LBTR','','C');
$pdf->Cell(50,10,'ADMIN NAME','LBTR','','C');
$pdf->Cell(25,10,'HOURS WORK','LBTR','','C');
$pdf->Cell(70,10,'REVIEWS','LBTR','','C');
$pdf->Cell(15,10,'VISITS','LBTR','','C');
$pdf->Cell(20,10,'DATED','LBTR','','C');
$pdf->SetFont('Arial','',10);
$pdf->ln(10);
$sno=1;
while($row=mysqli_fetch_array($res)){

if($row['visit']==1){$a="Direct";}else{$a='Online';}

$pdf->Setx(20);
//$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,$sno,'LBTR','','C');
$pdf->Cell(17,10,$row['clients_refid'],'LBTR','','R');
$pdf->Cell(50,10,$row['admin_name'],'LBTR','','R');
$pdf->Cell(25,10,$row['hours'].":".$row['min'],'LBTR','','C');
$pdf->Cell(70,10,$row['reviews'],'LBTR','','R');
$pdf->Cell(15,10,$a,'LBTR','','R');
$pdf->Cell(20,10,$row['dated'],'LBTR','','R');


$pdf->ln(10);
$sno=$sno+1;


//$compno .= $row['refid'].',';
}



//**************************************
$pdf->ln(10);
$pdf->Setx(20);
$pdf->Cell(110,10,'COMPLAINTS REPORT.','','','');

$pdf->Cell(60,10,'Powered by codeomega - IT SERVICES.','','','C');

$pdf->Output('products.pdf','I');
}

?>
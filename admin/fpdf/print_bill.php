<?php

session_start();
require('fpdf.php');

//print_r($_SESSION);
if($_SESSION['not_expired']=="yes"){
include'../common/inc.config.php';
include '../common/inc.common.php';

$id=$_REQUEST['id'];


$sql="SELECT t1 . * ,guest.*
FROM (
SELECT *
FROM confirmedorders 
)t1
left outer join guest on t1.or_userid=guest.refid
 where or_order_id=$id";
 
$dataarr  = $Cobj->union($sql);

$date=date('d/m/Y');


 
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->AddFont('Baamini','','Baamini.php');	

$pdf->SetFont('Arial','B',16);

$pdf->Cell(190,15,'NAGISA PRINCE HOTEL','LBTR','','C');
$pdf->Setx(46);
$pdf->SetFont('Arial','',10);
$pdf->Cell(84,25,',','','','');
$pdf->SetFont('Arial','',10);
//$pdf->Setx(30);
//$pdf->MultiCell(70,5,'BWDA FINANCE LIMITED,
//Near Reddiyar Mill,
//Villupuram-DT.','BRT','C','');
$pdf->ln(16);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,10,'NAME : ','LBRT','','C');
$pdf->Cell(80,10,$dataarr[0]['c_name'],'LBRT','','L');

$pdf->Cell(30,5,'COM_NO','LBT','','C');//$pdf->Cell(30,5,$date,'BRT','','');
$pdf->setx(110);
$pdf->Cell(30,15,$client_refid,'R','','C');
$pdf->setx(140);
$old_date = $dataarr[0]['updated'];              // returns Saturday, January 30 10 02:06:34
$old_date_timestamp = strtotime($old_date);
$new_date = date('d-m-Y ', $old_date_timestamp);  
$pdf->Cell(30,5,'DATE : ','LBT','','C');$pdf->Cell(30,5,$new_date,'BRT','','');
$pdf->setx(140);
$pdf->Cell(30,15,'INVOICE NO : ','R','','C');$pdf->Cell(30,15,$dataarr[0]['or_order_id'],'R','','');
$pdf->ln(10);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,'S.No.','LBRT','','C');
$pdf->Cell(60,10,'PRODUCT','LBT','','C');
$pdf->Cell(30,10,'PRICE-DISCOUNT','LBT','','C');
$pdf->Cell(30,10,'QUANTITY','LBRT','','C');$pdf->Cell(30,10,'VAT','LBRT','','C');
$pdf->Cell(30,10,'TOTAL','LBRT','','C');
$pdf->SetFont('Arial','',8);
$pdf->ln(10);
for($i=0;$i<sizeof($dataarr);$i++){
	$n=$n+1;
	$amt=$dataarr[$i]['productprice'];
	$qty=$dataarr[$i]['productquantity'];
	$prc=$amt*$qty;
	$txt=$dataarr[$i]['productname'];
	$txt = utf8_decode($txt);

$pdf->Cell(10,10,$n,'LBRT','','C');
        $pdf->SetFont('Baamini','',20);	

$pdf->Cell(60,10,$txt,'LBRT','','L');
$pdf->SetFont('Arial','',8);

$pdf->Cell(30,10,$amt,'LBRT','','C');
$pdf->Cell(30,10,$qty,'LBRT','','C');
$pdf->Cell(30,10,"0",'LBRT','','C');
$pdf->Cell(30,10,$prc,'LBRT','','R');

$prcarr=$prcarr+$prc;
$pdf->ln(10);
}
$pdf->Cell(10,10,'','LB','','C');
$pdf->Cell(60,10,'','BT','','C');$pdf->Cell(30,10,'','BT','','C');
$pdf->Cell(30,10,'','BT','','C');
$pdf->Cell(30,10,'TOTAL','LBRT','','C');
//$pdf->Cell(30,10,'','LBRT','','C');
$pdf->Cell(30,10,$prcarr,'LBRT','','R');
$pdf->ln(40);
$pdf->Cell(60,10,'SYSTEM GENERATED.','','','C');
$pdf->Cell(60,10,'','','','C');
$pdf->Cell(60,10,'CEO.','','','C');
$pdf->ln(20);
$pdf->Cell(60,10,'Powered by codeomega -IT SERVICES.','','','C');
$pdf->Output('billcopy.pdf','I');
}
?>


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


$orderby=$_REQUEST['orderby'];
if($orderby=='low'){$sql="select * from tb_products order by quantity";}
elseif($orderby=='high'){$sql="select * from tb_products order by quantity DESC";}
else{$sql="select * from tb_products order by name";}

$res=mysqli_query($conn,$sql);
//$row=mysqli_fetch_array($res);

require('fpdf.php');




//INSERT INTO invoice(invoice_ref_id,product_ref_id,qty,amount)
//VALUES ($last_id,$productID,$qty,$amt),
      // ('Task 2','2010-01-01','2010-01-02','Description 2'),
      // ('Task 3','2010-01-01','2010-01-02','Description 3');
 
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->Setx(10);
$pdf->SetFont('Arial','B',16);
$pdf->Cell(20,15,'','LBT','','');
$pdf->Cell(175,15,'BWDA -IT REQUEST MANAGEMENT','BTR','','C');
$pdf->Setx(41);
$pdf->SetFont('Arial','',10);
$pdf->Cell(84,25,',','','','');
$pdf->SetFont('Arial','',10);
//$pdf->Setx(30);
//$pdf->MultiCell(80,5,'BWDA FINANCE LIMITED,
//Near Reddiyar Mill,
//Villupuram-DT.','BRT','C','');
$pdf->ln(16);
//$pdf->Setx(20);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,'S.NO','LBTR','','C');
$pdf->Cell(50,10,'NAME','LBTR','','C');
$pdf->Cell(30,10,'BRAND','LBTR','','C');
$pdf->Cell(25,10,'UNIT PRICE','LBTR','','C');
$pdf->Cell(10,10,'QTY','LBTR','','C');
$pdf->Cell(30,10,'TYPE','LBTR','','C');
$pdf->Cell(30,10,'MFG','LBTR','','C');
$pdf->Cell(10,10,'VAT','LBTR','','C');
//
$pdf->SetFont('Arial','',10);
$pdf->SetFont('Arial','',10);
$sno=1;
$pdf->ln(10);
while($row=mysqli_fetch_array($res)){

//$pdf->Setx(20);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,$sno,'LBTR','','C');
$pdf->Cell(50,10,$row['name'],'LBTR','','C');
$pdf->Cell(30,10,$row['brand_name'],'LBTR','','C');
$pdf->Cell(25,10,$row['price'],'LBTR','','C');
$pdf->Cell(10,10,$row['quantity'],'LBTR','','C');
$pdf->Cell(30,10,$row['bwa_type'],'LBTR','','C');
$pdf->Cell(30,10,DateFormat($row['mfg_date']),'LBTR','','C');
$pdf->Cell(10,10,$row['vat'],'LBTR','','C');
$pdf->ln(10);
$sno=$sno+1;
}
//
$pdf->ln(10);
$pdf->Setx(20);
$pdf->Cell(110,10,'PRODUCT REPORT.','','','');

$pdf->Cell(60,10,'Powered by codeomega - IT SERVICES.','','','C');

$pdf->Output('products.pdf','I');
}

?>
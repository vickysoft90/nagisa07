

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

$sql=" select a.*,c.name,c.description,c.brand_name,c.quantity,c.bwa_type from branch_product a 
		left join users b on b.user_id=a.user_id
		left join tb_products c on c.productID=a.product_id
		where a.stat='A' and a.user_id=$user_id";

$res=mysqli_query($conn,$sql);
//$row=mysqli_fetch_array($res);

require('fpdf.php');




//INSERT INTO invoice(invoice_ref_id,product_ref_id,qty,amount)
//VALUES ($last_id,$productID,$qty,$amt),
      // ('Task 2','2010-01-01','2010-01-02','Description 2'),
      // ('Task 3','2010-01-01','2010-01-02','Description 3');
 
$pdf = new FPDF('P','mm','A4');
$pdf->AddPage();
$pdf->Setx(20);
$pdf->SetFont('Arial','B',16);

$pdf->Cell(170,15,'BWDA - IT REQUEST MANAGEMENT SYSYTEM','BTRL','','C');
$pdf->Setx(41);
$pdf->SetFont('Arial','',10);
$pdf->Cell(84,25,',','','','');
$pdf->SetFont('Arial','',10);
//$pdf->Setx(30);
//$pdf->MultiCell(70,5,'BWDA FINANCE LIMITED,
//Near Reddiyar Mill,
//Villupuram-DT.','BRT','C','');
$pdf->ln(16);
$pdf->Setx(20);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(170,10,'  BRANCH NAME  :    '.$clientname,'LBTR','','');
$pdf->ln(10);
$pdf->Setx(20);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,'S.NO','LBTR','','C');
$pdf->Cell(60,10,'NAME','LBTR','','C');
$pdf->Cell(45,10,'Description','LBTR','','C');

$pdf->Cell(40,10,'Brand','LBTR','','C');$pdf->Cell(10,10,'QTY','LBTR','','C');
$pdf->Cell(20,10,'From','LBTR','','C');
//$pdf->Cell(30,10,'EXP','LBTR','','C');$pdf->Cell(10,10,'VAT','LBTR','','C');
//
$sno=1;
$pdf->ln(10);

$pdf->SetFont('Arial','',10);
while($row=mysqli_fetch_array($res)){

$pname=$row['name'];
$desc=$row['description'];
$brname=$row['brand_name'];
$pqty=$row['p_quantity'];
$bwdatyp=$row['bwa_type'];

$name_br=$row['name_br'];
$desc_br=$row['description_br'];
$brd_br=$row['brand_name_br'];
$bwa_type_br=$row['bwa_type_br'];

if($pname==""){$pname=$name_br;}
if($desc==""){$desc=$desc_br;}
if($brname==""){$brname=$brd_br;}
if($bwdatyp==""){$bwdatyp=$bwa_type_br;}

$pdf->Setx(20);
//$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,$sno,'LBTR','','C');
$pdf->Cell(60,10,strtoupper($pname),'LBTR','','C');
$pdf->Cell(45,10,$desc,'LBTR','','C');
$pdf->Cell(40,10,$brname,'LBTR','','C');
$pdf->Cell(10,10,$row['p_quantity'],'LBTR','','C');

$pdf->Cell(20,10,$bwdatyp,'LBTR','','C');
//$pdf->Cell(30,10,DateFormat($row['exp_date']),'LBTR','','C');
//$pdf->Cell(10,10,$row['vat'],'LBTR','','C');
$pdf->ln(10);
$sno=$sno+1;
}
//
$pdf->ln(10);
$pdf->Setx(20);
$pdf->Cell(110,10,'PRODUCT REPORT.','','','');

$pdf->Cell(60,10,'Powered by codeomega - IT SERVICES.','','','C');

//$a = array(1, '', '', '', 2, '', 3, 4);
//$b = array_values(array_filter($a));
 
//print_r($b);
$pdf->Output('products.pdf','I');
}

?>
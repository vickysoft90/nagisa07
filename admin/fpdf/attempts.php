

<?php

session_start();
//print_r($_SESSION);

$clients_refid=$_REQUEST['refid'];
$clientname=$_REQUEST['clientname'];
if($_SESSION['not_expired']=="yes"){

include'../common/inc.config.php';
require('fpdf.php');

 function DateFormat($value)
{
	if($value != "0000-00-00" &&  !empty($value))	
		return date('d-m-Y', strtotime($value));
	else
		return "";
}



//$row=mysqli_fetch_array($res);





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
$pdf->MultiCell(70,5,'BWDA FINANCE LIMITED,
Near Reddiyar Mill,
Villupuram-DT.','BRT','C','');
$pdf->ln(1);

//*******************************************************************************
$pdf->Setx(20);
$pdf->Cell(110,10,'ATTEMPTS  REPORT   ','','','');
$pdf->ln(10);
//$pdf->Setx(20);
//$pdf->Cell(60,10,'Powered by codeomega - IT SERVICES.','','','');

 $sno=1;
 $sqll="SELECT * 
FROM  `attempts` 
where clients_refid=$clients_refid
order by updated desc";



$res1=mysqli_query($conn,$sqll);



$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,'SNO','LBTR','','C');
$pdf->Cell(25,10,'DATE','LBTR','','C');
$pdf->Cell(20,10,'VISITS','LBTR','','C');
$pdf->Cell(25,10,'ADMIN NAME','LBTR','','C');
$pdf->Cell(15,10,'TIME','LBTR','','C');
$pdf->Cell(100,10,'REVIEWS','LBTR','','C');

//$pdf->Cell(45,10,'FINAL DESCRIPTION','LBTR','','C');
//$pdf->Cell(10,10,$row['vat'],'LBTR','','C');
$pdf->ln(10);
while($row=mysqli_fetch_array($res1)){

//$pdf->Setx(20);
$pdf->SetFont('Arial','',8);
$pdf->Cell(10,10,$sno,'LBTR','','C');
$pdf->Cell(25,10,$row['dated'],'LBTR','','');
//$pdf->Cell(25,10,$row['price'],'LBTR','','C');
//$pdf->Cell(20,10,$row['dated'],'LBTR','','C');
//$pdf->Cell(30,10,DateFormat($row['mfg_date']),'LBTR','','C');
$v=$row['visit'];
if($v==2){$v='Online';}if($v==1){$v='Direct';}
$pdf->Cell(20,10,$v,'LBTR','','');
$adname=$row['admin_name'];
$adname=strtolower($adname);
$adname=ucfirst($adname);
$pdf->Cell(25,10,$adname,'LBTR','','');
$pdf->Cell(15,10,$row['hours'].".".$row['min'],'LBTR','','');
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

$pdf->Cell(100,5,$first,'LTR','','L');
$pdf->ln();
$pdf->Setx(105);
$pdf->Cell(100,5,$new_add_s_l,'LBR','','L');

//$pdf->Cell(45,10,$row['description2'],'LBTR','','');
//$pdf->Cell(10,10,$row['vat'],'LBTR','','C');
$pdf->ln();
$sno=$sno+1;
}



$pdf->Output('Bill_repair.pdf','I');
}

?>
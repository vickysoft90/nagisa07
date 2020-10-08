<?php

session_start();
//print_r($_SESSION);
if($_SESSION['not_expired']=="yes"){
include'../common/inc.config.php';
$orderby=$_REQUEST['orderby'];
$t_date=$_REQUEST['t_date'];
$smt="";
if($t_date=="week"){
//$smt =" where `updated` BETWEEN DATE_SUB( CURDATE( ) ,INTERVAL 7 DAY ) AND CURDATE( ) ";
//WHERE `updated` > DATE_SUB(now(), INTERVAL 10 DAY)
$smt ="  WHERE `updated` > DATE_SUB(now(), INTERVAL 7 DAY) ";
}
elseif($t_date=="month"){
$smt =" where `updated` >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH) ";

}
elseif($t_date=="year"){
$smt= " where `updated` >= DATE_SUB(CURDATE(), INTERVAL 1 YEAR) ";
}
if($orderby=='low'){$sql="select * from invoice $smt order by grand_total";}
elseif($orderby=='high'){$sql="select * from invoice  $smt order by grand_total DESC";}
else{$sql="select * from invoice  $smt order by updated desc";}

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
$pdf->Cell(170,15,'BWDA - IT REQUEST MANAGEMENT','BTR','','C');
$pdf->Setx(46);
$pdf->SetFont('Arial','',10);
$pdf->Cell(84,25,',','','','');
$pdf->SetFont('Arial','',10);
//$pdf->Setx(30);
//$pdf->MultiCell(70,5,'BWDA FINANCE LIMITED,
//Near Reddiyar Mill,
//Villupuram-DT.','BRT','C','');
$pdf->ln(16);
//$pdf->Setx(20);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,'S.NO','LBTR','','C');
$pdf->Cell(20,10,'COM_NO','LBTR','','C');
$pdf->Cell(60,10,'BRANCH NAME','LBTR','','C');
$pdf->Cell(30,10,'GRAND TOTAL','LBTR','','C');
$pdf->Cell(30,10,'INVOICE NO','LBTR','','C');
$pdf->Cell(40,10,'DATE','LBTR','','C');
//
$sno=1;
$pdf->ln(10);
while($row=mysqli_fetch_array($res)){

//$pdf->Setx(20);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,$sno,'LBTR','','C');
$pdf->Cell(20,10,$row['client_refid'],'LBTR','','C');
$pdf->Cell(60,10,$row['patient_name'],'LBTR','','C');
$pdf->Cell(30,10,$row['grand_total'],'LBTR','','R');
$pdf->Cell(30,10,$row['ref_id'],'LBTR','','C');
$pdf->Cell(40,10,$row['updated'],'LBTR','','C');
$pdf->ln(10);
$sno=$sno+1;
}
//
$pdf->ln(10);
$pdf->Setx(20);
$pdf->Cell(110,10,'BILLING REPORT.','','','');


$pdf->Cell(60,10,'Powered by codeomega - IT SERVICES.','','','C');

$pdf->Output('billing.pdf','I');
}
?>
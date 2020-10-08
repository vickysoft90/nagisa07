

<?php

session_start();
//print_r($_SESSION);

$refid=$_REQUEST['refid'];
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


 $sql="SELECT invoice.bill_by,invoice_details.invoice_ref_id,invoice_details.updated,invoice_details.qty,tb_products.name,tb_products.brand_name
FROM invoice 
LEFT OUTER JOIN invoice_details ON invoice.ref_id = invoice_details.invoice_ref_id
LEFT JOIN tb_products ON tb_products.productID = product_ref_id 
where invoice.client_refid=$refid  ORDER BY  invoice_details.updated desc";

$res=mysqli_query($conn,$sql);
//$row=mysqli_fetch_array($res);





//INSERT INTO invoice(invoice_ref_id,product_ref_id,qty,amount)
//VALUES ($last_id,$productID,$qty,$amt),
      // ('Task 2','2010-01-01','2010-01-02','Description 2'),
      // ('Task 3','2010-01-01','2010-01-02','Description 3');
 
$pdf = new FPDF('L','mm','A4');
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
$pdf->Setx(20);
$pdf->Cell(110,10,'BILL REPORT   ','','','');
$pdf->ln(10);
//$pdf->Setx(20);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(120,10,'     BRANCH NAME :  ' .strtoupper($clientname),'LBTR','','');
$pdf->Cell(65,10,'COMPLAINT NO :' .strtoupper($refid),'LBTR','','C');

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
$sno=1;
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
//*******************************************************************************
$pdf->ln(10);
$pdf->Setx(20);
$pdf->Cell(110,10,'REPAIR AND REPLACEEMENT  REPORT   ','','','');
$pdf->ln(10);
//$pdf->Setx(20);
//$pdf->Cell(60,10,'Powered by codeomega - IT SERVICES.','','','');
 $b=trim($b,',');
 IF($b==''){$b=0;}ELSE{$b=$b;}
 $sno=1;
 $sqll="SELECT * 
FROM  `invoice_details` 
LEFT JOIN REPAIR ON invoice_details.ref_id = repair.invoice_details_refid
where invoice_details.invoice_ref_id in ($b) or complaint_no in($refid) 
ORDER BY  `invoice_details`.`ref_id` DESC";

$sqlk="
select   null as product_name,null as status,null as rep_pro,null as procondi,null as description,null as description2,invoice_ref_id,null as complaint_no from  invoice_details where  invoice_ref_id in ($b)
union all 
select 
product_name,status,rep_pro,procondi,description,description2,null as invoice_ref_id,complaint_no from  repair

where  complaint_no in($refid) 
 

";

$res1=mysqli_query($conn,$sqll);



$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,10,'SNO','LBTR','','C');
$pdf->Cell(60,10,'PRODUCT NAME','LBTR','','C');
//$pdf->Cell(25,10,$row['price'],'LBTR','','C');
//$pdf->Cell(20,10,$row['dated'],'LBTR','','C');
//$pdf->Cell(30,10,DateFormat($row['mfg_date']),'LBTR','','C');
$pdf->Cell(32,10,'STATUS','LBTR','','C');
$pdf->Cell(55,10,'REPLACED PRODUCT','LBTR','','C');
$pdf->Cell(25,10,'CONDITION','LBTR','','C');
$pdf->Cell(45,10,'DESCRIPTION','LBTR','','C');
$pdf->Cell(45,10,'FINAL DESCRIPTION','LBTR','','C');
//$pdf->Cell(10,10,$row['vat'],'LBTR','','C');
$pdf->ln(10);
while($row=mysqli_fetch_array($res1)){

//$pdf->Setx(20);
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,$sno,'LBTR','','C');
$pdf->Cell(60,10,strtoupper($row['product_name']),'LBTR','','');
//$pdf->Cell(25,10,$row['price'],'LBTR','','C');
//$pdf->Cell(20,10,$row['dated'],'LBTR','','C');
//$pdf->Cell(30,10,DateFormat($row['mfg_date']),'LBTR','','C');
$pdf->Cell(32,10,$row['status'],'LBTR','','C');
$pdf->Cell(55,10,$row['rep_pro'],'LBTR','','');
$pdf->Cell(25,10,$row['procondi'],'LBTR','','');
$pdf->Cell(45,10,$row['description'],'LBTR','','');
$pdf->Cell(45,10,$row['description2'],'LBTR','','');
//$pdf->Cell(10,10,$row['vat'],'LBTR','','C');
$pdf->ln(10);
$sno=$sno+1;
}
$sqm="select * from repair where complaint_no=$refid";
$ret=mysqli_query($conn,$sqm);
while($row=mysqli_fetch_array($ret)){
$pdf->SetFont('Arial','',10);
$pdf->Cell(10,10,$sno,'LBTR','','C');
$pdf->Cell(60,10,strtoupper($row['product_name']),'LBTR','','');
//$pdf->Cell(25,10,$row['price'],'LBTR','','C');
//$pdf->Cell(20,10,$row['dated'],'LBTR','','C');
//$pdf->Cell(30,10,DateFormat($row['mfg_date']),'LBTR','','C');
$pdf->Cell(32,10,$row['status'],'LBTR','','C');
$pdf->Cell(55,10,$row['rep_pro'],'LBTR','','');
$pdf->Cell(25,10,$row['procondi'],'LBTR','','');
$pdf->Cell(45,10,$row['description'],'LBTR','','');
$pdf->Cell(45,10,$row['description2'],'LBTR','','');
//$pdf->Cell(10,10,$row['vat'],'LBTR','','C');
$pdf->ln(10);
$sno=$sno+1;

}



$pdf->Output('Bill_repair.pdf','I');
}

?>
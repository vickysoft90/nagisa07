<?php 
include '../common/inc.common.php';

$stausArray=array();

$si_id=$_POST['si_id'];
$date_field =  array('');
$InputArray = array();


if(isset($_POST['mode']))
{
	$mode=$_POST['mode'];
	
	$tableName="size";
	$si_id=$_POST['si_id'];
	$InputArray['si_name'] =  $_POST['si_name'];
	
	$conditions="si_id=$si_id";
    $resval=$Cobj->delet($tableName, $conditions);

	if( $resval!= false){
        //updated success
							$res = 'deleted';
							}
								else{
						$res = 'E';
										}	
	}


else{
			if($si_id!=0 && $si_id !=""){
	
		$InputArray['s_name'] =  $_POST['s_name'];
		$InputArray['s_empid'] =  $_POST['s_empid'];
						$InputArray['s_mobile'] =  $_POST['s_mobile'];

			//$InputArray['password'] =  md5($_POST['password']);
			$fields='si_id';
			$conditions=" where s_empid =".$si_id;
		$resval=$Cobj->updBulkData("staff", $InputArray, $conditions);
			
					if( $resval!== false){
        //updated success
							$res = 'U';
							}
								else{
						$res = 'E';
										}	

												}
else
		{	
		$InputArray['s_name'] =  $_POST['s_name'];
		$InputArray['s_empid'] =  $_POST['s_empid'];
		$InputArray['s_mobile'] =  $_POST['s_mobile'];

			$InputArray['password'] =  $_POST['password'];
		$res = $Cobj->addNewData("staff", $InputArray, "");
	
			}
}


//}
//else{
	
	// $res=7;
//}
//echo json_encode($InputArray);

echo "Added succefully !!";
?>


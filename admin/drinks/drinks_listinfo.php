<?php 
include '../common/inc.common.php';

$stausArray=array();
if(isset($_FILES["file"]["type"]))
{
	$validextensions = array("jpeg", "jpg", "png","JPG");
	$temporary = explode(".", $_FILES["file"]["name"]);
	$file_extension = end($temporary);
	if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")
	) && ($_FILES["file"]["size"] < 52428800)//Approx. 100kb files can be uploaded.
	&& in_array($file_extension, $validextensions)) {
		if ($_FILES["file"]["error"] > 0)
		{
			//echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
		}
		else
		{
			if (file_exists("../upload/" . $_FILES["file"]["name"])) 
			{
				//echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
				$status='AE';
			}
			else
			{
				
	$file_name=$_FILES["file"]["name"];
	$rand_file_name=rand()."_".$file_name;
	
				$sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
				
				
				$targetPath = "../upload/".	$rand_file_name; // Target path where file is to be stored
				move_uploaded_file($sourcePath,$targetPath); // Moving Uploaded file				
			}
		}
	}
	else
	{
		//echo "<span id='invalid'>***Invalid file Size or Type***<span>";
	}
}

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
	
                $InputArray['CD1'] =  $_POST['CD1'];
                $InputArray['CD2'] =  $_POST['CD2'];
                $InputArray['product'] =  $_POST['product'];
                $InputArray['price'] =  $_POST['price'];
                $InputArray['category'] =  $_POST['category'];
                $InputArray['stock'] =  $_POST['stock'];
                $InputArray['drinkinfo'] =  $_POST['drinkinfo'];
                $InputArray['productimage'] =  $rand_file_name;
                

			//$InputArray['password'] =  md5($_POST['password']);
			$fields='si_id';
			$conditions=" where d_refid =".$si_id;
		$resval=$Cobj->updBulkData("drinks", $InputArray, $conditions);
			
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
            $InputArray['CD1'] =  $_POST['CD1'];
            $InputArray['CD2'] =  $_POST['CD2'];
            $InputArray['product'] =  $_POST['product'];
            $InputArray['price'] =  $_POST['price'];
            $InputArray['category'] =  $_POST['category'];
            $InputArray['stock'] =  $_POST['stock'];
            $InputArray['drinkinfo'] =  $_POST['drinkinfo'];
            $InputArray['productimage'] =  $rand_file_name;
		$res = $Cobj->addNewData("drinks", $InputArray, "");
	
			}
}


//}
//else{
	
	// $res=7;
//}
//echo json_encode($InputArray);

echo "操作は正常に完了しました";
?>


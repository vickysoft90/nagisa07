<?php


class common {

	public function common($dbcon) {
		$this->dbCon = $dbcon;
			
	}

	public function getCustomData($tableName,$fields, $conditions = "") {
		$stmt = "";
		$sql = "";
		$sql = "SELECT $fields FROM $tableName  $conditions ";
		$stmt = $this->dbCon->query($sql);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		//print_r($result);exit();
		
		
		return $result;
	}

	public function union($sql){
		$stmt = "";
		//$sql = "";
		$stmt = $this->dbCon->query($sql);
		//print_r($stmt);exit();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		return $result;
	}


	public function getDataById($tableName, $refid) {

		$sql = "SELECT * FROM $tableName where refid='$refid' ";
		$stmt = $this->dbCon->query($sql);
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;

	}

	public function getDataObj($tableName, $cond = "") {
		$sql = "SELECT * FROM $tableName $cond ";
		$stmt = $this->dbCon->query($sql);
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$keypairArr = $this->chgKeyPairVal($result);
		return $keypairArr;

	}

	public function getDataRawObj($tableName, $cond = "") {

		$sql = "SELECT * FROM $tableName $cond ";
		$stmt = $this->dbCon->query($sql);
		//print_r($stmt);exit();
		$result = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $result;

	}





public function addNewData($tableName, $inputArray, $schoolId = '', $memcache = false) {
		$fields = '';
		$valset = '';
		
		
		if (count($inputArray) > 0) {
			while (list($key, $val) = each($inputArray)) {
				if(!empty($val)){
					$fields.= $key . ',';
					$valset.= "'". $val ."',";
				}
			}
		}   

		$fields = trim($fields, ',');
		$valset = trim($valset, ',');
		$sql = "INSERT INTO $tableName ($fields) VALUES ($valset)";
		
		/*echo "<pre>";
		print_r($sql);
		exit(); */
		
		$stmt = $this->dbCon->prepare($sql);
		$stmt->execute($inputArray);
		$id = $this->dbCon->lastInsertId();
		return $id;
	}
	

	public function updNewData($tableName, $inputArray, $refid) {
		$fields = '';
		if (count($inputArray) > 0) {
			while (list($key, $val) = each($inputArray)) {
				$fields.=$key . '=:' . $key . ',';
			}
		}
		
		$inputArray['refid'] = $refid;
		$fields = trim($fields, ',');
		$sql = "UPDATE $tableName set $fields where refid=:refid";
		$stmt = $this->dbCon->prepare($sql);
		$result = $stmt->execute($inputArray);
		return $refid;
	}
		// for update vignesh try
		public function updaterepair($user_id,$product_id,$quantityyarr,$act){
		/*$qry = "UPDATE table SET column = (column - :amount) WHERE somecondition;";
$stmt = $db->prepare($qry);
$stmt->execute(array(':amount' => $amount));
*/
		//$cars=array("Volvo","BMW","Toyota");
		//$p_quantity=array("2","3","4","5","4");
		//$quantityyarr=array(1,2,1,1);
		//$user_id=14;
		// new code for update 
		$i = 0;
		if($act=='minus'){
$set_details = "UPDATE branch_product SET p_quantity = (p_quantity - :quantityyarr) WHERE product_id = :product_id and user_id = :user_id ";
$STH = $this->dbCon->prepare($set_details);

    //$i = 0;
    
	}
	if($act=='plus'){
	$set_details = "UPDATE branch_product SET p_quantity = (p_quantity + :quantityyarr) WHERE product_id = :product_id and user_id = :user_id ";
$STH = $this->dbCon->prepare($set_details);
	
	}
	while($i < count($product_id)) {
	
        $STH->bindParam(':quantityyarr', $quantityyarr[$i]);
       // $STH->bindParam(':description', $description[$i]);
        $STH->bindParam(':user_id', $user_id);
		$STH->bindParam(':product_id', $product_id[$i]);
        $STH->execute();
        $i++;
    }
	// end of new code
		//return $result;
	}
	
	// end of update vignesh 
	
	// for multiple update
	
	public function updatemulti($table,$refid,$description2){		
		$i = 0;
$set_details = "UPDATE repair SET description2 = :description2 WHERE refid = :refid  ";
$STH = $this->dbCon->prepare($set_details);
	
	while($i < count($refid)) {
        $STH->bindParam(':description2', $description2[$i]);
       // $STH->bindParam(':description', $description[$i]);
        $STH->bindParam(':refid', $refid[$i]);
        $STH->execute();
        $i++;
    }
	
	}
	
	//
	
public function updNew_acadamic($tableName1, $inputArray, $refid) {
		$fields = '';
		if (count($inputArray) > 0) {
			while (list($key, $val) = each($inputArray)) {
					$fields.=$key . '="' . $val . '",';
			}
		}
		$a=implode(",",$refid);
		//$inputArray['refid'] = $refid;
		
		$fields = trim($fields, ',');
		$sql = "UPDATE $tableName1 set $fields where refid in($a)";
		
		$result = $this->dbCon->exec($sql);
		//$stmt = $this->dbCon->prepare($sql);
		//$result = $stmt->execute($inputArray);
		$su="sucess";
		return $su;
	}
	
public function promotion($inputArray, $refid) {
	
	//$fields = '';
	
		if (count($inputArray) > 0) {
		while (list($key, $val) = each($inputArray)) {
					$fields.=$key . '="' . $val . '",';
			}
		}
		
		
		$a=implode(",",$refid);
		//$inputArray['refid'] = $refid;
		
		$fields = trim($fields, ',');
		$sel_sql="select ";
		
		$sql = "UPDATE $tableName1 set $fields where refid in($a)";
		
		$result = $this->dbCon->exec($sql);
		//$stmt = $this->dbCon->prepare($sql);
		//$result = $stmt->execute($inputArray);
		$su="sucess";
		return $su;
	
	
}

	public function updBulkData($tableName, $updarray, $con = '') {

		$fields = '';
		if (count($updarray) > 0) {
			while (list($key, $val) = each($updarray)) {
				$fields.=$key . '="' . $val . '",';
			}

				
		}

		$fields = trim($fields, ',');
		$sql = "UPDATE $tableName set $fields $con";
		$result = $this->dbCon->exec($sql);

		return $result;
	}

public function delet($tableName, $con){
	
   // $inputArray['classId']=$class_id;
	//$stmt = $this->$dbCon->prepare("DELETE FROM $tableName WHERE classId =:classId");
	//$stmt->bindValue(':classId', $class_id);
	//$result = $stmt->execute($inputArray);
	
	$sql = "delete from $tableName  where $con";
		$result = $this->dbCon->exec($sql);

	//$result=deleted;
    return $result;
 }
 
	public function chgKeyPairVal($datObj) {
		$kaypairArr = array();
		if (count($datObj) > 0) {
			for ($kpLoop = 0; $kpLoop < count($datObj); $kpLoop++) {
				$kaypairArr[$datObj[$kpLoop]['refid']] = $datObj[$kpLoop];
			}
		}
		return $kaypairArr;
	}



	public function createTable($createTableQuery) {
		$qry = $createTableQuery;
		$result = $this->dbCon->exec($createTableQuery);
		return $result;
	}



	public function ConsoleLog($logref, $logdat) {
		/* 		if(!$logref)
			$logref=date("ymd");
		$fp=fopen("/var/www/ezy71/logs/clogs/".$logref,"a+");
		$str=date("Y-m-d H:i:s")."  -  ".$logdat."\n";
		fwrite($fp,$str);
		fclose($fp); */
	}

	public function customLog($logref, $logdat) {
		/* if(!$logref)
			$logref=date("ymd");
		$fp=fopen("/var/www/ezy71/".$logref,"a+");
		$str=date("Y-m-d H:i:s")."  -  ".$logdat."\n";
		fwrite($fp,$str);
		fclose($fp); */
	}

	public function timetostrfun($tm) {
		$tmv = explode(":", $tm);
		$tmstr = ($tmv[0] * 3600) + ($tmv[1] * 60) + $tmv[2];
		return $tmstr;
	}

	function strtotimefun($str)
	{
		$hr=floor($str/3600);
		$mn=floor(($str-($hr*3600))/60);
		$sec=$str-(($hr*3600)+($mn*60));
		$tmval=$hr.":".$mn.":".$sec;
		return $tmval;
	}

}

?>
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



	public function updBulkData($tableName, $updarray, $con = '') {
	
		$sql = "delete from $tableName $con ";
		//$sql = "UPDATE $tableName set $fields $con";
		$result = $this->dbCon->exec($sql);

		return $result;
	}
	
public function delet($tableName, $class_id){
    $inputArray['classId']=$class_id;
    $stmt = $this->$dbCon->prepare("DELETE FROM $tableName WHERE classId =:classId");
    $stmt->bindValue(':classId', $class_id);
    $result = $stmt->execute($inputArray);
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
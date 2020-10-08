<?php 
@session_start();
include_once '../common/inc.config.php';
include_once '../common/inc.globalConstants.php';

$db = new PDO("mysql:host=$servername;dbname=$dbname", $username,$password );
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$db->exec("SET NAMES 'utf8'");


include_once '../classes/cls.common.php';
include_once '../classes/inc.extra.functions.php';


$Cobj=new common($db);


?>
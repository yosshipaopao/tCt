{<?php
require "settings/pdo.php";$table = $_GET["table"];$search = $_GET["search"];
try {
$sql = "SHOW TABLES FROM trvvdmle_todo LIKE '".$table."'";
$res = $pdo->query($sql);
$return = false;
foreach($res as $val){foreach($val as $vals){if($vals == $table){$return = true;}}}}catch(PDOException $e){echo $e->getMessage();exit;}
$echo = "";
if($return){
$sql=$pdo->prepare("SELECT * FROM `".$table."` WHERE DATE LIKE '".$search."%'");

$status=$sql->execute();
$i=0;
while($result = $sql->fetch(PDO::FETCH_ASSOC)){$i+=1;$echo.='"'.$i.'":{"date":"'.substr($result["DATE"],8,2).'","time":"'.$result["TIME"].'","info":"'.$result["INFO"].'"},';}}
echo substr($echo,0,strlen($echo)-1);
?>
}
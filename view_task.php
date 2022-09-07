<?php
require "settings/pdo.php";

$table = $_GET["table"];
$day_search = isset($_GET["search"]);

if($day_search){$search=$_GET["search"];}

try {
$sql = "SHOW TABLES FROM trvvdmle_todo LIKE '".$table."'";
$res = $pdo->query($sql);
$return = false;
foreach($res as $val) {
    foreach($val as $vals) {
        if($vals == $table){
            $return = true;
        }
    }
}
if($return){
    if($day_search){
        $stmt = $pdo->prepare("SELECT * FROM `".$table."` WHERE `DATE` LIKE '%".$search."%'");
    }
    else{$stmt = $pdo->prepare("SELECT * FROM ".$table);echo "?????";}
    $status = $stmt->execute();
    $view = "";
if($status==false){
    $error = $stmt->errorInfo();
    exit("QueryError:".$error[2]);
}else{
    $view .= '<table>'; 
    $view .= '<tr>';                     
    $view .= '<th>'."DATE".'</th>'; 
    $view .= '<th>'."TIME".'</th>'; 
    $view .= '<th>'."INFO".'</th>';
    $view .= '<th>'."ABOUT".'</th>';
    $view .= '</tr>';  

    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
        $view .= '<tr>';    
        $view .= '<td>'.$result["DATE"].'</td>'; 
        $view .= '<td>'.$result["TIME"].'</td>'; 
        $view .= '<td>'.$result["INFO"].'</td>'; 
        $view .= '<td>'.$result["ABOUT"].'</td>'; 
        $view .= '</tr>';  
  
    }
    $view .= '</table>';
}
}
else{
    echo "存在しません";
}
}catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
?>
<style>table{border-collapse: collapse;}table th{border: 2px solid rgb(163, 163, 163);background-color:rgba(253, 196, 89, 0.13);color:orange;}table td{border: 1px solid rgb(163, 163, 163);}</style>
<div><?= $view ?></div>
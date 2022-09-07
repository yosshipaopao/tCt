<?php
if(!isset($_POST["uid"])|!isset($_POST["email"])|!isset($_POST["name"])|!isset($_POST["nickname"])|!isset($_POST["class"])|!isset($_POST["number"])|!isset($_POST["gender"]))
{header('Location: setup');exit();}
$time=time()+60*60*24*7;

$uid=$_POST["uid"];$email=$_POST["email"];$name=$_POST["name"];$nickname=$_POST["nickname"];$class=$_POST["class"];$number=$_POST["number"];$gender=$_POST["gender"];
echo $uid.$mail.$name."<br>";
//pdo
require "settings/pdo.php";
require "settings/pdo_account.php";


$table = $uid;
try {
    #$returnにuidのテーブルが有るかチェック
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
    #;
    #あったら...
    if(!$return){
        echo "初回ログインです";
        $sql="INSERT INTO `user` (`uid`, `email`, `name`, `gender`, `class`, `number`, `nickname`) VALUES ('".$uid."', '".$email."', '".$name."',  '".$gener."', '".$class."', '".$number."', '".$nickname."')";
        $res = $pdo_ac->query($sql);
        
        $sql = "CREATE TABLE `trvvdmle_todo`.`".$table."` ( `DATE` DATE NOT NULL , `TIME` TIME NOT NULL , `INFO` VARCHAR(255) NOT NULL , `ABOUT` LONGTEXT NOT NULL ) ENGINE = InnoDB;";
        $res = $pdo->query($sql);
        echo "OK\n数秒お待ち下さい...";
        
        echo "<script>setTimeout(() => {window.location = '/subscribe';}, 1000);</script>";
    }
    else{
        echo "初回ログインではありません";
        echo "<script>setTimeout(() => {window.location = '/subscribe';}, 1000);</script>";
    }
    #;
}catch (PDOException $e) {
    echo $e->getMessage();
    exit; 
}
?>
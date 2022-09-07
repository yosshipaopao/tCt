<?php
require "settings/pdo.php";
if(isset($_POST["table"])){
    $table = $_POST["table"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $info = $_POST["info"];
    $about = $_POST["about"];
    
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
        echo "存在します";
        $stmt = $pdo->prepare("INSERT INTO `".$table."` (`DATE`, `TIME`, `INFO`, `ABOUT`) VALUES ('".$date."', '".$time."', '".$info."', '".$about."')");
        $status = $stmt->execute(); 
    }
    else{
        echo "存在しません";
    }
    }catch (PDOException $e) {
        echo $e->getMessage();
        exit; 
    }
}
else{
    echo "
    <form name='form' action='' method='post'>
    <label for='table'>table</label><input type='text' id='table' name='table' value='".$_COOKIE["uid"]."'><br>
    <label for='date'>date</label><input type='text' id='date' name='date'><br>
    <label for='time'>time</label><input type='text' id='time' name='time'><br>
    <label for='info'>info</label><input type='text' id='info' name='info'><br>
    <label for='about'>about</label><input type='text' id='about' name='about'>
    <input type='submit' value='送信する'> </form>
    <script>
    document.form.date.value=(new Date().getFullYear()).toString()+'-'+(new Date().getMonth()+1).toString()+'-'+(new Date().getDate()).toString();
    document.form.time.value=(new Date().getHours()).toString()+':'+(new Date().getMinutes()).toString()+':'+(new Date().getSeconds()).toString();
    </script>";
}
?>
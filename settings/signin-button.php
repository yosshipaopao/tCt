<?php
include('settings/login_config.php');
if(!isset($_COOKIE["email"])){
$login_button = '<a style="position: fixed;display:block;left:85vw;z-index: 10000;" href="'.$google_client->createAuthUrl().'"><img style="display:flex;left:85vw;z-index: 10000;height:50px;" src="signin.png"></a>';
echo $login_button;
}else{
    echo "
    <div style='
    height: 50px;
    width: 200px;
    background: cornflowerblue;
    texe-align: center;
    position:relative;
    display:block;
    left:85vw;
    top 5hw;
    z-index: 10000;
    position: fixed;
'>
        <img src='".$_COOKIE['img']."' style='height: 100%;'>
        
        <p style='margin: 0;display: inline-block;position:absolute;top: 50%;transform: translateY(-50%);margin-left: 50px;font-size: 20px;'>".$_COOKIE['name']."</p>
    </div>
    ";
}
?>
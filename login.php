<?php
include('settings/login_config.php');

$login_button = '';
$time=time()+60*60*24*7;

if(isset($_GET["code"])) {
 $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);

 if(!isset($token['error'])) {
  $google_client->setAccessToken($token['access_token']);

  $_SESSION['access_token'] = $token['access_token'];

  $google_service = new Google_Service_Oauth2($google_client);

  $data = $google_service->userinfo->get();
  
  if(!empty($data['name'])){
   $_SESSION['name'] = $data['name'];
   setcookie('name',$data['name'],$time);
  }

  if(!empty($data['email'])){
   $_SESSION['email'] = $data['email'];
   setcookie('email',$data['email'],$time);
  }

  if(!empty($data['picture'])){
   $_SESSION['img'] = $data['picture'];
   setcookie('img',$data['picture'],$time);
  }
  
  if(!empty($data['id'])){
   $_SESSION['id'] = $data['id'];
   setcookie('uid',$data['id'],$time);
  }
  
  header("Location:/setup");
 }
}
if(isset($_COOKIE["email"])){
    //cookie
    setcookie('email',$_COOKIE['email'],$time);
    setcookie('name',$_COOKIE['name'],$time);
    setcookie('uid',$_COOKIE['uid'],$time);
    setcookie('img',$_COOKIE['img'],$time);
}
elseif(!isset($_SESSION['access_token'])){
 $login_button = '<a href="'.$google_client->createAuthUrl().'"><img src="signin.png" /></a>';
}
?>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>PHP Login using Google Account</title>
  <meta content='width=device-width, initial-scale=1, maximum-scale=1' name='viewport'/>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  
 </head>
 <body>
  <div class="container">
   <br />
   <h2 align="center">PHP Login using Google Account</h2>
   <br />
   <div class="panel panel-default">
   <?php
   if($login_button == ''){
    echo '<div class="panel-heading">Welcome User</div><div class="panel-body">';
    echo '<img src="'.$_SESSION["img"].'" class="img-responsive img-circle img-thumbnail" />';
    echo '<h3><b>Name :</b> '.$_SESSION['name'].'</h3>';
    echo '<h3><b>Email :</b> '.$_SESSION['email'].'</h3>';
    echo '<h3><a href="logout.php">Logout</h3></div>';
   }
   else{
    echo '<div align="center">'.$login_button . '</div>';
   }
   ?>
   </div>
  </div>
  <a href="/test.php">test.php</a>
  <a href="/#">index.php</a>
  <a href="/signin-button">button</a>
 </body>
</html>
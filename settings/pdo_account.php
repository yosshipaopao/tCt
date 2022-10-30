<?php
//----------変更----------
$dsn = 'mysql:host=localhost:3306;dbname=trvvdmle_account;charset=utf8mb4';
$username = 'trvvdmle_account';
$password = 'todo-yosshipaopao-jiyujin';
//------------------------
try {
    $pdo_ac = new PDO($dsn,$username,$password);
    	// 静的プレースホルダを指定
	$pdo_ac->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
	// DBエラー発生時は例外を投げる設定
	$pdo_ac->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch (PDOException $e) {
    echo $e->getMessage();
    exit;
}
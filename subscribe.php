<?php
$time = time() + 60 * 60 * 24 * 360;
$email = $_COOKIE['email'];$name = $_COOKIE['name'];$uid = $_COOKIE['uid'];
if (!isset($_POST['token'])) {
    require "settings/token_form.php";
} else {
    require 'settings/pdo_account.php';

    $topics = [];
    #POSTデータからclass情報のみ抽出
    foreach ($_POST as $key => $value) {
        if ($value == 'on') {
            array_push($topics, $key);
        }
    }
    #;
    #テーブルあるかなないかな？
    $sql_show = "SELECT 1 FROM information_schema.tables WHERE table_name = '".$uid."' AND table_schema = 'trvvdmle_account'";
    try {
        $query = $pdo_ac->query($sql_show);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $data = $query->fetchAll(PDO::FETCH_ASSOC);
    $tableisset = $data['0']['1'] == 1;
    #;
    #テーブル作るぞ
    if (!$tableisset) {
        $sql_createtable = 'CREATE TABLE `trvvdmle_account`.`'.$uid.'` ( `topic` TEXT NOT NULL ) ENGINE = InnoDB;';
        try {
            $responce = $pdo_ac->query($sql_createtable);
            echo "<p>データベースに通知音クラス管理用のデータベースを追加しました。</p><br>\n";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
    #;
    #データをインサートするぞ
    try {
        $sql_tr = 'TRUNCATE `'.$uid.'`';
        $pdo_ac->query($sql_tr);
        $sql_insert = 'INSERT INTO `'.$uid.'` (`topic`) VALUES (?)';
        $sth = $pdo_ac->prepare($sql_insert);
        foreach ($topics as $topic) {
            $sth->execute(array($topic));
        }
        echo "<p>topic の記載をしました。</p><br>\n";
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    #;
    #token記載用カラムの確認とINSERT
    try {
        $sql_tokencheck = "SELECT * FROM `token` WHERE uid = '".$uid."'";
    $res_tokenc = $pdo_ac->query($sql_tokencheck);
    $data_c = $res_tokenc->fetchAll(PDO::FETCH_ASSOC);
    if (!isset($data_c['0'])) {
        $sql_tokenin = "INSERT INTO `token` (`uid`, `token`) VALUES ('".$uid."', '".$token."')";
        $res_tokenin = $pdo_ac->query($sql_tokenin);
        echo "<p>データベースにtokenを記載しました</p><br>\n";
    }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    #;
    #tokenが一致しているかの確認とUPDATE
    try {
        $sql_token = "SELECT `token` FROM `token` WHERE `uid` = '".$uid."'";
        $res_token = $pdo_ac->query($sql_token);
        $data = $res_token->fetchAll(PDO::FETCH_ASSOC);
        if ($data[0]['token'] != $_POST['token']) {
            echo "<p>tokenの不一致</p><br>\n";
            $sql_tokenupdate = "UPDATE `token` SET `token`= '".$_POST['token']."' WHERE uid = '".$uid."'";
            $responce = $pdo_ac->query($sql_tokenupdate);
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    #;
    #nodeを実行してtopic subscribe
    $cmd = "~/.nodebrew/current/bin/node /home/trvvdmle/public_html/todo/node/subscribe.js ".$uid;
    $return = exec($cmd, $output, $return_var);
    var_dump($output);
    #;
}

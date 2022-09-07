<?php
session_start();
$user_email = $_SESSION['user_email_address'];
$user_name = $_SESSION['name'];
$user_id = $_SESSION['id'];
echo $_SESSION['id'];
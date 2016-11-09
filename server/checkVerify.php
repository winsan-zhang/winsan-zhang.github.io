<?php
require_once "common_fun.php";
header("Content-Type: application/json;charset=utf-8");
session_start();
$verifyValue =  $_POST['verifyValue'];
$resData = checkVerify($verifyValue);
echo $resData;
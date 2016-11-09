<?php
    require_once "mysql_fun.php";
    require_once "common_fun.php";
    header("Content-Type: application/json;charset=utf-8");
    session_start();
    $user_name = (String)$_POST["checkUsername"];
    //查询该用户名是否已经注册
    $resData = checkUsername($user_name);
    echo $resData;


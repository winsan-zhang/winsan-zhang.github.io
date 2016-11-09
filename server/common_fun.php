<?php
require_once "mysql_fun.php";
//用户名验证函数
function checkUsername($username){
    $link = connect();
    $sql = "select * from html5_user where username=" . "'".$username . "'";
    $row = fetchOne($link, $sql);
    $resData = null;
    if($row != 0){
        $success = 0;
        $msg = "该用户名已被注册，请更换";
        $resData = array("success"=>$success, "msg"=>$msg);
    }else {
        $success = 1;
        $msg = "ok";
        $resData = array("success"=>$success, "msg"=>$msg);
    }
    $resData = json_encode($resData);
    return $resData;
}

//验证码验证函数
function checkVerify($verifyValue){
    $data = null;
    if($verifyValue != $_SESSION["verify"]){
        $success = 0;
        $msg = $_SESSION["verify"];
        $data = array("success" => $success, "msg" => $msg);
    }else if($verifyValue == $_SESSION["verify"]){
        $success = 1;
        $msg = "验证码正确";
        $data = array("success" => $success, "msg" => $msg);
    }
    $resData = json_encode($data);
    return $resData;
}
//密码验证函数
function checkPwd($username, $password){
    $link = connect();
    $sql = "select * from html5_user where username='{$username}' and password='{$password}'";
    $row = fetchOne($link, $sql);
    return $row;
}
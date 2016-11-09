<?php
require_once "mysql_fun.php";
require_once "common_fun.php";
header("Content-Type: application/json;charset=utf-8");
session_start();
$username = $_POST["username"];
$password = md5($_POST["password"]);
$verify = $_POST["verify"];
$link = connect();

$resData_username = json_decode(checkUsername($username), true);//将json对象转换为数组
$resData_verify = json_decode(checkVerify($verify), true);//将json对象转换为数组
$resData = array();
$success = null;
$msg = null;
if($resData_verify["success"] != 1){
    $success = 2;
    $msg = "验证码错误";
}else if($resData_username["success"] != 1){
    $success = 0;
    $msg = "用户名错误";
}else{
    $table = "html5_user";
    $array = array("username" => $username, "password" => $password);
    $id =  insert($link, $table, $array);
    if($id){
        $success = 1;
        $msg = "注册成功！";
    }
}
$data = array("success" => $success, "msg" => $msg);
$data = json_encode($data);
echo $data;
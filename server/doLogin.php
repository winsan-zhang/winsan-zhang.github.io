<?php
require_once "common_fun.php";
header("Content-Type: application/json;charset=utf-8");
session_start();

$username = $_POST["username"];
$password = md5($_POST["password"]);
$verify = $_POST["verify"];

$link = connect();
$resData_username = json_decode(checkUsername($username), true);//将json对象转换为数组
$row = checkPwd($username, $password);
$data = array();
$success = null;
$msg = null;
$id = null;
if($verify != $_SESSION["verify"]){
    $success = 2;
    $msg = "验证码错误";
}else if(!$row){
    $success = 0;
    $msg = "用户名或密码错误";
}else{
    $success = 1;
    $msg = "登入成功";
    $id = $row["id"];
}
$data = json_encode(array("success" => $success, "msg" => $msg, "id" => $id));
echo $data;

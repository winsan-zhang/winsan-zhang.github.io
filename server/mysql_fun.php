<?php

//连接数据库
function connect(){
    $link = mysqli_connect("localhost", "root", "") or die("数据库连接失败：".mysqli_errno($link).":".mysqli_error($link));
    mysqli_set_charset($link, "utf8");
    mysqli_select_db($link, "html5") or die("指定数据库打开失败");
    return $link;
}

//插入数据
function insert($link, $table, $array){
    $key = join(",", array_keys($array));
    $values = "'" . join("','", array_values($array)) . "'";
    $sql = "insert into {$table}({$key}) values({$values})";
    mysqli_query($link, $sql);
    return mysqli_insert_id($link);
}
//更新数据
function update($link, $table, $array, $where){
    $str = null;
    foreach($array as $key => $val){
        if($str = null){
            $sep = "";
        }else{
            $sep = ",";
        }
        $str .= $sep . $key . "='" . $val . "'";
    }
    $sql = "update {$table} set {$str}" . ($where == null?null:'where'.$where);
    mysqli_query($link ,$sql);
    return mysqli_affected_rows($link);
}
//删除数据
function delete($link, $table, $where){
    $sql = "delete from " . $table . "where " . $where;
    mysqli_query($link, $sql);
    return mysqli_affected_rows($link);
}
//查询得到一条记录
function fetchOne($link, $sql){
    $sql_result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc( $sql_result);
    return $row;
}
//查询得到所有符合要求的记录
function fetchAll($link, $sql){
    $sql_results = mysqli_query($link, $sql);
    $rows = array();
    while($tmp = mysqli_fetch_assoc($sql_results)){
        $rows[] = $tmp;
    }
    return $rows;
}
//获得查询数据的条数
function getResultRows($link, $sql){
    $sql_results = mysqli_query($link, $sql);
    return mysqli_fetch_row($sql_results);
}
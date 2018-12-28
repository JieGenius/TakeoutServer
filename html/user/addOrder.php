<?php
/**
 * Created by PhpStorm.
 * User: Genius
 * Date: 2018/12/27
 * Time: 11:12
 */
//O_sum,O_time,Delivery_fee,Meal_box_fee,C_num,U_num
$O_sum = $_POST["O_sum"];
$Delivery_fee = $_POST["Delivery_fee"];
$Meal_box_fee = $_POST["Meal_box_fee"];
$C_num = $_POST["C_num"];
$U_num = $_POST["U_num"];
date_default_timezone_set("Asia/Shanghai");
$O_time = date("y-m-d H:i:m");
$sql = $_POST["sql"];
$link = mysqli_connect("localhost","yyj","yyj12345","mydatabase");
if($link) {
    mysqli_query($link, "set NAMES UTF8");
    $sql = "insert into 订单(O_sum,O_time,Delivery_fee,Meal_box_fee,C_num,U_num) values (?,?,?,?,?,?)";
    $stmt = mysqli_prepare($link,$sql);
    mysqli_stmt_bind_param($stmt,"ssssss",$O_sum,$O_time,$Delivery_fee,$Meal_box_fee,$C_num,$U_num);   
	mysqli_stmt_execute($stmt);
	$count = mysqli_stmt_affected_rows($stmt);
    if($count>0){
        $sql = "select max(O_num) from 订单";
        $result = mysqli_query($link,$sql);
        if($row = mysqli_fetch_array($result,MYSQLI_NUM)){
            echo $row[0];
        }
        else{
            echo "Failed";
        }
    }
    else {
        echo "Failed2";
    }

}
else{
    echo "数据库连接失败".mysqli_connect_error();
}

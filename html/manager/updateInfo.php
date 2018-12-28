<?php
/**
 * Created by PhpStorm.
 * User: Genius
 * Date: 2018/12/21
 * Time: 22:43
 */
//var_dump($_POST);
$sql = $_POST["sql"];
$link = mysqli_connect("localhost","yyj","yyj12345","mydatabase");
if($link){
		//echo $sql;
	mysqli_query($link,"SET NAMES UTF8");
    mysqli_multi_query($link,$sql);
    if(mysqli_errno()){
        echo "更新失败".mysqli_error($link);
	}
	else{
		echo "受影响行数".mysqli_affected_rows($link);
	
	}
}
else{
    echo "数据库连接失败".mysqli_connect_error();
}

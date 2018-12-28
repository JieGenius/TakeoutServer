<?php
/**
 * Created by PhpStorm.
 * User: Genius
 * Date: 2018/12/23
 * Time: 0:41
 */
$tel = $_POST['tel'];
$link = mysqli_connect("localhost","yyj","yyj12345","mydatabase");
if($link){
    mysqli_query($link,"set NAMES UTF8");
	$sql = "select * from 管理员 where M_phonenum = ".$tel;
//	echo $sql;
	$result = mysqli_query($link,$sql);
	$rowCount = mysqli_num_rows($result);
	
	if($rowCount){
        echo "allow";
    }
	else{
			echo $rowCount;
			echo "deny";
    }
}
else{
    echo "数据库连接失败".mysqli_connect_error();
}

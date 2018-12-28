<?php
/**
 * Created by PhpStorm.
 * User: Genius
 * Date: 2018/12/23
 * Time: 16:40
 */
$tel = $_POST['tel'];
$link = mysqli_connect("localhost","yyj","yyj12345","mydatabase");
if($link){
    mysqli_query($link,"set NAMES UTF8");
    $sql = "select * from 商家黑名单 where CB_phonenum = ".$tel;
    $result = mysqli_query($link,$sql);
    if(mysqli_num_rows($result)==0){
        mysqli_free_result($result);
		$sql = "select C_state,C_num from 商家 where C_phonenum = ".$tel;	
		$result	= mysqli_query($link,$sql);
        if($row = mysqli_fetch_array($result,MYSQLI_NUM)){
			$temp = $row[0];
            if($temp == 0){
                echo "Deny";
            }
            else if($temp == 1){
                echo "Waiting";
            }
            else{
                echo "Allow".$row[1];
            }
            mysqli_free_result($result);
        }
        else{
            echo "SignIn";//没有注册
        }
    }
    else{
        echo "BlackList";
    }
}
else{
    echo "数据库连接失败".mysqli_connect_error();
}

<?php
/**
 * Created by PhpStorm.
 * User: Genius
 * Date: 2018/12/23
 * Time: 21:32
 */

$tel = $_POST['tel'];
$name = $_POST['name'];
$address = $_POST['address'];
$time = $_POST['time'];
$link = mysqli_connect("localhost","yyj","yyj12345","mydatabase");
if($link){
    mysqli_query($link,"set NAMES UTF8");
    $sql = "select * from 商家 where C_phonenum = ".$tel;
    $result = mysqli_query($link,$sql);
    $rowCount = mysqli_num_rows($result);
    mysqli_free_result($result);
    if($rowCount==0){
        $sql = "insert into 商家(C_name,C_address,C_phonenum,C_time) values (?,?,?,?)";
        $stmt = mysqli_prepare($link,$sql);
        mysqli_stmt_bind_param($stmt,"ssss",$name,$address,$tel,$time);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_num_rows($stmt)==0){
			echo "Fail";
			echo mysqli_stmt_error($stmt);	
        }
        else{
            echo "Successful";
        }
        mysqli_stmt_close($stmt);
    }
    else{
        $sql = "update 商家 set C_name = ?,C_address = ?,C_time = ?,C_state = 2 where C_phonenum = ?";
        $stmt = mysqli_prepare($link,$sql);
        mysqli_stmt_bind_param($stmt,"ssss",$name,$address,$time,$tel);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
        if(mysqli_stmt_affected_rows($stmt)){
            echo "Successful";
        }
        else{
            echo "Fail";
        }
        mysqli_stmt_close($stmt);
    }

}

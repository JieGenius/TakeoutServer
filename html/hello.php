<?php
	echo "Hello World!";
	$link = mysqli_connect('localhost:3306','root','');	
	if($link){
		echo "连接成功";
		//$sql = "show databases";
		//$result = mysqli_query($link,$sql);
		//while($row = mysqli_fetch_row($result)
		//{
	//		printf("$s",$row[0]);
	//	)
	//	mysqli_free_result($result);
	}
	else{
		echo "Mysql连接失败：".mysqli_connect_error() ;
	}
?>

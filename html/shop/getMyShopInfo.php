<?php
/**
 * Created by PhpStorm.
 * User: Genius
 * Date: 2018/12/24
 * Time: 11:13
 */
$phone = $_POST['phone'];
$link = mysqli_connect("localhost","yyj","yyj12345","mydatabase");
if($link) {
    mysqli_query($link, "set NAMES UTF8");
	$sql = "select C_num,C_name,C_phonenum,C_address,C_grade,C_time,C_sales from  商家 where C_phonenum ='$phone'";
    $result = mysqli_query($link,$sql);
    if($row = mysqli_fetch_array($result,MYSQLI_NUM)){
        $num = $row[0];
        $name = $row[1];
        $phonenum = $row[2];
        $address = $row[3];
        $grade = $row[4];
        $time = $row[5];
        $sales = $row[6];
        $myShopInfo = new MyShopInfo($num,$name,$phonenum,$address,$grade,$time,$sales);
        echo json_encode($myShopInfo);
    }
    else{
        echo "Fail";
    }
}
else{
    echo "数据库连接失败".mysqli_connect_error();
}
class MyShopInfo{
    public $num;
    public $name;
    public $phonenum;
    public $address;
    public $grade;
    public $time;
    public $sales;

    /**
     * MyShopInfo constructor.
     * @param $num
     * @param $name
     * @param $phonenum
     * @param $address
     * @param $grade
     * @param $time
     * @param $sales
     */
    public function __construct($num, $name, $phonenum, $address, $grade, $time, $sales)
    {
        $this->num = $num;
        $this->name = $name;
        $this->phonenum = $phonenum;
        $this->address = $address;
        $this->grade = $grade;
        $this->time = $time;
        $this->sales = $sales;
    }

}

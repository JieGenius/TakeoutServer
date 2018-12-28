<?php
/**
 * Created by PhpStorm.
 * User: Genius
 * Date: 2018/12/26
 * Time: 17:57
 */
$phone = $_GET['phone'];
$link = mysqli_connect("localhost","yyj","yyj12345","mydatabase");
if($link) {
    mysqli_query($link, "set NAMES UTF8");
    $sql = "select U_num,U_name,U_phonenum,U_address from  用户 where U_phonenum =$phone";
    $result = mysqli_query($link,$sql);
    if($row = mysqli_fetch_array($result,MYSQLI_NUM)){
        $num = $row[0];
        $name = $row[1];
        $phone = $row[2];
        $address = $row[3];
        $userInfo = new UserInfo($num,$phone,$address,$name);
        echo json_encode($userInfo);
    }
    else{
        echo "Fail";
    }
}
else{
    echo "数据库连接失败".mysqli_connect_error();
}
class UserInfo{
    public $num;
    public $phone;
    public $address;
    public $name;

    /**
     * UserInfo constructor.
     * @param $num
     * @param $phone
     * @param $address
     * @param $name
     */
    public function __construct($num, $phone, $address, $name)
    {
        $this->num = $num;
        $this->phone = $phone;
        $this->address = $address;
        $this->name = $name;
    }

}

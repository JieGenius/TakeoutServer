<?php
/**
 * Created by PhpStorm.
 * User: Genius
 * Date: 2018/12/22
 * Time: 0:49
 */
$link = mysqli_connect("localhost","yyj","yyj12345","mydatabase");
if($link){
    $sql="select U_num,U_name,U_phonenum,U_address from 用户";
    //	$sql = "select * from shop";
    mysqli_query($link,"set NAMES UTF8");
    $result = mysqli_query($link,$sql);
    $allUser = new ALLUser();
    while($row = mysqli_fetch_array($result,MYSQLI_NUM)){
        $id = $row[0];
        $name = $row[1];
        $phone = $row[2];
        $address = $row[3];
        $userItem = new UserItem($id,$name,$phone,$address);
        $allUser->addUserItem($userItem);
    }
    echo  json_encode($allUser);
}
else{
    echo "数据库连接失败".mysqli_connect_error();
}
class ALLUser{
    public $userArr;
    public function __construct()
    {
        $this->userArr = array();
    }
    public function addUserItem($userItem){
        $this->userArr[]=$userItem;
    }
}
class UserItem{
    public $id;
    public $name;
    public $phone;
    public $address;
    public function __construct($id,$name,$phone,$address)
    {
        $this->id = $id;
        $this->name=$name;
        $this->phone=$phone;
        $this->address=$address;
    }
}

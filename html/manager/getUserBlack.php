<?php
/**
 * Created by PhpStorm.
 * User: Genius
 * Date: 2018/12/22
 * Time: 15:23
 */
$link = mysqli_connect("localhost","yyj","yyj12345","mydatabase");
if($link){
    $sql="select UB_num,UB_phonenum,UB_user_name from 用户黑名单";
    //	$sql = "select * from shop";
    mysqli_query($link,"set NAMES UTF8");
    $result = mysqli_query($link,$sql);
    $allUserBlack = new AllUserBlack();
    while($row = mysqli_fetch_array($result,MYSQLI_NUM)){
        $id = $row[0];
        $phone = $row[1];
        $name = $row[2];
        $userBlackItem = new UserBlackItem($id,$phone,$name);
        $allUserBlack->addUserBlackItem($userBlackItem);
    }
    echo  json_encode($allUserBlack);
}
else{
    echo "数据库连接失败".mysqli_connect_error();
}
class AllUserBlack{
    public $userBlackArr;
    public function __construct()
    {
        $this->userBlackArr = array();
    }
    public function addUserBlackItem($userBlackItem){
        $this->userBlackArr[]=$userBlackItem;
    }
}
class UserBlackItem{
    public $id;
    public $phone;
    public $name;
    public function __construct($id,$phone,$name)
    {
        $this->id = $id;
        $this->name=$name;
        $this->phone=$phone;
    }
}

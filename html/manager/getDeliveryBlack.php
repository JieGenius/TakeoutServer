<?php
/**
 * Created by PhpStorm.
 * User: Genius
 * Date: 2018/12/22
 * Time: 15:22
 */

$link = mysqli_connect("localhost","yyj","yyj12345","mydatabase");
if($link){
    $sql="select DB_num,DB_phonenum,DB_name from 骑手黑名单";
    //	$sql = "select * from shop";
    mysqli_query($link,"set NAMES UTF8");
    $result = mysqli_query($link,$sql);
    $allDeliveryBlack = new AllDeliveryBlack();
    while($row = mysqli_fetch_array($result,MYSQLI_NUM)){
        $id = $row[0];
        $phone = $row[1];
        $name = $row[2];
        $deliveryBlackItem = new DeliveryBlackItem($id,$phone,$name);
        $allDeliveryBlack->addDeliveryItem($deliveryBlackItem);
    }
    echo  json_encode($allDeliveryBlack);
}
else{
    echo "数据库连接失败".mysqli_connect_error();
}
class AllDeliveryBlack{
    public $deliveryBlackArr;
    public function __construct()
    {
        $this->deliveryBlackArr = array();
    }
    public function addDeliveryItem($deliveryBlackItem){
        $this->deliveryBlackArr[]=$deliveryBlackItem;
    }
}
class DeliveryBlackItem{
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

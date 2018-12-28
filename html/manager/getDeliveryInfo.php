<?php
/**
 * Created by PhpStorm.
 * User: Genius
 * Date: 2018/12/22
 * Time: 1:48
 */
$link = mysqli_connect("localhost","yyj","yyj12345","mydatabase");
if($link){
    $sql="select D_num,D_name,D_phonenum from 骑手";
    //	$sql = "select * from shop";
    mysqli_query($link,"set NAMES UTF8");
    $result = mysqli_query($link,$sql);
    $allDelivery = new AllDelivery();
    while($row = mysqli_fetch_array($result,MYSQLI_NUM)){
        $id = $row[0];
        $name = $row[1];
        $phone = $row[2];
        $grade = 0;
        $deliveryItem = new DeliveryItem($id,$name,$phone,$grade);
        $allDelivery->addDeliveryItem($deliveryItem);
    }
    echo  json_encode($allDelivery);
}
else{
    echo "数据库连接失败".mysqli_connect_error();
}
class AllDelivery{
    public $deliveryArr;
    public function __construct()
    {
        $this->deliveryArr = array();
    }
    public function addDeliveryItem($deliveryArr){
        $this->deliveryArr[]=$deliveryArr;
    }
}
class DeliveryItem{
    public $id;
    public $name;
    public $phone;
    public $grade;
    public function __construct($id,$name,$phone,$grade)
    {
        $this->id = $id;
        $this->name=$name;
        $this->phone=$phone;
        $this->grade=$grade;
    }
}

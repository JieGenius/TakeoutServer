<?php
/**
 * Created by PhpStorm.
 * User: Genius
 * Date: 2018/12/22
 * Time: 15:23
 */
$link = mysqli_connect("localhost","yyj","yyj12345","mydatabase");
if($link){
    $sql="select CB_num,CB_phonenum,CB_shop_name from 商家黑名单";
    //	$sql = "select * from shop";
    mysqli_query($link,"set NAMES UTF8");
    $result = mysqli_query($link,$sql);
    $allShoBlack = new AllShopBlack();
    while($row = mysqli_fetch_array($result,MYSQLI_NUM)){
        $id = $row[0];
        $phone = $row[1];
        $name = $row[2];
        $shopBlackItem = new ShopBlackItem($id,$phone,$name);
        $allShoBlack->addShopBlackItem($shopBlackItem);
    }
    echo  json_encode($allShoBlack);
}
else{
    echo "数据库连接失败".mysqli_connect_error();
}
class AllShopBlack{
    public $shopBlackArr;
    public function __construct()
    {
        $this->shopBlackArr = array();
    }
    public function addShopBlackItem($shopBlackItem){
        $this->shopBlackArr[]=$shopBlackItem;
    }
}
class ShopBlackItem{
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

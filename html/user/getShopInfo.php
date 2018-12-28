<?php
/**
 * Created by PhpStorm.
 * User: Genius
 * Date: 2018/12/20
 * Time: 23:13
 */
$link = mysqli_connect("localhost","yyj","yyj12345","mydatabase");
if($link){
    $sql="select C_num,C_name,C_phonenum,C_address,C_grade,C_time,C_sales,C_state from 商家 where C_state != 0 order by C_sales desc";
	//	$sql = "select * from shop";
	mysqli_query($link,"set NAMES UTF8");
	$result = mysqli_query($link,$sql);
//	echo mysqli_errno($link);
//	echo mysqli_error($link);
    $allShop = new ALLShop();
    while($row = mysqli_fetch_array($result,MYSQLI_NUM)){
        $id = $row[0];
		$name = $row[1];
        $phone = $row[2];
        $address = $row[3];
        $grade = $row[4];
		$time = $row[5];
		$scales = $row[6];
        $state = $row[7];
        $shopItem = new ShopItem($id,$name,$phone,$address,$grade,$time,$scales,$state);
        $allShop->addShopItem($shopItem);
    }
   echo  json_encode($allShop);
}
else{
    echo "数据库连接失败".mysqli_connect_error();
}

class ALLShop{
    public $shopArr;
    public function __construct()
    {
        $this->shopArr = array();
    }
    public function addShopItem($shopItem){
        $this->shopArr[]=$shopItem;
    }
}
class ShopItem{
    public $id;
    public $name;
    public $phone;
    public $address;
    public $grade;
	public $time;
	public $scales;
    public $state;
    public function __construct($id,$name,$phone,$address,$grade,$time,$scales,$state)
	{
		$this->id = $id;
        $this->name=$name;
        $this->phone=$phone;
        $this->address=$address;
        $this->grade=$grade;
		$this->time=$time;
		$this->scales=$scales;
        $this->state=$state;
    }
}

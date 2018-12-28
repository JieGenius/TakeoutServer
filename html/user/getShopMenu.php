<?php
/**
 * Created by PhpStorm.
 * User: Genius
 * Date: 2018/12/24
 * Time: 11:10
 */
$shopId = $_POST["id"];
$link = mysqli_connect("localhost","yyj","yyj12345","mydatabase");
if($link) {
    mysqli_query($link, "set NAMES UTF8");
	$sql = "select * from 菜单 where C_num = $shopId";
//	echo $sql;
    $result = mysqli_query($link,$sql);
    $menu = new Menu();
    while($row = mysqli_fetch_array($result,MYSQLI_NUM)){
        $num = $row[0];
        $name = $row[1];
        $introduce = $row[2];
        $price = $row[3];
        $discount = $row[4];
        $sales = $row[5];
        $C_num = $row[6];
        $menuItem = new MenuItem($num,$name,$introduce,$price,$discount,$sales,$C_num);
        $menu->addMenuItem($menuItem);
    }
	echo json_encode($menu);
//	echo mysqli_error($link);
}
else{
    echo "数据库连接失败".mysqli_connect_error();
}
class Menu{
    public $menu;

    public function __construct()
    {
        $this->menu = array();
    }
    public function addMenuItem($menuItem){
        $this->menu[]=$menuItem;
    }
}
class MenuItem{
    public $num;
    public $name;
    public $introduce;
    public $price;
    public $discount;
    public $sales;
    public $C_num;
    public function __construct($num, $name, $introduce, $price, $discount, $sales, $C_num)
    {
        $this->num = $num;
        $this->name = $name;
        $this->introduce = $introduce;
        $this->price = $price;
        $this->discount = $discount;
        $this->sales = $sales;
        $this->C_num = $C_num;
    }
}


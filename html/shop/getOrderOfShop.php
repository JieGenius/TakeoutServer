<?php
/**
 * Created by PhpStorm.
 * User: Genius
 * Date: 2018/12/24
 * Time: 22:15
 */

$id = $_POST['id'];
$link = mysqli_connect("localhost","yyj","yyj12345","mydatabase");
$link2 = mysqli_connect("localhost","yyj","yyj12345","mydatabase");
if($link&&$link2) {
	mysqli_query($link, "set NAMES UTF8");
	mysqli_query($link2,"set NAMES UTF8");
    $sql = "select O_num, O_sum, O_time, Delivery_fee, Meal_box_fee, D_phonenum, U_phonenum, U_address, E_content, E_grade
            from 订单信息商家端 where C_num = $id";
    $result = mysqli_query($link,$sql);
    $allOrder = new AllOrder2();
    while($row = mysqli_fetch_array($result)){
        $orderNum = $row[0];
        $orderSum = $row[1];
        $orderTime = $row[2];
        $orderDeliveryFee = $row[3];
        $orderBoxFee = $row[4];
        $deliveryPhone = $row[5];
        $userPhone = $row[6];
        $userAddress = $row[7];
        $commentContent = $row[8];
        $commentGrade = $row[9];
        $commentTime = null;
        $orderItem = new OrderItem2($orderNum,$orderSum,$orderTime,$orderDeliveryFee,$orderBoxFee,$deliveryPhone,$userPhone,$userAddress,$commentContent,$commentGrade,$commentTime);
		$sql2 = "select OI_price,OI_count,M_name from 订单物品名称 where 订单物品名称.O_num = $orderNum";
		//echo $sql2;
		$result2 = mysqli_query($link2,$sql2);
//		echo mysqli_error($link2);
        while($row2 = mysqli_fetch_array($result2,MYSQLI_NUM)){
            $name = $row2[2];
            $count = $row2[1];
            $mealItem = new MealItem($name,$count);
            $orderItem->addMealItem($mealItem);
        }
        mysqli_free_result($result2);
        $allOrder->addOrderItem($orderItem);
    }
    echo json_encode($allOrder);
}
else{
    echo "数据库连接失败".mysqli_connect_error();
}
class AllOrder2{
    public $allOrder;
    public function __construct()
    {
        $this->allOrder = array();
    }
    public function addOrderItem($orderItem){
        $this->allOrder[]=$orderItem;
    }
}
class OrderItem2{
    public $orderNum;
    public $orderSum;
    public $orderTime;
    public $orderDeliveryFee;
    public $orderBoxFee;
    public $deliveryPhone;
    public $userPhone;
    public $userAddress;
    public $commentContent;
    public $commentGrade;
    public $commentTime;
    public $allMeal;
    public function __construct($orderNum, $orderSum, $orderTime, $orderDeliveryFee, $orderBoxFee, $deliveryPhone, $userPhone, $userAddress, $commentContent, $commentGrade, $commentTime)
    {
        $this->orderNum = $orderNum;
        $this->orderSum = $orderSum;
        $this->orderTime = $orderTime;
        $this->orderDeliveryFee = $orderDeliveryFee;
        $this->orderBoxFee = $orderBoxFee;
        $this->deliveryPhone = $deliveryPhone;
        $this->userPhone = $userPhone;
        $this->userAddress = $userAddress;
        $this->commentContent = $commentContent;
        $this->commentGrade = $commentGrade;
        $this->commentTime = $commentTime;
        $this->allMeal = array();
    }
    public function addMealItem($mealItem){
        $this->allMeal[]=$mealItem;
    }


}
class MealItem{
    public $name;
    public $count;
    public function __construct($name, $count)
    {
        $this->name = $name;
        $this->count = $count;
    }

}

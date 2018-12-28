<?php
/**
 * Created by PhpStorm.
 * User: Genius
 * Date: 2018/12/22
 * Time: 13:25
 */
$link = mysqli_connect("localhost","yyj","yyj12345","mydatabase");
if($link){
    $sql="SELECT O_num, O_sum, O_time, Delivery_fee, Meal_box_fee, D_num,
 C_num, U_num, C_name, C_phonenum, U_name, U_phonenum, D_name, D_phonenum, E_content, E_grade FROM 订单详细信息;";
    mysqli_query($link,"set NAMES UTF8");
    $result = mysqli_query($link,$sql);
    $allOrder = new AllOrder();
    while($row = mysqli_fetch_array($result,MYSQLI_NUM)){
        $id = $row[0];//订单编号
        $sumFee = $row[1];//总费用
        $time = $row[2];//下单时间
        $deliveryFee = $row[3];//配送费
        $boxFee = $row[4];//餐盒费
        $shopPhone = $row[9];//商家电话
        $userPhone = $row[11];//用户电话
        $deliveryPhone = $row[13];//配送员电话
        $comment = $row[14];//评论
        $comment_grade = $row[15];//评论时间
        $orderItem = new OrderItem($id,$time,$deliveryFee,$boxFee,$sumFee,$shopPhone,$deliveryPhone,$userPhone,$comment,$comment_grade);
        $allOrder->addOrderItem($orderItem);
    }
    echo  json_encode($allOrder);
}
else{
    echo "数据库连接失败".mysqli_connect_error();
}
class AllOrder{
    public $orderArr;
    public function __construct()
    {
        $this->orderArr = array();
    }
    public function addOrderItem($orderArr){
        $this->orderArr[]=$orderArr;
    }
}
class OrderItem{
    public $id;
    public $time;
    public $deliveryFee;
    public $boxFee;
    public $sumFee;
    public $shopPhone;
    public $deliveryPhone;
    public $userPhone;
    public $comment;
    public $comment_grade;
    public function __construct($id,$time,$deliveryFee,$boxFee,$sumFee,$shopPhone,$deliveryPhone,$userPhone,$comment,$comment_grade)
    {
        $this->id = $id;
        $this->time = $time;
        $this->deliveryFee = $deliveryFee;
        $this->boxFee = $boxFee;
        $this->sumFee = $sumFee;
        $this->shopPhone = $shopPhone;
        $this->deliveryPhone = $deliveryPhone;
        $this->userPhone = $userPhone;
        $this->comment = $comment;
        $this->comment_grade = $comment_grade;
    }
}
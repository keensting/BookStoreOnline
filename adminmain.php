<?php
include('./parameter/params.php');
/**
 * Created by PhpStorm.
 * User: keensting
 * Date: 15-5-26
 * Time: 下午8:14
 */
$name;
$id;
session_start();
if($_SESSION['state']==1)
{
    session_destroy();
}
else {
    $name = $_SESSION['name'];
    $id = $_SESSION['id'];
}




/**
 *清除session数据
 */


function dsession()
{
    $url='./index.html';
    $_SESSION['state']=1;
    echo "location.href='$url'";

}


/*
 * 获取待处理订单
 */

$sql="select orderid,sum,state from billsremian limit 0,5";
$con=new dbconnect($sql);
$result=$con->excutequery();
$num=$con->getnum();
$con->shutdown();







?>

<html>
<head>
    <title>书店管理</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css"/>
    <script type="text/javascript" src="./js/jquery1.10.2.js"></script>
    <script>
        $(document).ready(function()
        {
            $(".shelf3").hide();
            $(".order3").hide();
            $(".shelf2").hover(function()
            {
                $(".shelf3").fadeIn(600);
                $(".shelf3").fadeOut(2000);
            },600);

            $(".order2").hover(function()
            {
                $(".order3").slideDown(600);
                $(".order3").slideUp(2000);

            },600);

        });

        function ordermanage()
        {
            document.location="./ordermanage.php";//跳转网页
        }
        function shelfmanage()
        {
            document.location="./bookmanage.php"
        }

    </script>
</head>

<body>
<div class="welcome_top">
    <h1>传林书阁</h1>
    <h4>为心灵点亮一盏明灯</h4>
    <?php
    if(!$name)
    {
      ?><div class="userinfo">游客,您好！<br>
            <center><button onclick="document.location='./index.html' ">登陆</button></center>
    </div>
    <?php


    }
    else {


        ?>
        <div class="userinfo">欢迎您<?php echo $name; ?><br>

            <center>
                <button onclick="<?php dsession(); ?>">注销</button>
            </center>
        </div>
    <?php
    }
    ?>

</div>

<div class="shelf1">
   <div class="shelf2" onclick="shelfmanage()" ></div>
    <div class="shelf3"> 书架管理</div>

</div>

<div class="order1">
    <div class="order2" onclick="ordermanage()" ></div>
    <div class="order3">订单管理</div>
</div>

<div class="orderbox">
<table style="position:relative; top:100px;left:30px; border:0px" width="300px">
    <tr>
        <td style="color:red; font-size: 25px; text-align: center">待处理订单</td>
    </tr>
    <tr>

    </tr>

    <?php
        for($i=0;$i<$num;$i++)
        {
            $row=mysqli_fetch_assoc($result);
            ?>

            <tr>
                <td>
                    <marquee direction="left" scrollamount="5">
                    <?php echo "订单号：".$row['orderid'].";总价：".$row['sum'];
                    if($row['state']==1) {
                        echo ";状态：买家已付款";
                    }
                    else{
                        echo ";状态：等待买家付款";
                    }

                    ?>
                        </marquee>
                </td>
            </tr>

    <?php
        }
    ?>



</table>


</div>
<footer>
    <center>DesignBy:KeenSting</center>
</footer>
</body>

</html>
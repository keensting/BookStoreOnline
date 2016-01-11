<?php
include("./parameter/params.php");
/**
 * Created by PhpStorm.
 * User: keensting
 * Date: 15-5-26
 * Time: 下午10:43
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

$sql="select * from books limit 0,30";
$con=new dbconnect($sql);
$result=$con->excutequery();
$num=$con->getnum();
$con->shutdown();


?>


<html>

<head>
    <title>书架管理</title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <script type="text/javascript" src="./js/jquery1.10.2.js"></script>

    <script>

        $(document).ready(function()
        {
            $("upbook").hide();
            $("downbook").hide();
            $("back").hide();
            $(".upshelf").hover(function()
            {
                $("upbook").fadeIn(600);
                $("upbook").fadeOut(2000);


            },600);



            $(".downshelf").hover(function()
            {
                $("downbook").fadeIn(600);
                $("downbook").fadeOut(2000);


            },600);
            $(".backadmin").hover(function()
            {
                $("back").fadeIn(600);
                $("back").fadeOut(2000);
            },600);

        });

    </script>


</head>
<body>
<div class="welcome_top">
    <h1>书架管理</h1>
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

<div class="upshelf" >

    <upbook style=" font-size: 30px;color:white;position: relative;top: 40px;left:30px" > 上架</upbook>
</div>


<div class="downshelf">
    <downbook  style=" font-size: 30px;color:white;position: relative;top: 40px;left:30px" onclick="document.location='./downshelf.php';">下架</downbook>
</div>

<div class="backadmin">
    <back style=" font-size: 30px;color:white;position: relative;top: 40px;left:30px" onclick="document.location='./adminmain.php'">返回</back>

</div>

<div class="bookshelf">

    <?php
        for($i=0;$i<$num;$i++) {
            $row=mysqli_fetch_assoc($result);
            ?>
            <div class="matrix" title="<?php echo $row['bookdetail'];  ?>">
                <img src="<?php echo $row['img'];  ?>"/><br>
                <table align="center">
                    <tr>
                        <td>图书编号：</td>
                        <td><?php echo $row['bookid'] ; ?></td>
                    </tr>
                    <tr>
                        <td>图书名称：</td>
                        <td>《<?php echo $row['bookname'] ; ?>》</td>
                    </tr>
                    <tr>
                        <td>图书作者：</td>
                        <td><?php echo $row['author'] ; ?></td>
                    </tr>
                    <tr>
                        <td>ISBN：</td>
                        <td><?php echo $row['booknumber'] ; ?></td>
                    </tr>
                    <tr>
                        <td>出版社：</td>
                        <td><?php echo $row['publish'] ; ?></td>
                    </tr>
                    <tr>
                        <td>售价：</td>
                        <td><?php echo $row['price'] ; ?>RMB</td>
                    </tr>
                </table>

            </div>
        <?php
        }
        ?>
</div>






<footer>
    <center>DesignBy:KeenSting</center>
</footer>

</body>
</html>
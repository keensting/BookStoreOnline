<?php

include("./parameter/params.php");
/**
 * Created by PhpStorm.
 * User: keensting
 * Date: 15-5-27
 * Time: 下午8:11
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


$num=$_POST['num'];
$drop=$_POST['drop'];

if($drop=='')
{

}
else{
    echo $drop;
    dropbook($drop);
}


/**
 *删除图书信息
 */
function dropbook($num)
{
    $query="delete from books where bookid='$num'";
    $con=new doquery($query);


}


?>




<html>
<head>
    <title>
        商品下架
    </title>
    <link rel="stylesheet" type="text/css" href="./css/style.css">
    <script type="text/javascript" src="./js/jquery1.10.2.js/"></script>

<!--    <script>-->
<!--        $(document).ready(function()-->
<!--        {-->
<!---->
<!--            $("#search").click(function()-->
<!--            {-->
<!---->
<!--                alert($("#num").val());//获得输入框的值-->
<!---->
<!--            });-->
<!--        });-->
<!---->
<!---->
<!---->
<!---->
<!--    </script>-->

    <script>

        function refresh()
        {
            alert("目标书籍已经从书架中移除！");
            document.location.href="./downshelf.php";
        }

        function back()
        {
            document.location.href="./bookmanage.php";
        }

    </script>

</head>
<body>
<div class="welcome_top">
    <h1>书本下架</h1>
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


<div class="backboard">
    <center>
    <label style="text-align: center; font-size: 30px;margin-top: 50px; color: red">请输入书本编号：</label><br>
        <form method="post" action="./downshelf.php">
        <input id="num" name="num" maxlength="20" width="200px" height="40px" style="border-radius: 10px" placeholder="输入书本编码"><br>

                    <td><button type="submit" id="search" >查询</button></td>


        </form>



        <!-- <iframe src="./parameter/bookdetails.php" frameBorder="0" width="400" scrolling="no" height="400"></iframe>-->


        <?php
            if($num=='')
            {

            }
            else
            {

                $sql="select * from books where bookid='$num'";
                $con=new dbconnect($sql);
                $num1=$con->getnum();
                $result=$con->excutequery();

                $row=mysqli_fetch_assoc($result);
                $con->shutdown();

                if($num1==1) {


                    ?>


                    <img src="<?php echo $row['img']; ?>"/>

                    <table style="margin: 20px">
                        <tr>
                            <td>图书编号：</td>
                            <td id="bookid"><?php echo $row['bookid']; ?></td>

                        </tr>
                        <tr>
                            <td>图书名称：</td>
                            <td id="bookname"><?php echo $row['bookname']; ?></td>

                        </tr>
                        <tr>
                            <td>ISBN：</td>
                            <td id="booknumber"><?php echo $row['booknumber']; ?></td>

                        </tr>
                        <tr>
                            <td>图书作者：</td>
                            <td id="author"><?php echo $row['author']; ?></td>

                        </tr>
                        <tr>
                            <td>出版社：</td>
                            <td id="publish"><?php echo $row['publish']; ?></td>

                        </tr>
                        <tr>
                            <td>售价：</td>
                            <td id="price"><?php echo $row['price']; ?>RMB</td>

                        </tr>
                    </table>
                    <br>

                    <textarea
                        style="height: 250px; width: 400px; margin-bottom: 20px;">书本简介:<?php echo $row['bookdetail']; ?></textarea>
                    <br>
                    <form method="post" action="./downshelf.php">
                    <table style="margin-bottom: 100px">
                        <tr>
                            <td>
                                <button>修改</button>
                            </td>
                            <td>

                                <button onclick="refresh()" type="submit" value="<?php echo $num;?>" name="drop">下架</button>

                            </td>
                        </tr>


                    </table>
                     </form>
                <?php
                }
                else
                {
                    echo "没有查到书本信息！<br>请检查书本编号并重试！<br><br>";
                }
            }
        ?>

    </center>
</div>




<div style="height: 70px;width: 100px;border-radius: 20px;margin: 50px; background-color: #33ff66; opacity: 0.7;">
<button onclick="back();"  type="button" id="back">返回</button>
</div>
<footer>
    <center>DesignBy:KeenSting</center>
</footer>
</body>


</html>
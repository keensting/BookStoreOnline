<html>
<head>
    <title>waiting</title>
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: keensting
 * Date: 15-5-26
 * Time: 下午1:42
 */

$name=$_POST['admin'];
$password=$_POST['apw'];
/*
 * mysqli测试文件
 */
$db=mysqli_connect("localhost","root","281612","bookstore");

$result=mysqli_query($db,"select * from admin where id='100000'");

//$num=mysqli_num_rows($result);





$re=mysqli_fetch_assoc($result);






/*
 * mysql测试文件
 */
//$con = mysql_connect("localhost","root","281612");
//if (!$con)
//{
//    die('Could not connect: ' . mysql_error());
//}
//
//mysql_select_db('bookstore',$con);
//
//$re=mysql_query("select * from user");
//
//
//
//while($row = mysql_fetch_array($re))
//{
//    echo $row['id'] . " " . $row['name'];
//    echo "<br />";
//}

$tname=$re['name'];
$tpw=$re['passwd'];
$id=$re['id'];

//将用户名，id加入session
session_start();
$_SESSION['name']=$tname;
$_SESSION['id']=$id;



if($name==$tname && $tpw==$password)
{

    ?>
    <center>
        <img style="margin-left: auto;margin-right:height: 200px; width: 150px; border-radius: 20px; opacity: 0.8; align-content: center"  src="./pic/ok.jpg"><br>
    </center>
    <h2 style="color: green; text-align: center">登陆成功！</h2>
    <meta http-equiv="refresh" content="1;url='./adminmain.php'"/>
    <?php

}
else
{
    ?>
    <center>
        <img style="width: 150px;height: 200px; border-radius: 10px;opacity: 0.8;" src="./pic/error.gif"/>
    </center>
    <h2 style="color: red;text-align: center">用户名或密码错误！<br>请重试！</h2>
    <meta http-equiv="refresh" content="2;url='./index.html'" >


<?php
}


mysqli_close($db);

?>
</body>
</html>





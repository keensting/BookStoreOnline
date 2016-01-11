<?php
/**
 * Created by PhpStorm.
 * User: keensting
 * Date: 15-5-27
 * Time: 下午10:21
 */
$id=$_POST['num'];

?>

<html>
<head>

    <title>
        bookdetails
    </title>
</head>
<body>

<center>
<table style="margin: 20px">
    <tr>
        <td>图书编号：</td>
        <td id="bookid"><?php echo $id; ?></td>

    </tr>
    <tr>
        <td>图书名称：</td>
        <td id="bookname"></td>

    </tr>
    <tr>
        <td>ISBN：</td>
        <td id="booknumber"></td>

    </tr>
    <tr>
        <td>图书作者：</td>
        <td id="author"></td>

    </tr>
    <tr>
        <td>出版社：</td>
        <td id="publish"></td>

    </tr>
    <tr>
        <td>售价：</td>
        <td id="price"></td>

    </tr>
</table>
</center>
</body>


</html>
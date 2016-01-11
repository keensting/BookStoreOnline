<?php
/**
 * Created by PhpStorm.
 * User: keensting
 * Date: 15-5-27
 * Time: 下午12:03
 */




class dbconnect
{
    public $db,$result,$num;


    /**
     *structure methods
     */
    function dbconnect($sql)
    {
        $this->db=mysqli_connect('localhost','root','281612','bookstore');
        mysqli_query($this->db,"set names utf8");
        $this->result=mysqli_query($this->db,$sql);
        $this->num=mysqli_num_rows($this->result);


    }

    /**
     * @return mysqli 返回数据库链接
     */
    function getconnect()
    {

        return $this->db;


    }

    /**
     * @param $sql 执行sql语言 返回result
     */
    function excutequery()
    {

        return $this->result;
    }
    /**
     *关闭数据库链接
     */
    function shutdown()
    {
        mysqli_close($this->db);
    }

    function getnum()
    {


        return $this->num;
    }
}


/**
 * @param $sql 增删数据库文件
 */
class doquery
{
    public  $db;
    function  doquery($sql)
    {
        $this->db=mysqli_connect("localhost","root","281612","bookstore");
        mysqli_query($this->db,$sql);
        mysqli_close($this->db);

    }

}
?>
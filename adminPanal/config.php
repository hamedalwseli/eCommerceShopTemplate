<?php
$dsn="mysql:host=localhost;dbname=shopDB";
$user="root";
$pass="";
$option=array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8' //عشان الترميز
);
try{
    $conn=new PDO($dsn,$user,$pass,$option);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}
catch(PDOExeption $e){
echo 'failed to connect'. $e->getMassage();
}
?>
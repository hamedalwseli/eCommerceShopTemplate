<?php
require_once('init.php');


function getAllFrom($field,$table,$where=NULL,$and=NULL,$orderfield,$ordering='DESC'){
global $conn;
$getAll=$conn->prepare("SELECT $field from $table  $where AND  $and ORDER BY $orderfield $ordering");
$getAll->execute();
$all =$getAll->fetchAll();
return $all;
}

//page title this simple function make a title for the page if the tite varible exist  in the carrunt page v1.0
function title(){ 
    global $title;
    if(isset($title))
        echo $title;
    else
        echo "defult";
}

//redirect function  v2.0

function redirectHome($TheerrorMsg,$url=null,$seconds=0.5){
    if($url===null){
        $url='index.php';
    }
    else{
        $url=$_SERVER['HTTP_REFERER'];
        }
    echo $TheerrorMsg;
    echo "<div class='alert alert-info' style='text-align:center'>you will redirect after $seconds seconds.</div>'";
    header("refresh:$seconds;url=$url");
    exit();
}


/* 
**check items function v1.0
**function to check item in database
**$select=the item to select from 
**$from=the table  to select from 
**$value=the value of select
*/
function checkItems($select,$from,$value){

global $conn;

$sql=$conn->prepare("SELECT $select from $from where $select =  ?");
$sql->execute(array($value));

$count=$sql->rowCount();

return $count;
}


// count function numbers of itmes v3
function countItems($item,$table,$where=null){
    global $conn;
    if(isset($where)){
       $stmt=$conn->prepare("SELECT COUNT($item) FROM $table where reg_status=0");
    $stmt->execute();
    }
    else{
         $stmt=$conn->prepare("SELECT COUNT($item) FROM $table");
    $stmt->execute();
    }
    
    return $stmt->fetchColumn();
}
// get latest recoreds funtion v1.0 
// function to get latest items from database
function getLatest($select,$table,$limit=5){
    global $conn;
    $sql=$conn->prepare("SELECT $select FROM $table LIMIT $limit");
    $sql->execute();
    $rows=$sql->fetchAll();

    return $rows;
}
?>
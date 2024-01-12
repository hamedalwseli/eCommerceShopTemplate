<?php
require_once('init.php');


// get latest recoreds funtion v1.0 
// function to get latest items from database

function getCatInfo($faild,$cat_name,$return='name'){
    global $conn;
    $sql=$conn->prepare("SELECT $faild FROM categories where name=? limit 1");
    $sql->execute(array($cat_name));
    $rows=$sql->fetch();
    return $rows[$return];
}

function getCat(){
    global $conn;
    $sql=$conn->prepare("SELECT * FROM categories where parent=0 order by id ASC");
    $sql->execute();
    $rows=$sql->fetchAll();

    return $rows;
}
// to display all things
function getAll($table,$id='id'){
    global $conn;
    $sql=$conn->prepare("SELECT * FROM $table where approve=1 order by $id DESC");
    $sql->execute();
    $rows=$sql->fetchAll();
    return $rows;
}
// get latest recoreds funtion v1.0 
// function to get latest items from database
function getItems($cat_id){
    global $conn;
    $sql=$conn->prepare("SELECT * FROM items  where cat_id=? AND approve=1 order by item_id desc");
    $sql->execute(array($cat_id));
    $rows=$sql->fetchAll();

    return $rows;
}
 
// check if user is not activate 
// function to check the regstatus of the user 
function checkUserStatus($user){
    global $conn;
    $stmtx=$conn->prepare("SELECT 
                            user_name,reg_status
                        FROM
                            users
                        where 
                            user_name=?
                        AND 
                            reg_status=0;
                        ");

    $stmtx->execute(array($user));
    $status=$stmtx->rowCount();
    return $status;
}



function checkUserInTheDataBase($userName){

}


// ============================================================================================================



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
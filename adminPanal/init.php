<?php
//routes
$tempPath="inclouds/templates/"; //template folder path 
$css="desgin/css/";//css folder path 
$js="desgin/js/";//js folder path 
$fonts="desgin/fonts/";//fonts folder path
$img="desgin/img/" ;
$func="inclouds/functions/";//function folder path 
$langs="inclouds/langs/";//languages folder path 
$alphabtNumRugEx='/^[أ-يa-zA-Z_1-9 ]{1,20}$/u';
$alphabtRugEx='/^[أ-يa-zA-Z_ ]{3,20}$/u';



// include important files
require($func.'functions.php');
    require($tempPath."header.php");
 if($lang=='en'){
    require($langs.'en.php');
 }
 if($lang=='ar'){
    require($langs.'ar.php');
 }    require('config.php');

    if(!isset($nonavbar))   //المتغير يجب ان يكون في الملف المراد عدم ظهور الملف المستدعي //طريقة منع ادراج الملف 
    require($tempPath."navbar.php");  
?>
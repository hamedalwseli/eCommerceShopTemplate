<!DOCTYPE html>
<?php
$lang=isset($_GET['lang'])?($_GET["lang"]):'en';
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo $css;?>style62.css">
    <link rel="stylesheet" href="<?php echo $fonts;?>all.min.css">
    <link rel="stylesheet" href="<?php echo $css;?>bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $css;?>jquery-ui.css">
    <link rel="stylesheet" href="<?php echo $css;?>jquery.selectBoxIt.css">
    <link rel="stylesheet" href="<?php echo $css;?>normalize.css">
    <title><?php title();?></title>
</head>
<body dir='<?php 
if($lang=='ar'){
    echo 'rtl';
}
?>'>
    
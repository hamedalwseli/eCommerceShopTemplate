<?php
session_start();
$title ='categories';
require_once('init.php');
 if($_SERVER['REQUEST_METHOD']=='POST'){
    $search=$_POST['search_box'];
        $getUserInfo=$conn->prepare("SELECT  * from items WHERE name LIKE '%".$search."'");
        $getUserInfo->execute();
        $rows=$getUserInfo->fetchAll();
        foreach($rows as $item){
        echo "<div class=' col-sm-4 col-md-3 product'>";
            echo "<div class ='box'>";
            echo "<a href='item.php?itemID=".$item['item_id']."'><button type='submit' class='fas fa-eye' name='quick_view'></button></a>";
            echo '<a href="?lang=en&pageid=5&catName=electronics?item_id=1"><button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button></a>';
                echo "<div class='img-box'>";
                if(empty($item['avatar'])){
                 echo '<img src="desgin/img/feature01.jpg" class="img-responsive" alt="">';
                 }
                  else{ echo "<img src='adminPanal/uploads/products/".$item['avatar']."' class='' alt>";} 
                  echo  "</div>";
                echo "<div class='info'>";
                     echo "<h3 class='cat-name'>".$item['name']."</h3>";
                     echo "<p class='price'>".$item['price']."$</p>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
        }
        
 }
?>

<div class="categories-m">
    <div class="heading">
    <h3><?php echo str_replace("-"," ",$_GET['catName']);?></h2>
         <p><a href="index.php">home</a><span></span></p>
    </div>
    <div class="container">
                <section class="search">
            <div class="container">
                <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                    <input type="text" name="search_box" placeholder="search here...." class="box">
                    <button type="submit" name="search_btn" class="fas fa-search"></button>
                </form>
            </div>
        </section>
        <div class="row gap-top-items-categories-page">
        <?php
        foreach(getItems($_GET['pageid']) as $item){
        echo "<div class=' col-sm-4 col-md-3 product'>";
            echo "<div class ='box'>";
            echo "<a href='item.php?itemID=".$item['item_id']."'><button type='submit' class='fas fa-eye' name='quick_view'></button></a>";
            echo '<a href="?lang=en&pageid=5&catName=electronics?item_id=1"><button type="submit" class="fas fa-shopping-cart" name="add_to_cart"></button></a>';
                echo "<div class='img-box'>";
                if(empty($item['avatar'])){
                 echo '<img src="desgin/img/feature01.jpg" class="img-responsive" alt="">';
                 }
                  else{ echo "<img src='adminPanal/uploads/products/".$item['avatar']."' class='' alt>";} 
                  echo  "</div>";
                echo "<div class='info'>";
                     echo "<h3 class='cat-name'>".$item['name']."</h3>";
                     echo "<p class='price'>".$item['price']."$</p>";
                echo "</div>";
            echo "</div>";
        echo "</div>";
        }
        ?>
        </div>
    </div>
</div>

<?php
require_once($tempPath.'footer.php')
?>
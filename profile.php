
<?php
session_start();

ob_start();
$title="page";
if(isset($_SESSION['endUser'])){
require_once('init.php');

$getUserInfo=$conn->prepare('SELECT  * from users WHERE user_name=?');
$getUserInfo->execute(array($_SESSION['endUser']));
$rows=$getUserInfo->fetchAll();
?>
<div class="profile">
    <div class="container">
        <h2 class='title'>my profile</h2>
        <div class="box info">   
                <div class="panel panel-default">
                    <div class="panel-heading">my details</div>
                    <div class="panel-body">
                        <?php foreach($rows as $row){?> 
                           <div class="latestUser">
                              <p><i class="fa fa-unlock-alt fa-fw"></i>login name: <?php echo $row['user_name']?></p>
                           </div>
                           <div class="latestUser">                           
                             <p><i class="fa-regular fa-envelope"></i>email:<?php echo $row['email']?></p>
                           </div>
                            <div class="latestUser">                          
                           <p><i class="fa-solid fa-user"></i> full name: <?php echo $row['full_name']?></p>
                           </div> 
                         <div class="latestUser">                          
                           <p><i class="fa-solid fa-calendar-days"></i> register date: <?php echo $row['date']?></p>
                        </div> 
                         <div class="latestUser">                          
                           <p><i class="fa-solid fa-star"></i> favourite catefory:</p>
                        </div> 
                   
                       <?php }?>
                    </div> 
                     <a href="#" class='add-btn-s'> <i class="fa-solid fa-pen-to-square"></i> edit profile</a>
                </div>
        </div>
        <div class="box ads">   
                <div class="panel panel-default">
                    <div class="panel-heading">my ads</div>
                    <div class="panel-body">
                        <?php
                        $stat=$conn->prepare('SELECT *  FROM items where user_id=?');
                        $stat->execute(array($_SESSION['id']));
                        $items=$stat->fetchAll();
                        if(!empty($items)){
                                echo '<div class="row profile-items">';
                                    foreach($items as $item){
                                    echo "<div class=' col-sm-6 col-md-4 product'>";
                                        echo "<div class ='box'>";
                                            echo "<a href='item.php?itemID=".$item['item_id']."'><button type='submit' class='fas fa-eye' name='quick_view'></button></a>";
                                            if($item['approve']==0){
                                                echo '<span class="approve-span">waiting approval</span>';
                                            }
                                            echo "<div class='img-box'>";
                                            if(empty($item['avatar'])){
                                            echo '<img src="desgin/img/feature01.jpg" class="img-responsive" alt="">';
                                            }
                                            else{ echo "<img src='adminPanal/uploads/products/".$item['avatar']."' class='' alt>";} echo  "</div>";
                                            echo "<div class='info'>";
                                                echo "<h3 class='cat-name'>".$item['name']."</h3>";
                                                echo "<p style='max-height:44px;overflow: auto;'>".$item['description']."</p>";
                                                echo "<p class='price'> <span>".$item['price']."$</span><span class='date'>".$item['add_date']."</span></p>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</div>";
                                    }
                            echo '</div>';
                        }
                        else{
                       
                      echo' <div class="latestUser"><p>you do not have any ads,create <a href="newad.php">new ad<a> </p></div>' ;
                        }
                      ?>
                    </div>
                </div>
        </div>
        <div class="box comments ">   
            <?php
            $stat=$conn->prepare('SELECT * from comments where user_id=?'); 
            $stat->execute(array($_SESSION['id']));
            $comments=$stat->fetchAll();
            ?>
                <div class="panel panel-default">
                    <div class="panel-heading">my comments</div>
                    <div class="panel-body">
                        <?php 
                    if(!empty($comments)){
                    foreach($comments as $comment){
                      echo "<div class='latestUser'><p>".$comment['comment']."</p></div>";
                    }
                       ?> 
                        <?php }else{
                echo   " <div class='latestUser'><p>you do not have any comments </p></div>";
                       }?>

                    </div>
                </div>
           
        </div>
    </div>
</div>
<?php
}
else{
    header('location:index.php');
    exit();
}
require_once($tempPath.'footer.php');

ob_end_flush();
?>

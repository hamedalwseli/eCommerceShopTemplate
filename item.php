<?php
session_start();
ob_start();
$title="products details ";
require_once('init.php');

         $itemid=isset($_GET['itemID']) && is_numeric($_GET['itemID'])?intval($_GET["itemID"]):0;
        $stmt=$conn->prepare("SELECT  items.* , categories.name as cat_name ,users.user_name
        FROM 
            items 
        INNER JOIN 
            categories
        on 
            categories.id=items.cat_id
        INNER JOIN 
            users
        on 
            users.user_id=items.user_id
        Where 
            item_id=?
        AND
            approve=1;
            ");
      $stmt->execute(array($itemid));
      
      $count=$stmt->rowCount();
      if($count>0){
        $row=$stmt->fetch();
?>
<div class="profile p-0">
        <div class="heading">
    <h3 ><?php echo $row['name'];?> details</h2>
         <p><a href="index.php">home</a> <span> /<?php echo $title;?></span></p>
    </div>
    <div class="container">
        <div class=" show-details row">
            <div class="col-md-4">
                <div class="img-box">
                    <?php
                        if(empty($row['avatar'])){
                            echo '<img src="desgin/img/feature01.jpg" class="img-responsive" alt="">';
                 }
                  else{ echo "<img src='adminPanal/uploads/products/".$row['avatar']."' class='' alt>";} 
                    ?>
            </div>
            </div>
            <ul class="col-md-8 info">
                <h2><?php echo $row['name'];?></h2>
                <li><span><i class="fa-regular fa-font-awesome"></i></span> <?php echo $row['description'] ?></li>
                <li> <span class="r"><i class="fa fa-calendar fa-fw"></i> added date : </span><?php echo $row['add_date'] ?></li>
                <li> <span class="r"><i class="fa fa-building fa-fw"></i> made in: </span><span class="l"> <?php echo $row['country_made'] ?></span></li> 
                <li><span class='r'><i class="fa fa-money-bill fa-fw"></i> price: </span> <span> <?php echo $row['price'] ?></span></li>
                <li><a href="categories.php?pageid=<?php echo $row['cat_id']?>&catName=<?php  echo $row['cat_name'] ?>"><span class='r'><i class="fa fa-tags fa-fw"></i> category name: </span> <span> <?php echo $row['cat_name'] ?></span></a></li>
                <li> <a href=""><span class='r'><i class="fa fa-user fa-fw"></i> add by: </span> <span class="l"> <?php echo $row['user_name'] ?></span></a></li>
               
             </ul>
        </div>
        <?php if(isset($_SESSION['endUser'])){?>
        <!-- start add comment  -->
        <div class="row">
            <div class="col-md-4 "></div>
            <div class="col-md-8 p-0 show-details">
                <form action="<?php echo $_SERVER['PHP_SELF'].'?itemID='.$row['item_id']?>" method="post">
                    <input placeholder="leave your comment" class="input" name="comment" type="text">
                    <input type='submit' class="button" value='send'>
                </form>
                <?php
                if($_SERVER['REQUEST_METHOD']=='POST'){
                    $comment=filter_var($_POST['comment'],FILTER_SANITIZE_STRING);
                    $user_id=$_SESSION['id'];
                    $item_id=$row['item_id'];
                    if(!empty($comment)){
                        $stmt=$conn->prepare('INSERT INTO comments
                                (comment,status,comment_date,item_id,user_id)
                        VALUES(:comment,0,now(),:item_id,:user_id)
                        ');
                        $stmt->execute(array(
                            'comment' => $comment,
                            'item_id' =>$item_id,
                            'user_id' =>$user_id
                        ));
                        if($stmt){
                            echo'<p class="comment-success"><i class="fa-solid fa-circle-check"></i> comment added</ p>';
                        }
                    }
                }
                ?>
            </div>
        </div>
        <?php } 
        else{?>
          <div class="row">
            <div class="col-md-4 "></div>
            <div class="col-md-8 p-0 show-details">
                <h3 class="to-add-comments"> to add comments <a href="login.php"> login</a> or <a href="login.php"> register</a></h3>
            </div>
        </div>
       <?php }
            //START  display the comments 
                        $stmt=$conn->prepare("SELECT comments.*,users.user_name as user_name
                                            FROM comments
                                            INNER JOIN
                                                users
                                            ON
                                                users.user_id=comments.user_id
                                            WHERE 
                                                item_id=?
                                            AND
                                                status=1;
                                            order by 
                                                c_id DESC
                                            ");
                        $stmt->execute(array($row['item_id']));
                        $rows=$stmt->fetchAll();

                        //end  display the comments 
                ?>   
        <!-- start add comment  -->
        <div class="row p-0">
            <div class="col-md-1">
                <?php
                    
                 foreach($rows as $comment){
                      echo "<div class='user-name-comment' style='text-align:center'>".$comment['user_name']."</div>";
                  }
                
                ?>
                
            </div>
            <div class="col-md-11 p-0 ">
                    <?php

                 foreach($rows as $comment){
                      echo "<div class='user-comment'>".$comment['comment']."</div>";
                  }
                
                ?>
            </div>
        </div>
    </div>
</div>
<?php
      }else{
        $errorMsg="<h2 class='title'>there is no such itme with this id or item is under approval </h2>";
     redirectHome($errorMsg,'back',3);  

      }
require_once($tempPath.'footer.php');

ob_end_flush();
?>

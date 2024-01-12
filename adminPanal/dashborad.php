<?php
 //output buffering start //storage all output without header 
session_start();
$title="dashboard";
if(isset($_SESSION["username"])){
    require('init.php');
    // start dashboard page

        ?>
    <div class="dashboard main">
        <h1 class="title"><?php echo lang("DASHBOARD")?></h1>
        <div class="container one">
            <div class="row">
                <div class="col-md-3">
                    <a href="members.php">
                    <div class="stat">
                        <p><?php echo lang("TOTAL_MEMBERS")?></p>
                        <span><?php echo countItems('user_id','users')?></span>
                    </div>
                </a>
                </div>
                <div class="col-md-3">
                    <a href="members.php?do=manage&activate=pending">
                    <div class="stat">
                      <p><?php echo lang("PENDING_MEMBERS")?></p>  
                        <span><?php echo countItems('reg_Status','users','0')?></span>
                    </div>
                </a>
                </div>
                <div class="col-md-3">
                     <a href="items.php?do=manage&activate=pending">
                    <div class="stat">
                      <p><?php echo lang("TOTAL_ITEMS")?></p>  
                        <span><?php echo countItems('item_id','items')?></span>
                    </div>
                </a>
                </div>
                <div class="col-md-3">
                    <a href="comments.php?do=manage">
                        <div class="stat">
                            <p><?php echo lang("TOTAL_COMMENTS")?> </p>
                            <span><?php echo countItems('c_id','comments')?></span>
                        </div>
                    </a>
                </div>
                    
            </div>
        </div>
        <!-- start latest users and latest items -->
        <div class="container latest">
            <!-- start latest users  -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-users"></i><?php echo lang("LASTES_USERS")?>
                        </div>
                        <div class="panel-body">
                            <?php
                            $edit=  lang('EDIT');
                            $theLatest =getLatest("*","users",5);
                            foreach($theLatest as $user){
                                echo "<div class='latestUser'>
                                <p>".$user['full_name']."</p>
                                <a href='members.php?do=edit&userID=".$user['user_id']."' ><span class='btn btn-success pull-right latest-user-edit'><i class='fa fa-edit'></i>
                                $edit
                                </span></a>
                                </div>";
                            }
                            ?>
                        </div>
                    </div>
                    <!-- end latest users  -->

                    <!-- start latest items  -->
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tag"></i><?php echo lang("LASTES_ITEMS")?>
                        </div>
                        <div class="panel-body">
                            <?php
                              $edit=  lang('EDIT');
                              $theLatest =getLatest("*","items",5);
                              foreach($theLatest as $item){
                                echo "<div class='latestUser'>
                                <p>".$item['name']."</p>
                                <a href='items.php?do=edit&userID=".$item['item_id']."' ><span class='btn btn-success pull-right latest-user-edit'><i class='fa fa-edit'></i>
                                $edit
                                </span></a>
                                </div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- start latest items  -->
            </div>
        </div>
      <!-- start latest comments and latest --- -->
        <!-- start latest users and latest items -->
        <div class="container latest">
            <!-- start latest comments  -->
            <div class="row">
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-comment"></i><?php echo lang("LASTES_COMMENTS")?>
                        </div>
                        <div class="panel-body">
                               <?php
                                $stmt=$conn->prepare("SELECT comments.*,items.name as item_name ,users.user_name as user_name
                                        FROM comments
                                        INNER join 
                                            items 
                                        ON 
                                            items.item_id=comments.item_id
                                        INNER JOIN
                                            users
                                        ON
                                            users.user_id=comments.user_id
                                            ORDER BY c_id DESC
                                            LIMIT 5;
                                        ");
                                 $stmt->execute();
                                $rows=$stmt->fetchAll();

                                foreach($rows as $row){
                                    echo '<div class="comment-box">';
                                    echo   "<span class='member-u'>".$row['user_name']."</span>";
                                    echo   "<p class='member-c'>".$row['comment']."</p>";
                                    echo"</div>";
                                }
                            ?>
                        </div>
                    </div>
                    <!-- end latest comments  -->

                    <!-- start latest items  -->
                </div>
                <div class="col-sm-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-tag"></i><?php echo lang("LASTES_ITEMS")?>
                        </div>
                        <div class="panel-body">
                            <?php
                              $edit=  lang('EDIT');
                              $theLatest =getLatest("*","items",5);
                              foreach($theLatest as $item){
                                echo "<div class='latestUser'>
                                <p>".$item['name']."</p>
                                <a href='items.php?do=edit&userID=".$item['item_id']."' ><span class='btn btn-success pull-right latest-user-edit'><i class='fa fa-edit'></i>
                                $edit
                                </span></a>
                                </div>";
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <!-- start latest items  -->
            </div>
        </div>
      <!-- start latest comments and latest --- -->
    </div>

    <?php
    // end dashboard page 

    require($tempPath."footer.php");
}else{
    header("location:index.php");
    exit();
}
ob_end_flash()
?>
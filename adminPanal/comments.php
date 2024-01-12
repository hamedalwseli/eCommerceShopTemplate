<?php
/*
=================================================
==manage comments page
==you can ADD | EDIT | DELETE comments form here 
=================================================
*/

session_start();
ob_start();
$title="comments";
if(isset($_SESSION["username"])){
    require('init.php');
    $do=isset($_GET['do']) ? $_GET['do'] : 'manage';

//  start manage page 
if($do=='manage'){

    $stmt=$conn->prepare("SELECT comments.*,items.name as item_name ,users.user_name as user_name
                        FROM comments
                        INNER join 
                            items 
                        ON 
                            items.item_id=comments.item_id
                        INNER JOIN
                            users
                        ON
                            users.user_id=comments.user_id;
                        ");
    $stmt->execute();
    $rows=$stmt->fetchAll();
    ?>
    <!-- //manage page -->
    <div class="manage">
         <h2 class="title"><?php echo lang("MANAGE_COMMENTS")?></h2>
        <div class="container">
            <div class="table-responsive">
                <table class="main-tabel table table-bordered">
                    <tr class="f-ch">
                        <td><?php echo lang("#ID")?></td>
                        <td><?php echo lang("COMMENT")?></td>
                        <td><?php echo lang("ITEM_NAME")?></td>
                        <td><?php echo lang("USER_NAME")?></td>
                        <td><?php echo lang("COMMENT_DATE")?></td>
                        <td><?php echo lang("CONTROL")?></td>
                    </tr>
                      <?php
                      $edit=lang('EDIT');
                      $delete= lang('DELETE');
                      $activate= lang('APPROVE');
                    foreach($rows as $row){
                        echo "<tr>";
                            echo "<td>" . $row["c_id"] .        "</td>";
                            echo "<td style='max-width:200px;max-height:50px'>" . $row["comment"] .     "</td>";
                            echo "<td>" . $row["item_name"] .   "</td>";
                            echo "<td>" . $row["user_name"] .   "</td>";
                            echo "<td>".   $row['comment_date']."</td>";
                            echo "  <td><a href='comments.php?do=edit&comm_id=".$row['c_id']."' class='btn btn-success'><i class='fa-solid fa-pen-to-square'></i> $edit</a> 
                            <a href='comments.php?do=delete&comm_id=".$row['c_id']."' class='btn btn-danger confrim'><i class='fa-solid fa-delete-left'></i> $delete</a>";
                            if ($row['status']==0){
                            echo " <a href='comments.php?do=approve&comm_id=".$row['c_id']."' class='btn btn-success'><i class='fa fa-check'></i> $activate</a>";

                            }
                            echo "</td>";
                            echo "</tr>";
                    }
                    ?>
            
        
                </table>
            </div>
        </div>
        
    </div>
    
    <?php }
    //  start manage page 
    // start add page 
//  end insert code 

    elseif($do=='edit'){ // edit page
         $comm_id=isset($_GET['comm_id']) && is_numeric($_GET['comm_id'])?intval($_GET["comm_id"]):0;
        $stmt=$conn->prepare("SELECT  * FROM comments Where c_id=? LIMIT 1;");
      $stmt->execute(array($comm_id));
      $row=$stmt->fetch();
      $count=$stmt->rowCount();
        if ($count>0){    ?>
   
       <div class="edit-page">
        <div class="container">
            <form action="?do=update"  id="editForm" method="post">
                <h2 class="title"><?php echo lang("EDIT_COMMENT")?></h2>
                <input type="hidden" name="comm_id" value="<?php echo  $comm_id?>">
                <div class="input-box">
                    <label for=""><?php echo lang("ENTER_YOUR_COMMENT")?></label>
                    <textarea name="comment" class="form-control" id="" cols="1" rows="10"></textarea>            
                </div>

                <input type="submit" name="submit" value="save" autocomplate="off">
            </form>
        </div>
       </div>
         
    <?php 
    // else show form  
    }else{
        $errorMsg="there is an error";
          redirectHome($errorMsg,'back');  

    }
}

elseif($do=='update'){
    // start update page 
    ?>
    <div class="update-page">
        <div class="container">
    <?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $comm_id=$_POST['comm_id'];  
        $comment=$_POST['comment'];  

    //    start  validate the form 
        $formError=array();
        
        if(empty($comment))
        {
            $formError[]='the comment  can not be empty';
        }
        foreach($formError as $fr){
            echo'<div class="alert-all alert alert-danger">'.$fr.'</div>';
        }
    //    end  validate the form 

        // update the database with those info 
        if(empty($formError)){

        $stmt=$conn->prepare("UPDATE  comments SET comment=? where c_id=? ");
        $stmt->execute(array($comment,$comm_id));
        // echo success message 
        $errorMsg ="<h2 class='title' style='margin:50px auto;text-align:center; display:block;width:fit-contant;'>".$stmt->rowCount() ." ".lang('RECORD_UPDATED')."</h2>";
         redirectHome($errorMsg,'back');  
    
    }
        echo '</div>';
    }else{
   $errorMsg="<div class='alert alert-danger' style='text-align:center'>sorry you cant browse this page directly</div>";
        redirectHome($errorMsg,'back');  
      }
    echo "</div>";


}
elseif ($do=='delete'){
    // start delete member page 
        $comm_id=isset($_GET['comm_id']) && is_numeric($_GET['comm_id'])?intval($_GET["comm_id"]):0;
        $stmt=$conn->prepare("SELECT  * FROM comments Where c_id=? LIMIT 1;");
      $stmt->execute(array($comm_id));

      $count=$stmt->rowCount();

        if ($count>0){  
            $stmt=$conn->prepare('DELETE FROM comments where c_id=:zcomment');
            $stmt->bindParam(':zcomment',$comm_id);
            $stmt->execute();
        $errorMsg= "<h2 class='title' style='margin:50px auto;text-align:center; display:block;width:fit-contant;'>".$stmt->rowCount() ." ".lang('RECORD_DELETED')."</h2>";
            redirectHome($errorMsg,'back',1);  

         }
         else {
            $errorMsg="this id not exist";
            redirectHome($errorMsg,'back');  

         }
    // end delete member page 
}elseif($do=='approve'){
    // start active member page 
        $comm_id=isset($_GET['comm_id']) && is_numeric($_GET['comm_id'])?intval($_GET["comm_id"]):0;
        $stmt=$conn->prepare("SELECT  * FROM comments Where c_id=? LIMIT 1;");
      $stmt->execute(array($comm_id));
      $count=$stmt->rowCount();
        if ($count>0){  
            $stmt=$conn->prepare('UPDATE comments set status=1 where c_id=?');
            $stmt->execute(array($comm_id));
        $errorMsg= "<h2 class='title' style='margin:50px auto;text-align:center; display:block;width:fit-contant;'>".$stmt->rowCount() ." ".lang('RECORD_APPROVE')."</h2>";
            redirectHome($errorMsg,'back',0.5);  

         }
         else {
            $errorMsg="this id not exist";
            redirectHome($errorMsg,'back');  

         }
    // end active member page 
}
    else{
   $errorMsg="<div class='alert alert-danger' style='text-align:center'>sorry you cant browse this page directly</div>";
        redirectHome($errorMsg,'back');  
      }


}
else{
    header("location:index.php");
    exit();
}

require($tempPath."footer.php");

ob_end_flush();

?>
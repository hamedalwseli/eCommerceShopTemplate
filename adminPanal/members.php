<?php
/*
=================================================
==manage members page
==you can ADD | EDIT | DELETE members form here 
=================================================
*/

session_start();
ob_start();

$title="members";
if(isset($_SESSION["username"])){
    require('init.php');
    $do=isset($_GET['do']) ? $_GET['do'] : 'manage';

//  start manage page 
if($do=='manage'){
    $query='';
    if(isset($_GET['activate']) && $_GET['activate']=='pending'){
        $query='AND reg_status=0';
    }
    $stmt=$conn->prepare("SELECT * FROM users WHERE group_id !=1 $query order by user_id DESC");
    $stmt->execute();
    $rows=$stmt->fetchAll();
    ?>
    <!-- //manage page -->
    <div class="manage">
         <h2 class="title"><?php echo lang("MANAGE_MEMBERS")?></h2>
        <div class="container">
            <div class="table-responsive">
                <table class="main-tabel table table-bordered">
                    <tr class="f-ch">
                        <td><?php echo lang("#ID")?></td>
                        <td><?php echo lang("AVATAR")?></td>
                        <td><?php echo lang("USER_NAME")?></td>
                        <td><?php echo lang("EMAIL")?></td>
                        <td><?php echo lang("FULL_NAME")?></td>
                        <td><?php echo lang("REGISTER_DATE")?></td>
                        <td><?php echo lang("CONTROL")?></td>
                    </tr>
                      <?php
                      $edit=lang('EDIT');
                      $delete= lang('DELETE');
                      $activate= lang('ACTIVATE');
                    foreach($rows as $row){
                        echo "<tr>";
                            echo "<td>" . $row["user_id"] .    "</td>";
                            echo "<td>";
                            if(empty($row['avatar'])){
                                echo '<i class="fa-solid fa-user" style="font-size:50px;color:var(--main-color);"></i>';
                            }
                           else{ echo "<img src='uploads/avatar/".$row['avatar']."' class='avatar-img' alt>";}
                            echo "</td>";
                            echo "<td>" . $row["user_name"] .  "</td>";
                            echo "<td>" . $row["email"] .      "</td>";
                            echo "<td>" . $row["full_name"] .  "</td>";
                            echo "<td>".   $row['date']     .  "</td>";
                            echo "  <td><a href='members.php?do=edit&userID=".$row['user_id']."' class='btn btn-success'><i class='fa-solid fa-pen-to-square'></i> $edit</a> 
                            <a href='members.php?do=delete&userID=".$row['user_id']."' class='btn btn-danger confrim'><i class='fa-solid fa-delete-left'></i> $delete</a>";
                            if ($row['reg_status']==0){
                            echo " <a href='members.php?do=activate&userID=".$row['user_id']."' class='btn btn-success'><i class='fa fa-check'></i> $activate</a>";

                            }
                            echo "</td>";
                            echo "</tr>";
                    }
                    ?>
            
        
                </table>
            </div>
    <a href='members.php?do=add' class=" add-btn-s"> <i class="fa fa-plus"></i> <?php echo lang("ADD_MEMBER")?></a>
        </div>
        
    </div>
    
    <?php }
    //  start manage page 
    // start add page 
    elseif($do=='add'){?>
   <div class="edit-page">
       <div class="container">
           <form action="?do=insert"  id="addForm" method="post" enctype="multipart/form-data">
               <h2 class="title"><?php echo lang("ADD_MEMBER")?></h2>
               <div class="input-box">
                   <input type="text" name="username" id="addUserName"  autocomplate="off" >
                   <label for=""><?php echo lang("MEMBER_USER_NAME")?></label>
                   <span class="massage"><?php echo lang("USERNAME_EMPTY")?></span>
                </div>
                <div class="input-box">
                    <input type="password" name="newpassword" id="addNewPassword" autocomplate="new-passowrd" required>
                    <label for="" class=""> <?php echo lang("MEMBER_ADD_PASS")?></label>
                    <span class="massage" ><?php echo lang("NOT_MATCH_PASS")?></span>
                    
                </div>
                <div class="input-box">
                    <input type="password" name="confirmpassword" id="addConfirmPassword" autocomplate="new-passowrd" required>
                    <label for="" class=""> <?php echo lang("ADD_MEMBER_confirm_PASS")?></label>
                    <span class="massage" ><?php echo lang("NOT_MATCH_PASS")?></span>
                </div>
                <div class="input-box">
                    <input type="email" name="email" id="addEmail" autocomplate="off" >
                    <label for=""><?php echo lang("EMAIL_MEMBER")?></label>
                    <span class="massage" ><?php echo lang("EMAIL_EMPTY")?></span>
                    
                </div>
                <div class="input-box">
                    <input type="text" name="fullname" id="addfullName" autocomplate="off" >
                    <label for=""><?php echo lang("MEMBER_FILL_NAME")?></label>
                    <span class="massage" ><?php echo lang("FULLNAME_EMPTY")?></span>
                </div>
                <div class="input-box">
                    <input type="file" name="avatar" id="addfullName" autocomplate="off" >
                    <label for=""></label>             
                </div>
                <input type="submit" name="submit" value="save" autocomplate="off">
            </form>
        </div>
    </div>
    <?php }
    // end add page 

    //  start insert code 
    elseif($do=="insert"){
        
    if($_SERVER['REQUEST_METHOD']=='POST'){
        // start avatar 
        $avatar_name=$_FILES['avatar']['name'];
        $avatar_size=$_FILES['avatar']['size'];
        $avatar_temp=$_FILES['avatar']['tmp_name'];
        $avatar_type=$_FILES['avatar']['type'];
        
        // start list of allowed file type to uploade
        $avatarAllowedExtensions=array('png','jpeg','jpg','gif');
        //  end list of allowed file type to uploade

        $avatar_nameExetension=strtolower(end(explode('.',$avatar_name)));

        // end avatar 
         echo   '<div class="update-page">';
       echo '<div class="container">';
        $user_name=$_POST['username'];
        $email=$_POST['email'];
        $fullname=$_POST['fullname'];
        $Password=$_POST["newpassword"];
        $hashPassword=sha1($_POST['newpassword']);
    
    //    start  validate the form 
        $formError=array();
        if (!preg_match($alphabtNumRugEx,$user_name)){
            $formError[]='you can\'t use symbols like$#%!% in user name';
        }
        if (strlen($user_name)<3){
            $formError[]='you can\'t be less than three characters ';
        }
        
        if(empty($user_name))
        {
            $formError[]='user name can not be empty';
        }
        if(empty($Password))
        {
            $formError[]='user password can not be empty';
        }
        if(empty($email)){
        $formError[]='email can not be empty';
        }
        if(empty($fullname)){
        $formError[]='name can not be empty';
        } 

        if(empty($avatar_name)){
            $formError[]='image can not be empty';
        }
        if($avatar_size>1024*4*1024){
            $formError[]='image is bigger than 4MB';
        }
        if(!empty($avatar_name) && !in_array($avatar_nameExetension,$avatarAllowedExtensions)){
            $formError[]="image extension is not allowed";
        }
        foreach($formError as $fr){
            echo'<div class="alert-all alert alert-danger">'.$fr.'</div>';
        }

     
    //    end  validate the form 

        // update the database with those info 
        if(empty($formError)){

            $avatar=rand(0,1000000000000).'_'.$avatar_name;

            move_uploaded_file($avatar_temp,"uploads\avatar\\" .$avatar);
            //check statment
            $check=checkItems('user_name','users',$user_name);
            if($check==1){
                $errorMsg="<div class='alert alert-danger' style='text-align:center'>".lang('USER_EXSIST')."</div>";
             redirectHome($errorMsg,'back',5);  

            }else{
                    //  start insert query 
                            $stmt=$conn->prepare("INSERT INTO 
                                `users` (`user_name`, `password`, `email`, `full_name`,reg_status,`date`,`avatar`) 
                                VALUES ( :user_name,:password , :email, :full_name,1,now(),:avatar);");
                            $stmt->execute(array(
                                'user_name'=>$user_name,
                                'password' =>$hashPassword,
                                'email'    =>$email,
                                'full_name'=>$fullname,
                                'avatar'   =>$avatar
                              ));

                    // echo success message 
                    $errorMsg= "<h2 class='title' style='margin:50px auto;text-align:center; display:block;width:fit-contant;'>1 ".lang('RECORD_ADDED')."</h2>";
                    
                    redirectHome($errorMsg,'back');  

                    // end  insert query 
                }
        }
        echo '</div>';
    }else{
        $errorMsg="<div class='alert alert-danger' style='text-align:center'>sorry you cant browse this page directly</div>";
        redirectHome($errorMsg,'?do=add',10);
    
    echo "<div></div>";
}
    }
    //  end insert code 
    elseif($do=='edit'){ // edit page
         $userid=isset($_GET['userID']) && is_numeric($_GET['userID'])?intval($_GET["userID"]):0;
        $stmt=$conn->prepare("SELECT  * FROM users Where user_id=? LIMIT 1;");
      $stmt->execute(array($userid));
      $row=$stmt->fetch();
      $count=$stmt->rowCount();

        if ($count>0){    ?>
   
       <div class="edit-page">
        <div class="container">
            <form action="?do=update"  id="editForm" method="post">
                <h2 class="title"><?php echo lang("EDIT_MEMBER")?></h2>
                <input type="hidden" name="user_id" value="<?php echo  $userid?>">
                <div class="input-box">
                    <input type="text" id="editUserName" name="username"   autocomplate="off" value="<?php echo $row['user_name']?>">
                    <label for=""><?php echo lang("MEMBER_USER_NAME")?></label>
                     <span class="massage" ><?php echo lang("USERNAME_EMPTY")?></span>

                </div>
                <div class="input-box">
                    <input type="hidden" name="oldpassword" autocomplate="new-passowrd" value="<?php echo $row['password']?>">
                    <input type="password" name="newpassword" id="editNewPassword" autocomplate="new-passowrd" >
                    <label for="" class=""> <?php echo lang("MEMBER_PASS")?></label>
                     <span class="massage" ><?php echo lang("NOT_MATCH_PASS")?></span>

                </div>
                <div class="input-box">
                    <input type="password" name="confirmpassword" id="editConfirmPassword" autocomplate="new-passowrd" class="">
                    <label for="" class=""> <?php echo lang("MEMBER_confirm_PASS")?></label>
                    <span class="massage" ><?php echo lang("NOT_MATCH_PASS")?></span>
                </div>
                <div class="input-box">
                    <input type="email" name="email" id="editEmail" autocomplate="off"value="<?php echo $row['email']?>">
                    <label for=""><?php echo lang("EMAIL_MEMBER")?></label>
                    <span class="massage" ><?php echo lang("EMAIL_EMPTY")?></span>

                </div>
                <div class="input-box">
                    <input type="text" name="fullname" id="editFullName" autocomplate="off"  value="<?php echo $row['full_name']?>">
                    <label for=""><?php echo lang("MEMBER_FILL_NAME")?></label>
                    <span class="massage" ><?php echo lang("FULLNAME_EMPTY")?></span>

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
        $user_id=$_POST['user_id'];
        $user_name=$_POST['username'];
        $email=$_POST['email'];
        $fullname=$_POST['fullname'];
        $newPassword=$_POST["newpassword"];
        $oldPassword=$_POST["oldpassword"];
        $pass='';
        if(empty($newPassword)){
            $pass=$oldPassword;
        }else{
            $pass=sha1($newPassword);
        }


    //    start  validate the form 
        $formError=array();
        if (!preg_match($alphabtNumRugEx,$user_name)){
            $formError[]='you can\'t use symbols like$#%!% in user name';
        }
        if (strlen($user_name)<3){
            $formError[]='you can\'t be less than three characters ';
        }

        if(empty($user_name))
        {
            $formError[]='user name can not be empty';
        }
        if(empty($email)){
        $formError[]='email can not be empty';
        }
        if(empty($fullname)){
        $formError[]='name can not be empty';
        }
        foreach($formError as $fr){
            echo'<div class="alert-all alert alert-danger">'.$fr.'</div>';
        }
    //    end  validate the form 

        // update the database with those info 
        if(empty($formError)){

        $stmt=$conn->prepare("UPDATE  users SET user_name=? , email=? ,password=?,full_name=? where user_id=? ");
        $stmt->execute(array($user_name,$email,$pass,$fullname,$user_id));
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
        $userid=isset($_GET['userID']) && is_numeric($_GET['userID'])?intval($_GET["userID"]):0;
        $stmt=$conn->prepare("SELECT  * FROM users Where user_id=? LIMIT 1;");
      $stmt->execute(array($userid));

      $count=$stmt->rowCount();

        if ($count>0){  
            $stmt=$conn->prepare('DELETE FROM users where user_id=:zuser');
            $stmt->bindParam(':zuser',$userid);
            $stmt->execute();
        $errorMsg= "<h2 class='title' style='margin:50px auto;text-align:center; display:block;width:fit-contant;'>".$stmt->rowCount() ." ".lang('RECORD_DELETED')."</h2>";
            redirectHome($errorMsg,'back',100);  

         }
         else {
            $errorMsg="this id not exist";
            redirectHome($errorMsg,'back');  

         }
    // end delete member page 
}elseif($do=='activate'){
    // start active member page 
        $userid=isset($_GET['userID']) && is_numeric($_GET['userID'])?intval($_GET["userID"]):0;
        $stmt=$conn->prepare("SELECT  * FROM users Where user_id=? LIMIT 1;");
      $stmt->execute(array($userid));

      $count=$stmt->rowCount();

        if ($count>0){  
            $stmt=$conn->prepare('UPDATE users set reg_status=1 where user_id=?');
            $stmt->execute(array($userid));
        $errorMsg= "<h2 class='title' style='margin:50px auto;text-align:center; display:block;width:fit-contant;'>".$stmt->rowCount() ." ".lang('RECORD_ACTIVATED')."</h2>";
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

require_once($tempPath."footer.php");
ob_end_flush();

?>
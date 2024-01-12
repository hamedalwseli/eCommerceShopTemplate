
<?php
ob_start();
session_start();
$title='items';

if(isset($_SESSION['username'])){
    require_once('init.php');

    $do=isset($_GET['do'])?$_GET['do']:'manage';

    if($do=='manage'){  
    $stmt=$conn->prepare("SELECT 
                        items.*,categories.name as cat_name ,users.user_name as user_name
                         from
                         items 
                        INNER JOIN categories on categories.id=items.cat_id 
                        INNER JOIN users on users.user_id=items.user_id;
                        ");
    $stmt->execute();
    $items=$stmt->fetchAll();
    ?>
    <!-- //manage page -->
    <div class="manage">
         <h2 class="title"><?php echo lang("MANAGE_ITEMS")?></h2>
        <div class="container">
            <div class="table-responsive">
                <table class="main-tabel table table-bordered">
                    <tr class="f-ch">
                        <td style="font-size: 11px"><?php echo lang("#ID")?></td>
                        <td style="font-size: 11px"><?php echo lang("AVATAR")?></td>
                        <td style="font-size: 11px"><?php echo lang("NAME")?></td>
                        <td style="font-size: 11px"><?php echo lang("DESCRIPTION")?></td>
                        <td style="font-size: 11px"><?php echo lang("PRICE")?></td>
                        <td style="font-size: 11px"><?php echo lang("ADDING_DATE")?></td>
                        <td style="font-size: 11px"><?php echo lang("COUNTRY_MADE")?></td>
                        <td style="font-size: 11px"><?php echo lang("STATUS")?></td>
                        <td style="font-size: 11px"><?php echo lang("CATEGORY_NAME")?></td>
                        <td style="font-size: 11px"><?php echo lang("USER_NAME")?></td>
                        <td style="font-size: 11px"><?php echo lang("CONTROL")?></td>
                    </tr>
                      <?php
                      $edit=lang('EDIT');
                      $delete= lang('DELETE');
                      $activate= lang('ACTIVATE');
                      $approve =lang('APPROVE');
                      $show_com =lang('SHOW_COMMENTS');
                    foreach($items as $item){
                        echo "<tr>";
                            echo "<td>".$item["item_id"] .     "</td>";
                            echo "<td>";
                            if(empty($item['avatar'])){
                                echo '<i class="fa-solid fa-user" style="font-size:50px;color:var(--main-color);"></i>';
                            }
                           else{ echo "<img src='uploads/products/".$item['avatar']."' class='avatar-img' alt>";}
                            echo "</td>";
                            echo "<td>".$item["name"] .        "</td>";
                            echo "<td style='width: 20%'>".$item["description"].  "</td>";
                            echo "<td>".$item["price"].        "</td>";
                            echo "<td>".$item['add_date'].     "</td>";
                            echo "<td>".$item['country_made']. "</td>";
                            echo "<td>".$item['status'].       "</td>";
                            echo "<td>".$item['cat_name'].     "</td>";
                            echo "<td>".$item['user_name'].    "</td>";
                            echo "<td class='control-btns'><a href='items.php?do=edit&itemID=".$item['item_id']."' class='btn btn-success'><i class='fa-solid fa-pen-to-square'></i> $edit</a> 
                            <a href='items.php?do=delete&itemID=".$item['item_id']."' class='btn btn-danger confrim'><i class='fa-solid fa-delete-left'></i> $delete </a> ";
                            echo "<a href='items.php?do=show_commnets&itemID=".$item['item_id']."' class='btn btn-success' > <i class='fa-solid fa-comment'></i></i> $show_com </a>";
                                  if ($item['approve']==0){
                            echo " <a href='items.php?do=approve&itemID=".$item['item_id']."' class='btn btn-success'><i class='fa fa-check'></i> $approve</a>";

                            }
                            echo "</td>";
                            echo "</tr>";
                    }
                    ?>
            
        
                </table>
            </div>
    <a href='items.php?do=add' class=" add-btn-s"> <i class="fa fa-plus"></i> <?php echo lang("ADD_ITEM")?></a>
        </div>
        
    </div>
    
    <?php 



    }elseif($do=='add'){
?>
<div class="edit-page">
       <div class="container">
           <form action="?do=insert"   method="post"  enctype="multipart/form-data">
               <h2 class="title"><?php echo lang("ADD_NEW_ITEM")?></h2>
               <div class="input-box">
                   <input type="text" name="name"   autocomplate="off" required >
                   <label for="" class='active-label'><?php echo lang("ITEM_NAME")?></label>
                </div>
               <div class="input-box">
                   <input type="text" name="description"   autocomplate="off"  >
                   <label for="" class='active-label'><?php echo lang("DESCRIPTION")?></label>
                </div>
               <div class="input-box">
                   <input type="text" name="price"   autocomplate="off"  required>
                   <label for="" class='active-label'><?php echo lang("PRICE")?> </label>
                </div>
               <div class="input-box">
                   <input type="text" name="country"   autocomplate="off"  required>
                   <label for="" class='active-label'><?php echo lang("COUNTRY_OF_MADE")?> </label>
                </div>
                <div class="input-box">
                    <input type="file" name="avatar"  autocomplate="off" >
                    <label for=""></label>             
                </div>
               <div class="input-box select-box">
                <label for="select-stutes"><?php echo lang("STATUES_OF_ITEM")?></label>
                    <select class='list' name="stutes" class='form-conrtol' id='select-stutes' >
                        <option value="0"><?php echo lang("...")?></option>
                        <option value="1"><?php echo lang("NEW")?></option>
                        <option value="2"><?php echo lang("LIKE_NEW")?></option>
                        <option value="3"><?php echo lang("USED")?></option>
                        <option value="4"><?php echo lang("OLD")?></option>
                    </select>
                </div>
               <div class="input-box select-box">
                <label for="select-stutes"><?php echo lang("MEMBER_WHO_ADD_THE_ITEM")?></label>
                    <select class='list' name="member" class='form-conrtol' id='select-stutes' >
                        <option value="0"><?php echo lang("...")?></option>
                        <?php
                        $stmt=$conn->prepare('SELECT * FROM users');
                        $stmt->execute();
                        $users=$stmt->fetchAll();
                        foreach($users as $user){
                            echo "<option value='".$user['user_id']."'>".$user['user_name']."</option>";
                        }
                        ?>
                    </select>
                </div>
               <div class="input-box select-box">
                <label for="select-stutes"><?php echo lang("CATEGORY_NAME")?></label>
                    <select class='list' name="categories" class='form-conrtol' id='select-stutes' >
                        <option value="0"><?php echo lang("...")?></option>
                        <?php
                        $stmt1=$conn->prepare('SELECT * FROM categories');
                        $stmt1->execute();
                        $cats=$stmt1->fetchAll();
                        foreach($cats as $cat){
                            echo "<option value='".$cat['id']."'>".$cat['name']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <input type="submit" name="submit" value="save" autocomplate="off">
            </form>
            
        </div>
    </div>
hell
<?php
    }
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
        $name=$_POST['name'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $country=$_POST["country"];
        $stutes=$_POST['stutes'];
        $member=$_POST['member'];
        $cat=$_POST['categories'];

    //    start  validate the form 
        $formError=array();
       
        if (strlen($name)<2){
            $formError[]='you can\'t be less than three characters ';
        }
        
        if(empty($name))
        {
            $formError[]='u name can not be empty';
        }
        if(empty($price))
        {
            $formError[]=' price can not be empty';
        }
        if(empty($description)){
        $formError[]='description can not be empty';
        }
        if($stutes==0){
        $formError[]='you must choose the status of the item';
        }
        if($member==0){
        $formError[]='you must choose the member who insert the item';
        }
        if($cat==0){
        $formError[]='you must choose the categories of the item';
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

            move_uploaded_file($avatar_temp,"uploads\products\\" .$avatar);
            //check statment
                    //  start insert query 
                            $stmt=$conn->prepare("INSERT INTO 
                                `items` (`name`, `description`, `price`, `country_made`,`status`,`add_date`,`cat_id`,`user_id`,`avatar`) 
                                VALUES ( :name,:description,:price, :country_made,:status,now(),:cat,:user,:avatar);");
                            $stmt->execute(array(
                                'name'        =>$name,
                                'description' =>$description,
                                'price'       =>$price,
                                'country_made'=>$country,
                                'status'      =>$stutes,
                                'cat'         =>$cat,
                                'user'        =>$member,
                                'avatar'      =>$avatar
                              ));
                    // echo success message 
                    $errorMsg= "<h2 class='title' style='margin:50px auto;text-align:center; display:block;width:fit-contant;'>1 ".lang('RECORD_ADDED')."</h2>";
                    
                    redirectHome($errorMsg,'back',1);  
                    // end  insert query 
        }else{
                    $errorMsg="<div class='alert alert-danger' style='text-align:center'> ".lang('THERE_IS_AN_ERROR')."</div>";
                     redirectHome($errorMsg,'?do=add',5);
        }
        echo '</div>';
    }else{
        $errorMsg="<div class='alert alert-danger' style='text-align:center'>".lang('SORRY_YOU_CANT_BROWSE_THIS_PAGE_DIERECTLY')."</div>";
        redirectHome($errorMsg,'?do=add',5);
    
    echo "<div></div>";
}
 } elseif($do=='edit'){ // edit page
         $itemid=isset($_GET['itemID']) && is_numeric($_GET['itemID'])?intval($_GET["itemID"]):0;
        $stmt=$conn->prepare("SELECT  * FROM items Where item_id=? LIMIT 1;");
      $stmt->execute(array($itemid));
      $row=$stmt->fetch();
      $count=$stmt->rowCount();

        if ($count>0){    ?>
   <div class="edit-page">
       <div class="container">
           <form action="?do=update"   method="post">
               <h2 class="title"><?php echo lang("ADD_NEW_ITEM")?></h2>
              <input type="hidden" name="item_id" value="<?php echo  $itemid?>">

               <div class="input-box">
                   <input type="text" name="name"   autocomplate="off"  value='<?php echo $row['name'];?>' required >
                   <label for="" class='active-label'><?php echo lang("ITEM_NAME")?></label>
                </div>
               <div class="input-box">
                   <input type="text" name="description"   autocomplate="off" value='<?php echo $row['description'];?>' >
                   <label for="" class='active-label'><?php echo lang("DESCRIPTION")?></label>
                </div>
               <div class="input-box">
                   <input type="text" name="price"   autocomplate="off"  required value='<?php echo $row['price'];?>'>
                   <label for="" class='active-label'><?php echo lang("PRICE")?> </label>
                </div>
               <div class="input-box">
                   <input type="text" name="country"   autocomplate="off"  required value='<?php echo $row['country_made'];?>'>
                   <label for="" class='active-label'><?php echo lang("COUNTRY_OF_MADE")?> </label>
                </div>
               <div class="input-box select-box">
                <label for="select-stutes"><?php echo lang("STATUES_OF_ITEM")?></label>
                    <select class='list' name="stutes" class='form-conrtol' id='select-stutes' >
                        <option value="0"><?php echo lang("...")?></option>
                        <option value="1"><?php echo lang("NEW")?></option>
                        <option value="2"><?php echo lang("LIKE_NEW")?></option>
                        <option value="3"><?php echo lang("USED")?></option>
                        <option value="4"><?php echo lang("OLD")?></option>
                    </select>
                </div>
               <div class="input-box select-box">
                <label for="select-stutes"><?php echo lang("MEMBER_WHO_ADD_THE_ITEM")?></label>
                    <select class='list' name="member" class='form-conrtol' id='select-stutes' >
                        <option value="0"><?php echo lang("...")?></option>
                        <?php
                        $stmt=$conn->prepare('SELECT * FROM users');
                        $stmt->execute();
                        $users=$stmt->fetchAll();
                        foreach($users as $user){
                            echo "<option value='".$user['user_id']."'>".$user['user_name']."</option>";
                        }
                        ?>
                    </select>
                </div>
               <div class="input-box select-box">
                <label for="select-stutes"><?php echo lang("CATEGORY_NAME")?></label>
                    <select class='list' name="categories" class='form-conrtol' id='select-stutes' >
                        <option value="0"><?php echo lang("...")?></option>
                        <?php
                        $stmt1=$conn->prepare('SELECT * FROM categories');
                        $stmt1->execute();
                        $cats=$stmt1->fetchAll();
                        foreach($cats as $cat){
                            echo "<option value='".$cat['id']."'>".$cat['name']."</option>";
                        }
                        ?>
                    </select>
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
  
}elseif($do=='update'){
    // start update page 
    ?>
    <div class="update-page">
        <div class="container">
    <?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $item_id=$_POST['item_id'];
        $name=$_POST['name'];
        $description=$_POST['description'];
        $price=$_POST['price'];
        $country=$_POST["country"];
        $stutes=$_POST['stutes'];
        $member=$_POST['member'];
        $cat=$_POST['categories'];

    //    start  validate the form 
        $formError=array();
        if (!preg_match($alphabtNumRugEx,$name)){
            $formError[]='you can\'t use symbols like$#%!% in user name';
        }
        if (strlen($name)<2){
            $formError[]='you can\'t be less than three characters ';
        }

        if(empty($name))
        {
            $formError[]='user name can not be empty';
        }
        foreach($formError as $fr){
            echo'<div class="alert-all alert alert-danger">'.$fr.'</div>';
        }
    //    end  validate the form 

        // update the database with those info 
        if(empty($formError)){

        $stmt=$conn->prepare("UPDATE 
                                items SET 
                                name=? , 
                                description=? ,
                                price=?,
                                country_made=?,
                                status=?,
                                cat_id=?,
                                user_id=?
                                where 
                                item_id=?
                                ");
        $stmt->execute(array($name,$description,$price,$country,$stutes,$cat,$member,$item_id));
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


}elseif($do=='delete'){
        
    // start delete member page 
        $item_id=isset($_GET['itemID']) && is_numeric($_GET['itemID'])?intval($_GET["itemID"]):0;
        $stmt=$conn->prepare("SELECT  * FROM items Where item_id=? LIMIT 1;");
      $stmt->execute(array($item_id));

      $count=$stmt->rowCount();

        if ($count>0){  
            $stmt=$conn->prepare('DELETE FROM items where item_id=:zitem');
            $stmt->bindParam(':zitem',$item_id);
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
        $itemid=isset($_GET['itemID']) && is_numeric($_GET['itemID'])?intval($_GET["itemID"]):0;
        $stmt=$conn->prepare("SELECT  * FROM items Where item_id=? LIMIT 1;");
      $stmt->execute(array($itemid));
      $count=$stmt->rowCount();
        if ($count>0){  
            $stmt=$conn->prepare('UPDATE items set approve=1 where item_id=?');
            $stmt->execute(array($itemid));
        $errorMsg= "<h2 class='title' style='margin:50px auto;text-align:center; display:block;width:fit-contant;'>".$stmt->rowCount() ." ".lang('RECORD_APPROVE')."</h2>";
            redirectHome($errorMsg,'back',0.5);  

         }
         else {
            $errorMsg="this id not exist";
            redirectHome($errorMsg,'back');  

         }
    // end active member page 
}
elseif($do=="show_commnets"){
    $itemid=isset($_GET['itemID']) && is_numeric($_GET['itemID'])?intval($_GET["itemID"]):0;
    $stmt0=$conn->prepare("select name from items where item_id=$itemid");
    $stmt0->execute();
    $item_name=$stmt0->fetch();
 $stmt=$conn->prepare("SELECT comments.*,items.name as item_name,users.user_name as user_name
                        FROM comments
                        INNER join 
                            items 
                        ON 
                            items.item_id=comments.item_id
                        INNER JOIN
                            users
                        ON
                            users.user_id=comments.user_id
                        HAVING item_id=$itemid;
                        ");
    $stmt->execute();
    $rows=$stmt->fetchAll();
    if(!empty($rows)){
    ?>
    <!-- //manage page -->
    <div class="manage">
         <h2 class="title"><?php echo $item_name[0]." " ;echo lang("MANAGE_COMMENTS") ?></h2>
        <div class="container">
            <div class="table-responsive">
                <table class="main-tabel table table-bordered">
                    <tr class="f-ch">
                        <td><?php echo lang("COMMENT")?></td>
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
                            echo "<td>" . $row["comment"] .     "</td>";
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
    
    <?php
    }
    else{
        $mas=lang('THERE_IS_NO_COMMENTS');
        echo "<h2 class='title'>$mas</h2>";  }
     }
        require_once($tempPath.'footer.php');

}else{
    header('location:index.php');
    exit();
}

ob_end_flush();

?>

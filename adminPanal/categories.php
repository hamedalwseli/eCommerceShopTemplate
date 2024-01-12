<?php
ob_start();
session_start();
$title='categorise';

if(isset($_SESSION['username'])){
    require_once('init.php');

    $do=isset($_GET['do'])?$_GET['do']:'manage';

    if($do=='manage'){
        $sort='ASC';
        $sort_array=array('ASC','DESC');
        if(isset($_GET['sort'])&&in_array($_GET['sort'],$sort_array)){
            $sort=$_GET['sort'];
        }
        $stmt=$conn->prepare("SELECT * FROM `categories` where parent=0 ORDER BY `ordering` $sort");
        $stmt->execute();
        $cats=$stmt->fetchAll();
        ?>
            <div class="categories">
                <h1 class="title"> <?php echo lang("MANAGE_CATEGORIES")?></h1>
                <div class="container">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <p> <?php echo lang("MANAGE_CATEGORIES")?></p> 
                            <div class="options">
                                <div class="box">
                                    <span><i class="fa fa-sort"></i>  <?php echo lang("ORDERING:")?></span>
                                    <a href="categories.php?lang=<?php echo $lang?>&sort=ASC" class='<?php if($_GET['sort']=='ASC'){echo "active"; } ?>'> <?php echo lang("ASC")?></a>
                                    <span class='or'> <?php echo lang("OR")?></span>
                                    <a href="categories.php?lang=<?php echo $lang?>&sort=DESC" class='<?php if($_GET['sort']=='DESC'){echo "active"; } ?>'> <?php echo lang("DESC")?></a>
                                </div>
                                <div class="box">
                                    <p><i class="fa fa-eye"></i> <?php echo lang("VIEW:")?></p>
                                    <span class='ch' data-view='classic'> <?php echo lang("CLASSIC")?></span>
                                    <span class='or'> <?php echo lang("OR")?></span>
                                    <span class='ch active' data-view='full'> <?php echo lang("FULL")?></span>
                                </div>
                        </div></div>
                       
                        <div class="ordering"></div>
                        <div class="panel-body">
                            <?php
                               $edit=lang('EDIT');
                             $delete= lang('DELETE');
                             $hidden= lang('HIDDDEN');
                             $desription= lang('DESCRIPTION');
                             $comment_disable= lang('COMMENT_DISABLE');
                             $disable_ads= lang('ADS_DISABLE');
                            foreach($cats as $cat){
                                echo '<div class="box-cat-dispaly">';
                                echo"<div class='cat-box'>";
                                echo "<div class='hidden-btns'>";
                                echo "<a href='categories.php?do=edit&catid=".$cat['id']."' class='btn  btn-success edit-btn'>$edit<a>";
                                echo "<a href='categories.php?do=delete&catid=".$cat['id']."' class='btn confrim btn-danger delet-btn'>$delete<a>";
                                echo "</div>";
                                echo "<div class='cat '><h4>".$cat['name']."</h4></div>";
                                echo "<div class='info full-view'>";
                                if(!empty($cat['decription'])){echo "<p class='desc'><span>$desription:</span>".$cat['decription']."</p>";};
                                if($cat['visibility']==1){echo "<span class='visible'><i class='fa fa-eye'></i> $hidden</span>";};
                                if($cat['allow_comments']==1) {echo "<span class='commenting'><i class='fa fa-close'></i> $comment_disable</span>";};
                                if($cat['allow_ads']==1){echo "<span class='ads'><i class='fa fa-close'></i> $disable_ads</span>";};
                                echo "</div>"; 
                                echo "</div>";
                                $getAll=$conn->prepare("SELECT * from categories where parent=".$cat['id']." ");
                                $getAll->execute();
                                $all =$getAll->fetchAll();
                                if(!empty($all)){
                                echo '<div class="child-box box">';
                                echo "<h5 class='child-categiry'> child categories:</h5>";
                                foreach($all as $cat){
                                echo ' <div class="sub-cat" style="display:flex;align-items: center;justify-content: space-between;">';
                                echo '<p class="child-name">  '.$cat["name"].'</p>';
                                echo "<div class='hidden-btns'>";
                                echo "<a href='categories.php?do=edit&catid=".$cat['id']."' class='btn  btn-success edit-btn'>$edit<a>";
                                echo "<a href='categories.php?do=delete&catid=".$cat['id']."' class='btn confrim btn-danger delet-btn'>$delete<a>";
                                echo "</div>";
                                echo "</div>";
                                }
                                echo "</div>";
                                 }
                                echo '</div>';
                    
                            }
                            ?>
                        </div>
                    </div>
                    <a href="categories.php?do=add" class='add-btn-s'><i class="fa fa-plus"></i> <?php echo lang("ADD_NEW_CATEGORIES")?></a>
                </div>
            </div>
        <?php
    }
    elseif($do=='add'){
?>
<div class="edit-page">
       <div class="container">
           <form action="?do=insert"   method="post"  enctype="multipart/form-data">
               <h2 class="title"><?php echo lang("ADD_NEW_CATEGORY")?></h2>
               <div class="input-box">
                   <input type="text" name="name"   autocomplate="off" >
                   <label for=""><?php echo lang("CATEGORY_NAME")?></label>
                </div>
                <div class="input-box">
                    <input type="text" name="description" autocomplate="new-passowrd" >
                    <label for="" class=""> <?php echo lang("DESC_OF_CATEGORY")?> </label>                    
                </div>
                <div class="input-box">
                    <input type="text" name="ordering"  autocomplate="off" >
                    <label for=""><?php echo lang("ORDER")?></label>                    
                </div>
                <!-- start category type  -->
                <div class="input-box">
                    <label for="">type of category</label>      
                    <select name="parent" id="">
                        <option value="0">baisc</option>
                        <?php
                        // $allCats=getAllFrom('*','categories','where parent=0','','id','');
                        $getAll=$conn->prepare("SELECT * from categories  where parent=0  ORDER BY id ASC");
                        $getAll->execute();
                        $all =$getAll->fetchAll();
                        foreach($all as $cat){
                            echo "<option value='".$cat['id']."'>".$cat['name']."</option>";
                        }
                        ?>
                    </select>              
                </div>
                <!-- end category type  -->
                <div class="radio-box">
                    <h2><?php echo lang("VISIBLILITY")?></h2>
                    <div class="visible">
                        <input type="radio" name='visibility' id='vis-yes' value='0' checked>
                        <label for="vis-yes"><?php echo lang("YES")?></label>
                    </div>                    
                    <div class="visible">
                        <input type="radio" name='visibility' id='vis-no' value='1' >
                        <span></span>
                        <label for="vis-no"><?php echo lang("NO")?></label>
                    </div>                    
                </div>
                <div class="radio-box">
                    <h2><?php echo lang("ALLOW_COMMENTING")?></h2>
                    <div class="visible">
                        <input type="radio" name='commenting' id='comm-yes' value='0' checked>
                        <label for="comm-yes"><?php echo lang("YES")?></label>
                    </div>                    
                    <div class="visible">
                        <input type="radio" name='commenting' id='comm-no' value='1' >
                        <span></span>
                        <label for="comm-no"><?php echo lang("NO")?></label>
                    </div>                    
                </div>
                <div class="radio-box">
                    <h2><?php echo lang("ALLOW_ADS")?></h2>
                    <div class="visible">
                        <input type="radio" name='ads' id='ads-yes' value='0' checked>
                        <label for="ads-yes"><?php echo lang("YES")?></label>
                    </div>                    
                    <div class="visible">
                        <input type="radio" name='ads' id='ads-no' value='1'  >
                        <span></span>
                        <label for="ads-no"><?php echo lang("NO")?></label>
                    </div>                    
                </div>
                <input type="submit" name="submit" value="save" autocomplate="off">
            </form>
        </div>
    </div>


<?php
    }
    elseif($do=='insert'){
        
        
    if($_SERVER['REQUEST_METHOD']=='POST'){
         echo   '<div class="update-page">';
       echo '<div class="container">';
        $name=$_POST['name'];
        $decription=$_POST['description'];
        $parent=$_POST['parent'];
        $ordering=$_POST["ordering"];
        $visibility=$_POST['visibility'];
        $commenting=$_POST['commenting'];
        $ads=$_POST['ads'];
    //    start  validate the form 
        $formError=array();
        if (!preg_match($alphabtNumRugEx,$name)){
            $formError[]='you can\'t use symbols like$#%!% in user name';
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
            //check statment
            $check=checkItems('name','categories',$name);
            if($check==1){
                $errorMsg="<div class='alert alert-danger' style='text-align:center'>".lang('USER_EXSIST')."</div>";
                 redirectHome($errorMsg,'back',5);  

            }else{
                    //  start insert query 

                            $stmt=$conn->prepare("INSERT INTO 
                            `categories` ( `name`, `decription`,`parent`, `ordering`, `visibility`,`allow_comments`, `allow_ads`)
                                VALUES ( :name,:decription ,:parent,:ordering,:visibility,:allow_comments,:allow_ads);");
                            $stmt->execute(array(
                                'name'=>$name,
                                'decription' =>$decription,
                                'parent' =>$parent,
                                'ordering'    =>$ordering,
                                'visibility'=>$visibility,
                                'allow_comments'=>$commenting,
                                'allow_ads'=>$ads,
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
        redirectHome($errorMsg,'?do=add',3);
    
    echo "<div></div>";
}
    }
elseif($do=='edit'){ // edit page
        $catid=isset($_GET['catid']) && is_numeric($_GET['catid'])?intval($_GET["catid"]):0;
        $stmt=$conn->prepare("SELECT  * FROM categories Where id=?;");
      $stmt->execute(array($catid));
      $row=$stmt->fetch();
      $count=$stmt->rowCount();
        if ($count>0){    
            ?>
                <div class="edit-page">
                    <div class="container">
                        <form action="?do=update"   method="post">
                            <h2 class="title"><?php echo lang("EDIT_CATEGORY")?></h2>
                            <input type="hidden" name='id' value=<?php echo $row['id'];?>>
                            <div class="input-box">
                                <input type="text" name="name" value='<?php echo $row['name'] ?>'>
                                <label for=""><?php echo lang("CATEGORY_NAME")?></label>
                                </div>
                                <div class="input-box">
                                    <input type="text" name="description" value='<?php echo $row['decription'] ?>'>
                                    <label for="" class=""> <?php echo lang("DESC_OF_CATEGORY")?> </label>                    
                                </div>
                                <div class="input-box">
                                    <input type="text" name="ordering" value='<?php echo $row['ordering'] ?>'  >
                                    <label for=""><?php echo lang("ORDER")?></label>                    
                                </div>
                                <!-- start category type  -->
                                <div class="input-box">
                                    <label for="">type of category</label>      
                                    <select name="parent" id="">
                                        <option value="0">baisc</option>
                                        <?php
                                        // $allCats=getAllFrom('*','categories','where parent=0','','id','');
                                        $getAll=$conn->prepare("SELECT * from categories  where parent=0  ORDER BY id ASC");
                                        $getAll->execute();
                                        $all =$getAll->fetchAll();
                                        foreach($all as $cat){
                                            echo "<option value='".$cat['id']."'>";
                                            echo $cat['name']."</option>";
                                        }
                                        ?>
                                    </select>              
                                </div>
                                <!-- end category type  -->
                                <div class="radio-box">
                                    <h2><?php echo lang("VISIBLILITY")?></h2>
                                    <div class="visible">
                                        <input type="radio" name='visibility' id='vis-yes' value='0' <?php if($row['visibility']==0){echo 'checked';} ?> >
                                        <label for="vis-yes"><?php echo lang("YES")?></label>
                                    </div>                    
                                    <div class="visible">
                                        <input type="radio" name='visibility' id='vis-no' value='1' <?php if($row['visibility']==1){echo 'checked';} ?>>
                                        <span></span>
                                        <label for="vis-no"><?php echo lang("NO")?></label>
                                    </div>                    
                                </div>
                                <div class="radio-box">
                                    <h2><?php echo lang("ALLOW_COMMENTING")?></h2>
                                    <div class="visible">
                                        <input type="radio" name='commenting' id='comm-yes' value='0' <?php if($row['allow_comments']==0){echo 'checked';} ?>>
                                        <label for="comm-yes"><?php echo lang("YES")?></label>
                                    </div>                    
                                    <div class="visible">
                                        <input type="radio" name='commenting' id='comm-no' value='1'<?php if($row['allow_comments']==1){echo 'checked';} ?> >
                                        <span></span>
                                        <label for="comm-no"><?php echo lang("NO")?></label>
                                    </div>                    
                                </div>
                                <div class="radio-box">
                                    <h2><?php echo lang("ALLOW_ADS")?></h2>
                                    <div class="visible">
                                        <input type="radio" name='ads' id='ads-yes' value='0' <?php if($row['allow_ads']==0){echo 'checked';} ?>>
                                        <label for="ads-yes"><?php echo lang("YES")?></label>
                                    </div>                    
                                    <div class="visible">
                                        <input type="radio" name='ads' id='ads-no' value='1'<?php if($row['allow_ads']==1){echo 'checked';} ?> >
                                        <span></span>
                                        <label for="ads-no"><?php echo lang("NO")?></label>
                                    </div>                    
                                </div>
                                <input type="submit" name="submit" value="save" >
                            </form>
                        </div>
                    </div>


                <?php
        }
    }
    elseif($do=='update'){
    // start update page 
    ?>
    <div class="update-page">
        <div class="container">
    <?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
         $id=$_POST['id'];
         $name=$_POST['name'];
        $decription=$_POST['description'];
        $ordering=$_POST["ordering"];
        $parent=$_POST["parent"];
        $visibility=$_POST['visibility'];
        $commenting=$_POST['commenting'];
        $ads=$_POST['ads'];
    

    //    start  validate the form 
        $formError=array();
        if (!preg_match($alphabtNumRugEx,$name)){
            $formError[]='you can\'t use symbols like$#%!% in user name';
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

        $stmt=$conn->prepare("UPDATE  categories 
                                            SET
                                                name=?,
                                                decription=?,
                                                ordering=?,
                                                parent=?,
                                                visibility=?,
                                                allow_comments=?,
                                                allow_ads=?
                                                where id=? ");
        $stmt->execute(array($name,$decription,$ordering,$parent,$visibility,$commenting,$ads,$id));
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
    elseif($do=='delete'){
            // start delete member page 
        $catid=isset($_GET['catid']) && is_numeric($_GET['catid'])?intval($_GET["catid"]):0;
        $stmt=$conn->prepare("SELECT  * FROM categories Where id=?;");
      $stmt->execute(array($catid));
      $count=$stmt->rowCount();

        if ($count>0){  
            $stmt=$conn->prepare('DELETE FROM categories where id=:zid');
            $stmt->bindParam(':zid',$catid);
            $stmt->execute();
        $errorMsg= "<h2 class='title' style='margin:50px auto;text-align:center; display:block;width:fit-contant;'>".$stmt->rowCount() ." ".lang('RECORD_DELETED')."</h2>";
            redirectHome($errorMsg,'back',.4);  

         }
         else {
            $errorMsg="this id not exist";
            redirectHome($errorMsg,'back');  

         }
    // end delete member page 
    }
    elseif($do=='activate'){
        
    }
    require_once($tempPath.'footer.php');
}else{
    header('location:index.php');
    exit();
}
   ob_end_flush();

?>
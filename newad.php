<?php
session_start();
ob_start();
 $title="new item";
require_once('init.php');
if(isset($_SESSION['endUser'])){

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
        $formErorrs=[];
        $name=filter_var($_POST['ad-name'],FILTER_SANITIZE_STRING);
        $desc=filter_var($_POST['desc'],FILTER_SANITIZE_STRING);
        $price=filter_var($_POST['price'],FILTER_SANITIZE_NUMBER_INT);
        $country=filter_var($_POST['country'],FILTER_SANITIZE_STRING);
        $status=filter_var($_POST['status'],FILTER_SANITIZE_NUMBER_INT);
        $cat=filter_var($_POST['categories'],FILTER_SANITIZE_NUMBER_INT);
        


        if(strlen($name)<3){
            $formErorrs[]='item name must be larger than 3 chararcters';
        }
        if(empty($name)){
            $formErorrs[]='you have to enter item name';
        }
        if(strlen($name)>18){
            $formErorrs[]='item name can not be larger than 18 chararcters';
        }
        if(strlen($desc)<9){
            $formErorrs[]='item description must be larger than 9 chararcters';
        }
        if(empty($desc)){
            $formErorrs[]='you have to enter item description';
        }
        if(empty($price)){
            $formErorrs[]='you have to enter item price';
        }
        if(empty($country)){
            $formErorrs[]='you have to enter item country';
        }
        if(strlen($country)<3){
            $formErorrs[]='item name must be larger than 3 chararcters';
        }
        if($status==0){
            $formErorrs[]='you have to enter item status';
        }
        if($cat==0){
            $formErorrs[]='you have to enter item category';
        }
                if(empty($avatar_name)){
            $formErrors[]='image can not be empty';
        }
        if($avatar_size>1024*4*1024){
            $formErrors[]='image is bigger than 4MB';
        }
        if(!empty($avatar_name) && !in_array($avatar_nameExetension,$avatarAllowedExtensions)){
            $formErrors[]="image extension is not allowed";
        }
        if(empty($formErrors)){
             $avatar=rand(0,1000000000000).'_'.$avatar_name;

            move_uploaded_file($avatar_temp,"adminPanal\uploads\products\\" .$avatar);
         //check statment
     //  start insert query 
            $stmt=$conn->prepare("INSERT INTO 
           `items` (`name`, `description`, `price`, `country_made`,`status`,`add_date`,`cat_id`,`user_id`,`avatar`) 
            VALUES ( :name,:description,:price, :country_made,:status,now(),:cat,:user,:avatar);");
                $stmt->execute(array(
                'name'        =>$name,
                'description' =>$desc,
                'price'       =>$price,
                'country_made'=>$country,
                'status'      =>$status,
                'cat'         =>$cat,
                'user'        =>$_SESSION['id'],
                'avatar'        =>$avatar,
            ));

            // echo success message 
            if($stmt)
            echo "<h2 class='title' style='margin:50px auto;text-align:center; display:block;width:fit-contant;'>1 ".lang('RECORD_ADDED')."</h2>";
 // end  insert query 
        }
    }
?>
<div class="profile">
    <div class="container">
        <h2 class='title'>create new ad</h2>
        <div class="box info">   
                <div class="panel panel-default">
                    <div class="panel-heading">create new ad</div>
                    <div class="panel-body">
                        <div class="row ad-row">
                            <div class="col-md-8">
                                <div class="add-ads">
                                    <form class="form" action="<?php echo $_SERVER['PHP_SELF']?>" method="POST" enctype="multipart/form-data">
                                        <div class="input-container">

                                        <input type="text"
                                           name="ad-name"
                                           class="live-name"
                                           required
                                           placeholder="name"
                                           pattern=".{3,18}"
                                           title="item name must be between 3 and 14 chars"
                                    >

                                        <input type="text" 
                                         placeholder="description"
                                         name="desc" 
                                         class="live-desc"
                                         required
                                         pattern=".{9,}"
                                         title="description must be larger than 9 char"
                                         >

                                        <input type="text"
                                         placeholder="price"
                                          name="price" 
                                          class="live-price"
                                          required>
                                          
                                        <span>
                                        </span>
                                    </div>
                                    <div class="input-container">

                                        <input type="text"  
                                          placeholder="country"
                                          name="country"
                                          class="live-country"
                                          required
                                          pattern=".{3,}"
                                          title="description must be larger than 3 char"
                                          >

                                             <div class="input-box select-box ad-list">
                                            <label for="select-stutes"><?php echo lang("STATUES_OF_ITEM")?></label>
                                                <select class='list' name="status" class='form-conrtol' id='select-stutes' >
                                                    <option value="0"><?php echo lang("...")?></option>
                                                    <option value="1"><?php echo lang("NEW")?></option>
                                                    <option value="2"><?php echo lang("LIKE_NEW")?></option>
                                                    <option value="3"><?php echo lang("USED")?></option>
                                                    <option value="4"><?php echo lang("OLD")?></option>
                                                </select>
                                            </div>
                                        </div>
                                             <div class="input-box select-box ad-list">
                                            <label for="select-stutes"><?php echo lang("CATEGORY_NAME")?></label>
                                                <select class='list' name="categories" class='form-conrtol' id='select-stutes' >
                                                    <option value="0"><?php echo lang("...")?></option>
                                                    <?php
                                                    // $cats=$stmt1->getAll('categories');
                                                    $getAll=$conn->prepare("SELECT * from categories  ORDER BY id ASC");
                                                    $getAll->execute();
                                                    $all =$getAll->fetchAll();
                                                    foreach($all as $cat){
                                                        echo "<option value='".$cat['id']."'>".$cat['name']."</option>";
                                                    }
                                                    ?>
                                                </select>
                                                <input type="file" name="avatar" id="">
                                            </div>
                                        <input type="submit" name="add-ad" value=" add new ad"class="submit">
                                </form>
                                </div>
                            </div>
                            <div class="col-md-4 ">
                                <div class="thumbanil item-box live-preview">
                                    <img src="desgin/img/feature01.jpg" class="img-responsive" alt="">
                                    <span class='price-tag'>$0</span>
                                    <div class="caption">
                                    <h3>title</h3>
                                    <p>desc</p>
                                </div>
                                </div>
                            </div>
                            <!-- start looping errors  -->
                            <?php

                             if(!empty($formErorrs)){
                                foreach($formErorrs as $error){
                                    echo "<p class='ads-error'><i class='fa-solid fa-circle-exclamation'></i> $error</p>";
                                }
                             }
                            ?>
                            <!-- end looping errors  -->
                        </div>

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

<?php
      session_start();
      $title="login";
      $nonavbar=''; 
      // التسجيل التلقائيstart 
      if(isset($_SESSION['username'])){   // التسجيل التلقائي
        header('location:dashborad.php'); 
        exit();
      }
      // التسجيل التلقائي end
      require('init.php');
    // check if user coming form http post request 
    if ($_SERVER['REQUEST_METHOD']=='POST'){
      
      $username=$_POST['user'];
      $password=$_POST['pass'];
      $hashedPass=sha1($password);
      // check if this user exist in the database 
      $stmt=$conn->prepare("SELECT user_id,user_name,password  FROM users Where user_name=? AND password=? AND group_id=1 LIMIT 1;");
      $stmt->execute(array($username,$hashedPass));
      $row=$stmt->fetch();
      $count=$stmt->rowCount();
      if($count>0){
        $_SESSION["username"]=$username;
        $_SESSION["id"]=$row['user_id'];
        header('location:dashborad.php');
        exit();
      }
    }
      ?>
  <div class="login">
    <div class="container">
    <div class="img">
    <img src="<?php echo $img?>login2.jpg" alt="">
    </div>
    <div class="login-box">
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
      <img src="<?php echo $img?>user.jpg"  style="width:200px;border-radius:50%;display:block;margin:auto" alt="">
      <h2 style="text-align:center"> <?php echo lang("ADMIN_LOGIN")?></h2>
      <div class="input-box">
        <div>
          <h5 style="margin:2px 0">
            <span class="fas fa-user"></span>
            <?php echo lang("USER_NAME")?>
          </h5>
          <input type="text" class="form-control" class="input"  required="" name="user">
        </div>
      </div>
      <div class="input-box">
        <div>
          <h5 style="margin:2px 0">
            <span class="fas fa-lock"></span>
            <?php echo lang("PASSWORD")?>
          </h5>
          <input type="password" class="form-control" class="input"  required="" name="pass">
        </div>
      </div>
      <a href="#" class="forget">
        <h5><?php echo lang("FORGET_THE_PASSOWRD")?></h5>
      </a>
      <input type="submit" class="btn" vlaue="login" name="submit">
    </form>
    </div>
  
    </div>
  </div>
<?php  

require($tempPath."footer.php"); ?>
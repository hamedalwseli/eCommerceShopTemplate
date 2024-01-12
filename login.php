<?php 
ob_start();
session_start();
$title="login";
if(isset($_COOKIE['user_name']) &&  isset($_COOKIE['user_email']) && isset($_COOKIE['user_pass'])){
    $user_name_from_cookie=$_COOKIE['user_name'];
    $user_email_from_cookie=$_COOKIE['user_email'];
    $user_pass_from_cookie=$_COOKIE['user_pass'];
}
else{
$user_name_from_cookie= $user_email_from_cookie= $user_pass_from_cookie='';
}
if(isset($_SESSION['endUser'])){
    header('location:index.php');
    exit();
}
require_once("init.php");  

// start cooke
if(isset($_REQUEST['remember_me'])){
}
// end cooke
// start login php code 
 // check if user coming form http post request 
    if ($_SERVER['REQUEST_METHOD']=='POST'){

    if(isset($_POST['login'])){ 

 
            $username=$_POST['username'];
            $email=$_POST['email'];
            $password=$_POST['pass'];
            $hashedPass=sha1($password);
            if(isset($_POST['remember_me'])){
                setcookie('user_name',$username,time()+60*60*24*120);
                setcookie('user_email',$email,time()+60*60*24*120);
                setcookie('user_pass',$password,time()+60*60*24*120);
                setcookie('checked','checked',time()+60*60*24*120);
            }else{
                setcookie('user_name',$username,time()-60*60*24*120);
                setcookie('user_email',$email,time()-60*60*24*120);
                setcookie('user_pass',$password,time()-60*60*24*120);   
                setcookie('checked','checked',time()-60*60*24*120);
            }
            
            // check if this user exist in the database

            $stmt=$conn->prepare("        SELECT * 
                                            FROM 
                                    users 
                                            Where 
                                    email=? 
                                            AND
                                    password=?  
                                            AND
                                    user_name=?
                                    ;");
            $stmt->execute(array($email,$hashedPass,$username));
            $row=$stmt->fetch();
            $count=$stmt->rowCount();
            if($count>0){
                if($row['reg_status']==0){
                        echo "<p class='reg-failed'><i class='fa-solid fa-triangle-exclamation'></i> sorry,you are waiting for activation<p>";
                }else{
                $_SESSION["endUser"]=$username;
                $_SESSION["id"]=$row['user_id'];
                header('location:index.php');
                exit();
                }
            }
            else{
                echo "<div class='reg-failed'><i class='fa-solid fa-triangle-exclamation'></i> sorry,check your name or password or email</div>";
            }
        }
        elseif($_POST['signup']){
            $username=$_POST['user_name'];
            $password=$_POST['password'];
            $hashPassword=sha1($password);
            $cpassword=$_POST['cpassword'];
            $email   =$_POST['email'];
            $full_name=$_POST['full_name'];
            // start validation 

            $formErrors=array();
            if(empty($username)){
            $formErrors[]="name can not be empty!";
            }
            if(empty($password)){
            $formErrors[]="password can not be empty!";
            }
            if(empty($cpassword)){
            $formErrors[]="confirm can not be empty!";
            }
            if(empty($email)){
            $formErrors[]="email can not be empty!";
            }
            if(empty($full_name)){
            $formErrors[]="full name can not be empty!";
            }
            if(isset($username)){
                $Vusername=filter_var($username, FILTER_SANITIZE_STRING);
                if(strlen($Vusername)< 3){
                    $formErrors[]='user name must be lager than 3  character!';
                }
            }
            if(isset($password)&isset($cpassword)){
                $Vpassowrd=filter_var($password, FILTER_SANITIZE_STRING);
                if($password!==$cpassword){
                    $formErrors[]='password is not match!';
                }
            }
            if(isset($email)){
               

                if(filter_var($email,FILTER_VALIDATE_EMAIL)!=true){
                    $formErrors[]='your email is not valid !';
                }
            }
             if(empty($formError)){
            //check statment
            $check=checkItems('user_name','users',$username);
            if($check==1){
                $formErrors[]='sorry this user is exsist';
            }
            else{
                    //  start insert query 
                            $stmt=$conn->prepare("INSERT INTO 
                                `users` (`user_name`, `password`, `email`, `full_name`,reg_status,`date`) 
                                VALUES ( :user_name,:password , :email, :full_name, 0,now());");
                            $stmt->execute(array(
                                'user_name'=>$username,
                                'password' =>$hashPassword,
                                'email'    =>$email,
                                'full_name'=>$full_name
                              ));
                        
                           $flag =$stmt->rowCount();
                          if($flag>0){
                            echo '<p class="flag"><i class="fa-solid fa-circle-check"></i> sgin up success</p>';
                        }
                    // echo success message 
                    // end  insert query 
                }
        }
        }
    }
    // start validation 
    // end login php code 
?>
        <div class="login-2">
            <div class="container" id="container-login-2">
                <div class="form-container sign-up">
                    <!-- start sign up form  -->
                    <form  action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                        <h1>Create Account</h1>
                        <div class="social-icons">
                            <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                            <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                            <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                        </div>
                        <span style='color:var(--light-color)'>or use your email for registeration</span>
                        <input 
                        type="text"
                        name='user_name'
                         placeholder="Name" 
                        pattern=".{4,12}"
                         title="user name must be between 4 and 12 chars"
                        required
                        >
                        <input type="text"
                         name='full_name' 
                         placeholder="full name"
                         pattern=".{9,}"
                        title="user name must be larger than 8 chars"
                         required  >
                        <input 
                            type="email" 
                            name='email'
                            placeholder="Email" 
                            required 
                        >
                        <input 
                            type="password"
                            name='password'
                            minlength="8" 
                            title="minmum length is 8 char" 
                            placeholder="Password"
                            required
                         >
                        <input 
                            type="password"
                            name='cpassword'
                            placeholder="confirm Password"
                            minlength="8" 
                            title="minmum length is 8 char"
                            required 
                            >
                        <input type="submit"name='signup' value="sign-up">
                      
                    </form>
                   
                    <!-- end sign up form  -->
                </div>
                <div class="form-container sign-in">
                    <!-- start sign in form  -->
                    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
                        <h1>Sign In</h1>
                        <div class="social-icons">
                            <a href="#" class="icon"><i class="fa-brands fa-google-plus-g"></i></a>
                            <a href="#" class="icon"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="#" class="icon"><i class="fa-brands fa-github"></i></a>
                            <a href="#" class="icon"><i class="fa-brands fa-linkedin-in"></i></a>
                        </div>
                        <span style='color:var(--light-color)'>or use your email password</span>
                        <input type="text" name='username' placeholder="name" value="<?php echo $user_name_from_cookie?>" required>
                        <input type="email" name='email' placeholder="Email" value="<?php echo $user_email_from_cookie?>" required>
                        <input type="password"  name='pass' placeholder="Password" value="<?php echo $user_pass_from_cookie?>" required>
                        <a href="#">Forget Your Password?</a>
                            <div class="checkbox-wrapper">
                            <input
                             checked="" 
                            type="checkbox" 
                            class="check"
                             id="check1-61" 
                            name="remember_me" 
                        id="remember-me"
                        <?php
                        if(isset($_COOKIE['checked'])){
                            echo 'checked';
                        }
                        ?>>
                            <label for="check1-61" class="label">
                                <svg width="45" height="45" viewBox="0 0 95 95">
                                <rect x="30" y="20" width="50" height="50" stroke="black" fill="none"></rect>
                                <g transform="translate(0,-952.36222)">
                                    <path d="m 56,963 c -102,122 6,9 7,9 17,-5 -66,69 -38,52 122,-77 -7,14 18,4 29,-11 45,-43 23,-4" stroke="black" stroke-width="3" fill="none" class="path1"></path>
                                </g>
                                </svg>
                                <span class='remember-me'>remember me</span>
                            </label>
                            </div>
                        <input type="submit" name="login" value="sign-in">
                    </form>
                    <!-- end sign in form  -->
                </div>
                <div class="toggle-container">
                    <div class="toggle">
                        <div class="toggle-panel toggle-left">
                            <h1>Welcome Back!</h1>
                            <p>Enter your personal details to use all of site features</p>
                            <button class="hidden" id="login-2">Sign In</button>
                        </div>
                        <div class="toggle-panel toggle-right">
                            <h1>Hello, Friend!</h1>
                            <p>Register with your personal details to use all of site features</p>
                            <button class="hidden" id="register">Sign Up</button>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        
                        <?php
                        if(!empty($formErrors)){
                            echo  '<div class="errors-box">';
                            foreach($formErrors as $error){
                            echo "<p class='error'><i class='fa-solid fa-circle-exclamation'></i> $error</p>";
                            } 
                            echo '</div>';
                        }
                        ?>
                  
    </body>

</html>

<?php
require($tempPath."footer.php");
ob_end_flush();
?>

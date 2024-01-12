    
    <!-- start seting -->
        <div class="setting">
            <div class="toggle-setting">
                <i class="fa fa-gear"></i>
            </div>
            <div class="seting-container">
                <div class="colors">
                    <h4>light colors</h4>
                    <ul>
                        <li class="color-active" data-color="#006880"></li>
                        <li data-color="#e91e63"></li>
                        <li data-color="#833471"></li>
                        <li data-color="#e056fd"></li>
                        <li data-color="#006266"></li>
                        <li data-color="#009688"></li>
                        <li data-color="#03a9f4"></li>
                        <li data-color="#4caf50"></li>
                        <li data-color="#FEA47F"></li>
                        <li data-color="#55E6C1"></li>
                        <li data-color="#EAB543"></li>
                        <li data-color="#F97F51"></li>
                        <li data-color="#1B9CFC"></li>
                        <li data-color="#58B19F"></li>
                        <li data-color="#2C3A47"></li>
                        <li data-color="#130f40"></li>
                        <li data-color="#30336b"></li>
                        <li data-color="#B33771"></li>
                        <li data-color="#3B3B98"></li>
                        <li data-color="#FD7272"></li>
                        <li data-color="#1289A7"></li>
                        <li data-color="#A3CB38"></li>
                        <li data-color="#FDA7DF"></li>
                        <li data-color="#BDC581"></li>
                        <li data-color="#82589F"></li>
                        <li data-color="#1abc9c"></li>
                        <li data-color="#2ecc71"></li>
                        <li data-color="#3498db"></li>
                        <li data-color="#9b59b6"></li>
                        <li data-color="#34495e"></li>
                        <li data-color="#16a085"></li>
                        <li data-color="#27ae60"></li>
                        <li data-color="#8e44ad"></li>
                        <li data-color="#e74c3c"></li>
                        <li data-color="#f39c12"></li>
                        <li data-color="#D980FA"></li>
                        <li data-color="#badc58"></li>
                        <li data-color="#6ab04c"></li>
                        <li data-color="#32ff7e"></li>
                        <li data-color="#3ae374"></li>
                        <li data-color="#006266"></li>
                        <li data-color="#1289A7"></li>
                        <li data-color="#0031e5"></li>

                        <h4>dark colors</h4>
                    
                       <li data-color="#22092C"></li>
                       <li data-color="#0F0F0F"></li>
                       <li data-color="#232D3F"></li>
                       <li data-color="#0C134F"></li>
                       <li data-color="#2C3333"></li>
                       <li data-color="#2C3639"></li>
                       <li data-color="#0F3460"></li>
                       <li data-color="#331D2C"></li>
                       <li data-color="#3F2E3E"></li>
                       <li data-color="#5F264A"></li>
                       <li data-color="#321E1E"></li>
                       <li data-color="#3C2A21"></li>
                       <li data-color="#562B08"></li>
                       <li data-color="#472D2D"></li>
                       <li data-color="#52057B"></li>
                       <li data-color="#610094"></li>
                       <li data-color="#3F0071"></li>
                       <li data-color="#79018C"></li>
                       <li data-color="#7858A6"></li>
                       <li data-color="#4C3575"></li>
                       <li data-color="#810CA8"></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--end seting -->

<nav class="navbar navbar-expand-lg bg-body-tertiary main-navbar" style="    box-shadow: var(--smooth-shadow);">
  <div class="container">
    <a class="navbar-brand" href="index.php?lang=<?php echo $lang?>" style="color:var(--main-color);font-weight:bold"><?php echo lang("ADMIN_HOME")?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"><i class="fa-solid fa-bars" style="color:var(--main-color);font-size:30px"></i></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent" style="flex-grow: 0;">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active li" aria-current="page" href="categories.php?lang=<?php echo $lang?>&sort=ASC" ><?php echo lang("CATEGORIES")?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active li" aria-current="page" href="items.php?lang=<?php echo $lang?>" ><?php echo lang("ITEMS")?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active li" aria-current="page" href="members.php?lang=<?php echo $lang?>" ><?php echo lang("MEMBERS")?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active li" aria-current="page" href="#" ><?php echo lang("STATISTIC")?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active li" aria-current="page" href="comments.php?lang=<?php echo $lang?>" ><?php echo lang("COMMENTS")?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link active li" aria-current="page" href="#" ><?php echo lang("LOGS")?></a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:var(--main-color);font-weight:bold">
            <?php echo $_SESSION['username']?>
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item li" href="members.php?lang=<?php echo $lang?>&do=edit&userID=<?php echo $_SESSION['id']?>" ><?php echo lang("EDIT_PROFILE")?></a></li>
            <li><a class="dropdown-item li" href="#" ><?php echo lang("SETTINGS")?></a></li>
            <li><a class="dropdown-item li" href="../index.php?lang=<?php echo $lang?>" target='_blank'><?php echo lang("VISIT_OUR_SHOP")?></a></li>
            <li><hr class="dropdown-divider li"></li>
            <li><a class="dropdown-item li" href="logout.php?lang=<?php echo $lang?>" ><?php echo lang("LOGOUT")?></a></li>
          </ul>
             <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="color:var(--main-color);font-weight:bold">
              <i class="fa-solid fa-language"></i></a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item li" href="?lang=ar">arabic</a></li>
            <li><a class="dropdown-item li" href="?lang=en" >english</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>

<?php
session_start(); 
include "includes/head_link.php"?>
<body class="bg_img bg-color">
        <div class="wrapper fadeInDown">
                <div id="formContent">
                  <!-- Tabs Titles -->
              
                  <!-- Icon -->
                  <div class="fadeIn first">
                    <img src="<?=$baseurl?>assets/images/puc.png" id="icon" alt="User Icon" />
                    <h1 style="color:#15da67;">Premier University</h1>
                    
                    <p style="color:#fff;">Login Panel</p>
                    <div><?php
                //if(isset($_SESSION['alert'])){
                //echo '<div class="alert alert-'.$_SESSION['alert_type'].'"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['alert'].'</div>';
                //unset($_SESSION['alert']);
                //}
            ?>
          </div>
                    <hr style="width:100%;">
                    
                  </div>
              
                  <!-- Login Form -->
                  <form class="login" action="admin/sql/select_sql.php" method="post">
                    <input type="text" id="login" class="fadeIn second" name="username" placeholder="Username/Member ID">
                    <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
                    <input type="submit" class="fadeIn fourth btn-hover color-8" name="login" value="Log In">
                  </form>
                  
              
                  <!-- Remind Passowrd -->
                  <div id="formFooter">
                      <div style="float: left"> <a class="underlineHover" href="index.php">Go To The User Menu</a></div>
                        <div style="float:right"><span class="sign_up_css">
                                <a href="registration.php" class="underlineHover">Sign Up</a>
                            </span>
                        </div>
                  </div>
               
              
                </div>
              </div>
  <?php include "includes/footer_link.php";?>
</body>
</html>
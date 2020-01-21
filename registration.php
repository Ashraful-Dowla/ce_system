<?php include "includes/head_link.php"?>
<?php include "admin/includes/db/connection_db.php"?>

<body class="bg-color bg_img">

    <div class="signup-form  fadeInDown regs_logo" >

        <form class="reg" action="admin/sql/insert_sql.php" method="post" onsubmit="return validate();">
            <div class="fadeIn first">
                <img src="<?=$baseurl?>assets/images/puc.png" id="icon" alt="User Icon" />
                <h2>Premier University</h2>
                <p>Registration Panel</p>
                <hr>
            </div>
            <div id="alert_box"></div>
            <?php
                //if(isset($_SESSION['alert'])){
                //echo '<div class="alert alert-'.$_SESSION['alert_type'].'"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['alert'].'</div>';
                //unset($_SESSION['alert']);
                
            ?>
            <div class="form-group">
              <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-hand-o-up"></i></span>
                  <select class="form-control form-control-sm" name="user_type">
                          <option>Select </option>
                          <option value="2">Teacher</option>
                          <option value="3">Student</option>
                  </select>
              </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon input_css"><i class="fa fa-id-badge"></i>
                    </span>
                    <input type="name" class="form-control" name="member_id" placeholder="Your ID" required="required">
                    <span></span>
                                                 <?php
                                                    if(isset($_SESSION['err_id'])){
                                                    echo '<span class="validation_error">'.$_SESSION['er_id'].'</span>';
                                                    unset($_SESSION['err_id']);
                                                    }
                                                ?>
                                                   
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="name" class="form-control" name="name" placeholder="Your Name" required="required">
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    <input type="name" class="form-control" name="username" placeholder="Your Username" required="required">
                      <?php
                                                    if(isset($_SESSION['err_username'])){
                                                    echo '<span class="validation_error">'.$_SESSION['err_username'].'</span>';
                                                    unset($_SESSION['err_username']);
                                                    }
                                                ?>
                </div>
            </div>
            <div class="form-group">
                <div class="input-group">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <input type="email" class="form-control" name="email" placeholder="Your Email ID" required="required">

                                                <span></span>
                                                 <?php
                                                    if(isset($_SESSION['err_email'])){
                                                    echo '<span class="validation_error">'.$_SESSION['err_email'].'</span>';
                                                    unset($_SESSION['err_email']);
                                                    }
                                                ?>
                 
                </div>
            </div>
              <div class="form-group">
                  <div class="input-group">
                      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      <input type="password" id="password" class="form-control" name="password" placeholder="Your Password" required="required">
                       <?php
                                                    if(isset($_SESSION['err_pass'])){
                                                    echo '<span class="validation_error">'.$_SESSION['err_pass'].'</span>';
                                                    unset($_SESSION['err_pass']);
                                                    }
                                                ?> 
                  </div>
              </div>

              <div class="form-group">
                <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input type="password" id="re_password" class="form-control" name="re_password" placeholder="Re-enter Password" required="required">
                    </div>
              </div>

                
                <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-hand-o-up"></i></span>
                           <select class="form-control form-control-sm" name="department" required="required">
                                                    <option>Select Depertmant</option>
                                                    <?php
                                                        $sql = "SELECT * from department where status = 1";
                                                        $query = $conn->query($sql);
                                                        $row = $query->num_rows;
                                                        if ($row > 0) {
                                                            while ($data = $query->fetch_assoc()){
                                                                $id = $data['id'];
                                                                $name = $data['department_name'];
                                                                 if(isset($_SESSION['old_dept']) && ($_SESSION['old_dept'] == $id)){
                                                                    echo "<option selected  value=$id>$name</option>";
                                                                }
                                                                else {
                                                                    echo "<option value=$id>$name</option>";
                                                                }
                                                                
                                                            } 
                                                        }
                                                         if(isset($_SESSION['old_dept'])){
                                                            unset($_SESSION['old_dept']);
                                                        }
                                                        

                                                    ?>
                                                    </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-hand-o-up"></i></span>
                          <select class="form-control form-control-sm" name="section">
                                                    <option>Select Section(Only For Student)</option>
                                                    <?php
                                                        $sql = "SELECT * from section where status = 1";
                                                        $query = $conn->query($sql);
                                                        $row = $query->num_rows;
                                                        if ($row > 0) {
                                                            while ($data = $query->fetch_assoc()){
                                                                $id = $data['id'];
                                                                $name = $data['section_name'];
                                                             if(isset($_SESSION['old_section']) && ($_SESSION['old_section'] == $id)){
                                                                    echo "<option selected  value=$id>$name</option>";
                                                                }
                                                                else {
                                                                    echo "<option value=$id>$name</option>";
                                                                }
                                                                
                                                            } 
                                                        }
                                                         if(isset($_SESSION['old_section'])){
                                                            unset($_SESSION['old_section']);
                                                        }
                                                    ?>
                                                    </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-hand-o-up"></i></span>
                           <select class="form-control form-control-sm" name="semester">
                                                    <option>Select Semester(Only for Student)</option>
                                                    <?php
                                                    $sql = "SELECT * from semester where status = 1";
                                                    $query = $conn->query($sql);
                                                    $row = $query->num_rows;
                                                    if ($row > 0) {
                                                        while ($data = $query->fetch_assoc()){
                                                            $id = $data['id'];
                                                            $name = $data['semester_name'];
                                                       if(isset($_SESSION['old_semester']) && ($_SESSION['old_semester'] == $id)){
                                                                    echo "<option selected  value=$id>$name</option>";
                                                                }
                                                                else {
                                                                    echo "<option value=$id>$name</option>";
                                                                }
                                                                
                                                            } 
                                                        }
                                                         if(isset($_SESSION['old_semester'])){
                                                            unset($_SESSION['old_semester']);
                                                        }
                                                        
                                                    ?>
                                                </select>  
                        </div>
                    </div>


         
                    
             
            <div class="text-center " style="font-size:12px;">
                Already have an account?
                 <a href="login.php" style="color:#15da67;">
                     Login here
                 </a>
            </div>
            <div class="form-group">
                <input type="submit" name="signup" class="fadeIn fourth btn-hover color-8" value="Sign Up"/>
            </div>
        </form>

    </div>


<?php include "includes/footer_link.php";?>

<script>

var alert_box = document.querySelector('#alert_box');
  function validate(){
    
  var pass = document.querySelector('#password');
  var re_pass = document.querySelector('#re_password');
      if (pass.value != re_pass.value) {
        alert_box.innerHTML = "<div class='alert alert-danger'>Password Not Matched!!</div>";
        return false;
      }
      else{
        return true;
      }
  }

</script>
</body>

</html>

<?php include('../includes/db/connection_db.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
        <?php include('../includes/head_link.php');?>

    </head>
    <body class="fixed-top">

        <!-- wrapper -->
        <div id="wrapper">
            <!-- BEGIN HEADER -->
             <?php include('../includes/nav_header.php');?>
            <!-- END HEADER -->
            <!-- BEGIN HEADER & CONTENT DIVIDER -->
            <div class="clearfix"> </div>
            <!-- END HEADER & CONTENT DIVIDER -->

            <!-- BEGIN CONTAINER -->
            <div class="page-container">

                <?php include('../includes/left_sidebar.php');?>

                <!-- BEGIN CONTENT BODY -->
                <div class="page-content-wrapper">
                    <div class="content-wrapper container">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="page-title">
                                    <div class="row">
                                        <!-- <h4 class="pull-left">Add Subject</h4> -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->
                         
                        <a href="student_list.php" class="btn btn-primary">Student List</a>
                        <div id="alert_box"></div>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                      Add Student Form
                                    </div>
                                    <div class="panel-body">

                                    <div>
                                        <?php
                                            // if(isset($_SESSION['err_student_id'])){
                                            // echo '<div class="alert alert-'.$_SESSION['alert_type'].' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['err_student_id'].'</div>';
                                            // unset($_SESSION['err_student_id']);
                                            // }
                                        ?>
                                    </div>
 
                                    <!-- form -->
                                    <form class="form-horizontal" method="post" action="<?=$base?>/sql/insert_sql.php" onsubmit="return validate();">

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Student ID</label>
                                            <div class="col-lg-9">
                                                
                                                    <?php 
                                                        if(isset($_SESSION['old_student_id'])){
                                                            ?>
                                                            <input type="text" value=" <?php echo $_SESSION['old_student_id']  ?>" name="student_id" placeholder="Student ID" class="form-control" required="required" > 
                                                         <?php unset($_SESSION['old_student_id']) ;
                                                     }
                                                        else {
                                                           echo '<input type="text" name="student_id" placeholder="Student ID" class="form-control" required="required"> ' ;
                                                        }

                                                     ?>
                                                 
                                                
                                                <span></span>
                                                 <?php
                                                    if(isset($_SESSION['err_student_id'])){
                                                    echo '<span class="validation_error">'.$_SESSION['err_student_id'].'</span>';
                                                    unset($_SESSION['err_student_id']);
                                                    }
                                                ?>
                                                        
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Name</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                        if(isset($_SESSION['old_name'])){
                                                            ?>
                                                            <input type="text" value=" <?php echo $_SESSION['old_name']  ?>" name="name" placeholder="Name" class="form-control" required="required"> 
                                                         <?php unset($_SESSION['old_name']) ;
                                                     }
                                                        else {
                                                           echo '<input type="text" name="name" placeholder="Name" class="form-control" required="required" > ' ;
                                                        }

                                                     ?>
                                                 
                                                
                                                <span></span> 
                                            </div>
                                        </div>



                                         
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Department</label>
                                                <div class="col-lg-9">
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
                                            <label class="col-lg-3 control-label">Semester</label>
                                            <div class="col-lg-9">
                                                <select class="form-control form-control-sm" name="semester">
                                                    <option>Select Semester</option>
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

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Section</label>
                                                <div class="col-lg-9">
                                                    <select class="form-control form-control-sm" name="section">
                                                    <option>Select Section</option>
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
                                            <label class="col-lg-3 control-label">Email</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                        if(isset($_SESSION['old_email'])){
                                                            ?>
                                                            <input type="email" value=" <?php echo $_SESSION['old_email']  ?>" name="email" placeholder="E-mail" class="form-control"> 
                                                         <?php unset($_SESSION['old_email']) ;
                                                     }
                                                        else {
                                                           echo '<input type="email" name="email" placeholder="E-mail" class="form-control" required="required"> ' ;
                                                        }

                                                     ?>
                                                 
                                                
                                                <span></span>
                                                 <?php
                                                    if(isset($_SESSION['err_email'])){
                                                    echo '<span class="validation_error">'.$_SESSION['err_email'].'</span>';
                                                    unset($_SESSION['err_email']);
                                                    }
                                                ?>
                 
                                            </div>
                                        </div>

                                        <h5 class="text-center"> LOGIN CREDENTIALS </h5>
                                        <!-- Bottom section for login data -->
                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Username</label>
                                            <div class="col-lg-9">
                                                <?php 
                                                        if(isset($_SESSION['old_username'])){
                                                            ?>
                                                            <input type="text" value=" <?php echo $_SESSION['old_username']  ?>" name="username" placeholder="Username" class="form-control" required="required" > 
                                                         <?php unset($_SESSION['old_username']) ;
                                                     }
                                                        else {
                                                           echo '<input type="text" name="username" placeholder="Username" class="form-control" required="required"> ' ;
                                                        }

                                                     ?>
                                                 
                                                
                                                <span></span>
                                                 <?php
                                                    if(isset($_SESSION['err_username'])){
                                                    echo '<span class="validation_error">'.$_SESSION['err_username'].'</span>';
                                                    unset($_SESSION['err_username']);
                                                    }
                                                ?> 
                                            </div>
                                        </div>

                                        

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Password</label>
                                            <div class="col-lg-9">

                                                <input type="password" name="password" placeholder="Password" id="password" class="form-control" required="required"> 
                                                <span></span>
                                                 <?php
                                                    if(isset($_SESSION['err_pass'])){
                                                    echo '<span class="validation_error">'.$_SESSION['err_pass'].'</span>';
                                                    unset($_SESSION['err_pass']);
                                                    }
                                                ?> 
                                            </div>  
                                        </div>

                                        <div class="form-group">
                                            <label class="col-lg-3 control-label">Re-Password</label>
                                            <div class="col-lg-9">
                                                <input type="password" name="re_password" placeholder="Re-enter Password"  id="re_password" class="form-control" required="required"> 
                                            </div>  
                                        </div>
                                        
                                        <div class="form-group">
                                            <div class="col-lg-offset-3 col-lg-9">
                                                <input type="submit" class="btn btn-sm btn-primary" name="add_student" value="submit">
                                            </div>
                                        </div>          
                                    </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                <div class="clearfix"></div>
                  <?php include('../includes/footer.php');?>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTAINER -->
        </div>
        <!-- /wrapper -->


        <!-- SCROLL TO TOP -->
        <a href="#" id="toTop"></a>


        <!-- PRELOADER -->
        <div id="preloader">
            <div class="inner">
                <span class="loader"></span>
            </div>
        </div><!-- /PRELOADER -->


    <!-- JAVASCRIPT FILES -->
          <?php include('../includes/footer_link.php');?>

          <script>
          $('.select2').select2();
          
          </script>

        <script>

        var alert_box = document.querySelector('#alert_box');
        function validate(){
            
        var pass = document.querySelector('#password');
        var re_pass = document.querySelector('#re_password');
            if (pass.value != re_pass.value) {
                alert_box.innerHTML = "<div class='alert alert-danger alert-dismissible'><a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Password Not Matched!!</div>";
                return false;
            }
            else{
                return true;
            }
        }

        </script>

    </body>
</html>
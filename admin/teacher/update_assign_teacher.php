
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
                                        <!-- <h4 class="pull-left">Update</h4> -->
                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->
                        <a href="assign_teacher_list.php" class="btn btn-primary">Assign Teacher List</a>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                      Update Assign Details
                                    </div>
                                    <div class="panel-body">

                                    <div><?php
                                        if(isset($_SESSION['alert'])){
                                            echo '<div class="alert alert-'.$_SESSION['alert_type'].' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['alert'].'</div>';
                                            unset($_SESSION['alert']);
                                            }
                                        ?></div>

                                        <!-- form -->
                                    <form class="form-horizontal" method="post" action="<?=$base?>/sql/update_sql.php">
                                    
                                    
                                    <?php
                                    if(isset($_GET['id'])){
                                      $id = $_GET['id'];

                                      $teacher_data = "SELECT teacher_id,session_id,subject_id,section_id from assign_teacher where id=$id";

                                      $query = $conn->query($teacher_data);

                                      if ($query->num_rows > 0 ) {
                                        while($data = $query->fetch_assoc()) {
                                        
                                    ?>
                                    <input type="hidden" name="id" value="<?=$id?>">
                                            <div class="form-group">
                                              <label class="col-lg-3 col-md-3 control-label">Select Teacher</label>
                                              <div class="col-lg-9 col-md-9">
                                                  <select name="teacher" class="form-control teacher">
                                                  <option value="">Select</option>
                                                  <?php
                                                      $sql = "SELECT * from teacher where status = 1";
                                                      $result = $conn->query($sql);
                                                      while($teacher = $result->fetch_assoc()){
                                                      if ($teacher['teacher_id'] == $data['teacher_id']) {
                                                        $select = "selected";
                                                      }
                                                      else{
                                                        $select = '';
                                                      }

                                                          echo '<option value="'.$teacher['teacher_id'].'"'.$select.'>'.$teacher['teacher_id'].'('.$teacher['name'].')</option>';
                                                      }
                                                  ?>
                                                  </select>
                                              </div>
                                            </div>
                                         
                                            <div class="form-group">
                                                <label class="col-lg-3 col-md-3 control-label">Select Session</label>
                                                <div class="col-lg-9 col-md-9">
                                                    <select name="session" class="form-control">
                                                    <option value="">Select</option>
                                                    <?php
                                                        $sql = "SELECT * from session where status = 1";
                                                        $result = $conn->query($sql);
                                                        while($session = $result->fetch_assoc()){

                                                          if ($session['id'] == $data['session_id']) {
                                                            $select = "selected";
                                                          }
                                                          else{
                                                            $select = '';
                                                          }
                                                            echo '<option value="'.$session['id'].'"'.$select.'>'.$session['session_name'].'('.$session['year'].')</option>';
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <label class="col-lg-3 col-md-3 control-label">Select Section</label>
                                                <div class="col-lg-9 col-md-9">
                                                    <select name="section" class="form-control">
                                                    <option value="">Select</option>
                                                    <?php
                                                        $sql = "SELECT * from section where status = 1";
                                                        $result = $conn->query($sql);
                                                        while($section = $result->fetch_assoc()){

                                                          if ($section['id'] == $data['section_id']) {
                                                            $select = "selected";
                                                          }
                                                          else{
                                                            $select = '';
                                                          }
                                                            echo '<option value="'.$section['id'].'"'.$select.'>'.$section['section_name'].'</option>';
                                                        }
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                    
                                            <div class="form-group">
                                                <label class="col-lg-3 col-md-3 control-label">Select Subject</label>
                                                <div class="col-lg-9 col-md-9">
                                                    <select name="subject" class="form-control subject">
                                                    <?php
                                                        $sql = "SELECT * from subject where status = 1";

                                                        $result = $conn->query($sql);
                                                        // $all_sub = array();
                                                        // $all_sub = explode(",",$data['subject_id']);
                                                        while($subject = $result->fetch_assoc()){
                                                            if ($data['subject_id'] == $subject['id']) 
                                                            {
                                                              $select = "selected";
                                                            }
                                                            else{
                                                                $select='';
                                                            }
                                                          
                                                          echo '<option value="'.$subject['id'].'"'.$select.'>'.$subject['subject_name'].' </option>';
                                                          
                                                          
                                                            
                                                        }
                                                        // print_r($all_sub);
                                                    ?>
                                                    </select>
                                                </div>
                                            </div>
                                          <?php
                                            }
                                          }
                                        }
                                          
                                        ?>
                                            <div class="form-group">
                                                <div class="col-lg-offset-3 col-lg-9">
                                                    <input type="submit" class="btn btn-sm btn-primary" name="update_assign_teacher" value="update">
                                               
                                                </div>
                                            </div>
                                     
                                        </form>
                                        <!-- form -->

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
          $('.session').select2({'placeholder':'Select Session'});
          $('.subject').select2({'placeholder':'Select Subjects'});
          </script>

    </body>
</html>
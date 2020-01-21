
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
                                        <h4 class="pull-left">Add Subject</h4>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->
                        <a href="subject_list.php" class="btn btn-primary">Subject List</a>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                      Add Subject Form
                                    </div>
                                    <div class="panel-body">
                                    <div><?php
                                        //if(isset($_SESSION['alert'])){
                                            //echo '<div class="alert alert-'.$_SESSION['alert_type'].' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['alert'].'</div>';
                                            //unset($_SESSION['alert']);
                                            //}
                                        ?></div>
                                        <!-- form -->
                                    <form class="form-horizontal" method="post" action="<?=$base?>/sql/insert_sql.php">
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
                                                            echo "<option value=$id>$name</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="col-lg-3 control-label">Subject Id:</label>

                                            <div class="col-lg-9">
                                                <?php 
                                                        if(isset($_SESSION['old_sub_id'])){
                                                            ?>
                                                            <input type="text" value=" <?php echo $_SESSION['old_sub_id']  ?>" name="subject_id" placeholder="Subject ID" class="form-control" required="required" > 
                                                         <?php unset($_SESSION['old_sub_id']) ;
                                                     }
                                                        else {
                                                           echo '<input type="text" name="subject_id" placeholder="Subject ID"class="form-control" required="required"> ' ;
                                                        }

                                                     ?>
                                                 
                                                <span></span>
                                                 <?php
                                                    if(isset($_SESSION['err_subject_id'])){
                                                    echo '<span class="validation_error">'.$_SESSION['err_subject_id'].'</span>';
                                                    unset($_SESSION['err_subject_id']);
                                                    }
                                                ?> 
                                            </div>
                                            </div>
                                              <div class="form-group">
                                                <label class="col-lg-3 control-label">Subject Name
                                                </label>

                                            <div class="col-lg-9">
                                                 <?php 
                                                        if(isset($_SESSION['old_sub_name'])){
                                                            ?>
                                                            <input type="text" value=" <?php echo $_SESSION['old_sub_name']  ?>" name="subject_name" placeholder="Subject Name" class="form-control" required="required" > 
                                                         <?php unset($_SESSION['old_sub_name']) ;
                                                     }
                                                        else {
                                                           echo '<input type="text" name="subject_name" placeholder="Subject Name"class="form-control" required="required"> ' ;
                                                        }

                                                     ?>
                                                 
                                                <span></span>
                                                 <?php
                                                    if(isset($_SESSION['err_subject_name'])){
                                                    echo '<span class="validation_error">'.$_SESSION['err_subject_name'].'</span>';
                                                    unset($_SESSION['err_subject_name']);
                                                    }
                                                ?>
                                            </div>
                                            </div>
                                    
                                      
                                          
                                            <div class="form-group">
                                                <div class="col-lg-offset-3 col-lg-9">
                                                    <input type="submit" class="btn btn-sm btn-primary" name="add_subject" value="submit">
                                               
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
          $('.select2').select2();
          
          </script>

    </body>
</html>
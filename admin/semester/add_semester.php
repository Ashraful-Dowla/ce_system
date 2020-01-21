
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
                                        <h4 class="pull-left">Add Semester</h4>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->
                        <a href="semester_list.php" class="btn btn-primary">Semester List</a>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                      Add Semester Form
                                    </div>
                                    <div class="panel-body">

                                    <div>
                                        <?php
                                            //if(isset($_SESSION['alert'])){
                                            //echo '<div class="alert alert-'.$_SESSION['alert_type'].' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['alert'].'</div>';
                                            //unset($_SESSION['alert']);
                                            //}
                                        ?>
                                    </div>

                                    <!-- form -->
                                    <form class="form-horizontal" method="post" action="<?=$base?>/sql/insert_sql.php">
                                         <div class="form-group">
                                            <label class="col-lg-3 control-label">Semester</label>
                                            <div class="col-lg-9">

                                            <select class="form-control" name="semester_no" id="">
                                                <option value="">Select</option>
                                                <?php
                                                    for ($i=1; $i<=8; $i++){
                                                        
                                                    
                                                     if(isset($_SESSION['old_semseter_no']) && ($_SESSION['old_semseter_no'] == $id)){
                                                                    echo '<option selected value="'.$i.'">'.$i.'</option>';
                                                                }
                                                                else {
                                                                    echo '<option value="'.$i.'">'.$i.'</option>';
                                                                }
                                                                
                                                            } 
                                                        if(isset($_SESSION['old_semseter_no'])){
                                                            unset($_SESSION['old_semseter_no']);
                                                        }
                                                    
                                                ?>
                                            </select>
  <span></span>
                                                 <?php
                                                    if(isset($_SESSION['err_semester_no'])){
                                                    echo '<span class="validation_error">'.$_SESSION['err_semester_no'].'</span>';
                                                    unset($_SESSION['err_semester_no']);
                                                    }
                                                ?>
                                            </div> 
                                            
                                            </div>

                                            <div class="form-group">

                                                <label class="col-lg-3 control-label">Semester Title
                                                </label>

                                                <div class="col-lg-9">
                                                     <?php 
                                                        if(isset($_SESSION['old_semester'])){
                                                            ?>
                                                            <input type="text" value=" <?php echo $_SESSION['old_semester']  ?>" name="semester_name" placeholder="Example: 2nd Semester" class="form-control" required="required" > 
                                                         <?php unset($_SESSION['old_semester']) ;
                                                     }
                                                        else {
                                                           echo '<input type="text" name="semester_name" placeholder="Example: 2nd Semester"class="form-control" required="required"> ' ;
                                                        }

                                                     ?>
                                                 
                                                
                                                <span></span>
                                                 <?php
                                                    if(isset($_SESSION['err_semester_name'])){
                                                    echo '<span class="validation_error">'.$_SESSION['err_semester_name'].'</span>';
                                                    unset($_SESSION['err_semester_name']);
                                                    }
                                                ?>
                                                   
                                                </div>

                                            </div>

                                      
                                          
                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <input type="submit" class="btn btn-sm btn-primary" name="add_semester" value="submit">
                                               
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

    </body>
</html>
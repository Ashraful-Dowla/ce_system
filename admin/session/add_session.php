
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
                                        <h4 class="pull-left">Add Session</h4>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->
                        <a href="session_list.php" class="btn btn-primary">Session List</a>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                      Add Session Form
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
                                            <label class="col-lg-2 control-label">Session</label>
                                            <div class="col-lg-10">
                                  <?php 
                                   if(isset($_SESSION['old_session'])){
                                    ?>
                                    <input type="text" value=" <?php echo $_SESSION['old_session']  ?>" name="session_name" placeholder="Session Name Name" class="form-control" required="required" > 
                                    <?php unset($_SESSION['old_session']) ;
                                      }
                                      else {
                                      echo '<input type="text" name="session_name" placeholder="Session Name"class="form-control" required="required"> ' ;
                                        }

                                        ?>
                                      <span></span>
                                      <?php
                                      if(isset($_SESSION['err_session'])){
                                      echo '<span class="validation_error">'.$_SESSION['err_session'].'</span>';
                                      unset($_SESSION['err_session']);
                                      }
                                      ?>
                                           
                                            <!-- <select class="form-control" name="session_name" id="">
                                                <option value="">Select</option>
                                                <option value="jan-jun">Jan-Jun</option>
                                                <option value="july-dec">July-Dec</option>
                                            </select> -->
                                            </div> 
                                            
                                            </div>
                                            <div class="form-group">
                                            <label class="col-lg-2 control-label">Year</label>

                                            <div class="col-lg-10">
                                            <select class="form-control" name="year" id="">
                                                <option value="">Select</option>
                                                <option value="2019">2019</option>
                                                <option value="2020">2020</option>
                                                <option value="2021">2021</option>
                                                <option value="2022">2022</option>
                                                <option value="2023">2023</option>
                                                <option value="2024">2024</option>
                                            </select>
                                            </div>
                                            </div>
                                    
                                      
                                          
                                            <div class="form-group">
                                                <div class="col-lg-offset-2 col-lg-10">
                                                    <input type="submit" class="btn btn-sm btn-primary" name="add_session" value="submit">
                                               
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
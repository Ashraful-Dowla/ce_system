
<?php 
// session_start();
include('../includes/db/connection_db.php');?>
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
                                        <h4 class="pull-left">Edit Semester</h4>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->
                        <a href="semester_list.php" class="btn btn-primary">Semester List</a>
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">

                                <div class="panel panel-card recent-activites">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                       Semester List
                                    </div>
                                    <div class="panel-body">

                                    <div>
                                        <?php
                                            if(isset($_SESSION['alert'])){
                                            echo '<div class="alert alert-'.$_SESSION['alert_type'].' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['alert'].'</div>';
                                            unset($_SESSION['alert']);
                                            }
                                        ?>
                                    </div>
                                         <!-- form -->
                                         <form class="form-horizontal" method="post" action="<?=$base?>/sql/update_sql.php">
                                         <?php 
                                         if (isset($_GET['id'])) {
                                            $id = $_GET['id'];
                                        
                                            $sql = "SELECT * from semester where id=$id";

                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) {
                                            
                                            $semester_no = $row["semester_no"];
                                            $semester_name = $row["semester_name"];
                                            
                                            
                                            ?>
                                          

                                          <input type="hidden" name="id" value="<?=$id?>">

                                                <div class="form-group">
                                                    <label class="col-lg-3 control-label">Semester</label>
                                                    <div class="col-lg-9">
                                                        <input style="padding-left: 10px" type="number" value="<?=$semester_no?>" disabled>

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
                                                        <input type="text" name="semester_name" placeholder="Example: 2nd Semester" class="form-control" value="<?=$semester_name?>">
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
                                                <div class="col-lg-offset-3 col-lg-9">
                                                    <input type="submit" class="btn btn-sm btn-primary" name="update_semester" value="update">
                                               
                                                </div>
                                            </div>
                                            <?php }}  }?>
                                        </form>
                                        <!-- form -->
                                    </div>
                                </div><!-- End .panel --> 
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
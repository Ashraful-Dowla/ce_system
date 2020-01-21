
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
                                    <?php 
                                    if (isset($_GET['id'])) {
                                      $ast_id = $_GET['id'];
                                    }
                                  
                                  $details = "SELECT
                                  teacher.name as teacher_name,
                                  subject.subject_name as subject
                                  FROM `assign_teacher`
                                  left join assign_class on assign_class.assign_teacher_id=assign_teacher.id
                                  left join teacher on assign_teacher.teacher_id = teacher.teacher_id
                                  left join subject on assign_teacher.subject_id= subject.id
                                  where assign_class.assign_teacher_id = $ast_id";
  
                                  $t_result = $conn->query($details);
  
                                  if ($t_result->num_rows > 0){
  
                                      $data = $t_result->fetch_object();
  
                                      echo '<h4 class="pull-left">Daily Course Lecture of <ins>'.$data->subject.'</ins> Taken by <ins> '.$data->teacher_name.' </ins></h4>';
                                  
                                  }
  
                                  // else{
                                  //     echo '<h4 class="pull-left">Class Lecture not assigned yet!!</h4>';
                                  // }
                                ?>
                             
                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->
                         
                        <a class="btn btn-info" href="<?=$base?>/review/review_list.php">Back</a>

                        <div class="row">
                        <div class="col-md-10 col-md-offset-1"><div class="panel panel-card margin-b-30 m-4">
                              <div class="panel-heading">
                                      <h5>Class wise list</h5>
                                    </div>
                              <div class="panel-body">
                              <div><?php
                                    if(isset($_SESSION['alert'])){
                                    echo '<div class="alert alert-'.$_SESSION['alert_type'].' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['alert'].'</div>';
                                    unset($_SESSION['alert']);
                                    }
                                    ?></div>
                              <div class="table-responsive">
                                            <table id="basic-datatables" class="table table-bordered" style="table-layout:fixed">
                                                <thead>
                                                    <tr>
                                                        <th width='15%'> Class No. </th>
                                                        <th> Topic </th>
                                                        <th> Student review </th>
                                                        
                                                    </tr>
                                                </thead>
                                               
                                                <tbody>
                                                     
                                                <?php 
                                                
                                                
                                                $sql = "SELECT daily_class_lecture.id as id,daily_class_lecture.class_no as class_no, daily_class_lecture.course_outline as course_outline
                                                from daily_class_lecture
                                                left join assign_class 
                                                on assign_class.id=daily_class_lecture.assign_class_id
                                                left join assign_teacher
                                                on assign_teacher.id=assign_class.assign_teacher_id where assign_teacher.id=$ast_id";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) { ?>

                                                <tr>
                                                    
                                                    <td><?php echo "Class ".$row['class_no'];?></td>
                                                    <td><?php 
                                                    
                                                    echo $row['course_outline'];?></td>
                                                    <td> <a href="review_list_student.php?page_id=<?php echo $ast_id;?>&&daily_lecture_id=<?php echo $row['id'];?>"class="btn btn-info">
                                                        Details Review
                                                     </a></td>
                                                </tr>

                                                    <?php } } ?>
                                                </tbody>
                                            </table>
                                        </div>
                              </div>
                          </div> </div>
                                       
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
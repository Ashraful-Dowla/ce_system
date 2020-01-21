
<?php include('../includes/db/connection_db.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
        <?php include('../includes/head_link.php');?>

</head>

<style>
.rating-container.rating-xs.rating-animate.rating-disabled{
    display: inline-flex;
}
</style>
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
                                    if (isset($_GET['daily_lecture_id'])) {
                                      $daily_lecture_id = $_GET['daily_lecture_id'];
                                    }
                                  
                                  $details = "SELECT
                                  daily_class_lecture.class_no as class,
                                  teacher.name as teacher_name,
                                  subject.subject_name as subject
                                  FROM `assign_teacher`
                                  left join assign_class on assign_class.assign_teacher_id=assign_teacher.id
                                  left join teacher on assign_teacher.teacher_id = teacher.teacher_id
                                  left join subject on assign_teacher.subject_id= subject.id
                                  left join daily_class_lecture
                                  on assign_class.id=daily_class_lecture.assign_class_id
                                  where daily_class_lecture.id = $daily_lecture_id";
  
                                  $t_result = $conn->query($details);
  
                                  if ($t_result->num_rows > 0){
  
                                      $data = $t_result->fetch_object();

                                      $class_no = $data->class;
  
                                      echo '<h4 class="pull-left">Daily Course Lecture of <ins>'.$data->subject.'</ins> Taken by <ins> '.$data->teacher_name.'</ins>  Class <ins>'.$class_no.' </ins> </h4>';
                                  
                                  }
                                  
                                ?>
                             
                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->

                        <a class="btn btn-info" href="<?=$base?>/review/subject_wise_class_list.php?id=<?=$_GET['page_id'];?>">Back</a>
                        <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-card margin-b-30 m-4">
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
                                                        <th width='15%'> Student ID </th>
                                                        <th> Name </th>
                                                        <th width='25%'> Rating </th>
                                                        <th> Review Details </th>
                                                    </tr>
                                                </thead>
                                               
                                                <tbody>
                                                     
                                                <?php 
                                                
                                                
                                                $sql = "SELECT 
                                                class_review.student_id as student_id,
                                                class_review.comment as review,
                                                class_review.rating as rating,
                                                student.name as student_name
                                                from daily_class_lecture as dcl
                                                join class_review
                                                on class_review.daily_class_lecture_id = dcl.id
                                                join student
                                                on student.student_id=class_review.student_id
                                                where dcl.id=$daily_lecture_id";

                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) { ?>
                                                    <tr>
                                                        <td><?php echo $row['student_id'];?></td>
                                                        <td><?php echo $row['student_name'];?></td>
                                                        <td>
                                                        <?php if($row['rating'] != ''): ?>
                                                        <input required class="review_star" name="rating" value="<?=$row['rating']?>" type="text" title="" disabled>
                                                        <?php endif; ?>
                                                        <?php echo $row['rating'];?>
                                                        </td>
                                                        <td><?php echo $row['review'];?></td>
                                                    </tr>
                                                    <?php } 
                                                    }
                                                    else { ?>
                                                    <tr>
                                                        <td colspan="3"><h6 style='text-align:center;font-weight:bold'>NO REVIEW DATA</h6></td>
                                                        <td style="display: none;"></td>
                                                        <td style="display: none;"></td>   
                                                    </tr>
                                                   <?php  }   
                                                    ?>
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
          $(".review_star").rating({
            'size' : 'xs',
            'showCaption': false,
            'showClear': false
        });
          </script>

    </body>
</html>
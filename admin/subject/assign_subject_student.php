

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
                                        <h4 class="pull-left">Assign Subjects for Student</h4>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-card recent-activites">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                       Requested Subject List from Students
                                    </div>
                                    <div class="panel-body">
                                    <div><?php
                                        if(isset($_SESSION['alert'])){
                                            echo '<div class="alert alert-'.$_SESSION['alert_type'].' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['alert'].'</div>';
                                            unset($_SESSION['alert']);
                                            }
                                        ?></div>
                                        <div class="table-responsive">
                                            <table id="basic-datatables" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Student ID</th>
                                                        <th>Student Name</th>
                                                        <th>Student Semester</th>
                                                        <th>Req. Subject ID </th>
                                                        <th>Req. Subject Name</th>
                                                        <th>Request Status </th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                               
                                                <tbody>
                                                     
                                                <?php 
                                                $sql = "SELECT subject.*,
                                                assign_subject_student.id as asn_id,
                                                assign_subject_student.student_id as student_id,
                                                student.name as student,
                                                semester.semester_name as semester,
                                                assign_subject_student.request_status as status
                                                from subject 
                                                inner join assign_subject_student 
                                                on subject.id=assign_subject_student.subject_id
                                                inner join student 
                                                on student.student_id = assign_subject_student.student_id
                                                inner join registration 
                                                on registration.member_id=assign_subject_student.student_id
                                                inner join semester
                                                on semester.id = registration.semester
                                                where subject.status = 1";

                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) { ?>

                                                <tr>
                                                
                                                    <td><?php echo $row['student_id'];?></td>
                                                    <td><?php echo $row['student'];?></td>
                                                    <td><?php echo $row['semester'];?></td>
                                                    
                                                    <td><?php echo $row['subject_id'];?></td>
                                                   
                                                    <td><?php echo $row['subject_name'];?></td>

                                                    <td>
                                                    <?=$row['status'] == 0 ? '<span class="text-info font-weight-bold"><strong>Pending</strong></span>': ($row['status'] == 1 ? '<span class="text-success"><strong>Accepted</strong></span>' : '<span class="text-danger"><strong>Rejected</strong></span>' ) ?>
                                                    </td>
                                                         

                                                    <td class="text-center">
                                                        <a onclick="return confirm('Are you sure want to accept??')" href="<?=$base?>/sql/update_sql.php?update=subject_assign_student&&id=<?php echo $row['asn_id']?>" 
                                                        class="btn btn-success" data-toggle="tooltip" title="" data-original-title="Accept Request" >
                                                        Accept
                                                        </a>
                                                        <a onclick="return confirm('Are you sure want to reject??')" href="<?=$base?>/sql/delete_sql.php?delete=reject_request_subject&&id=<?php echo $row['asn_id']?>" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Cancel Request">
                                                           Reject
                                                        </a>
                                                        
                                                    </td>
                                                </tr>

                                                    <?php } } ?>


                                                </tbody>
                                               
                                            </table>
                                        </div>
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
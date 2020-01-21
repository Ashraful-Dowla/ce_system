

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
                                        <h4 class="pull-left">Request For Subject</h4>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->
                        
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                      Select Your Subject
                                    </div>
                                    <div class="panel-body">
                                    <div><?php
                                        $member_id = $_SESSION['member_id'];
                                        if(isset($_SESSION['alert'])){
                                            echo '<div class="alert alert-'.$_SESSION['alert_type'].' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['alert'].'</div>';
                                            unset($_SESSION['alert']);
                                            }
                                        ?></div>
                                        <!-- form -->
                                    <form class="form-horizontal" method="post" action="<?=$base?>/sql/insert_sql.php">
                                        <div class="form-group">
                                        <input type="hidden" name="student_id" value="<?=$member_id?>">
                                            <label class="col-lg-3 control-label">Subjects</label>
                                            <div class="col-lg-9">
                                                <select class="form-control form-control-sm" name="subject">
                                                    <option>Select Subject</option>
                                                    <?php
                                                    $sql = "SELECT * from subject where status = 1 and semester != (SELECT semester from registration where member_id = '$member_id')";
                                                    $query = $conn->query($sql);
                                                    $row = $query->num_rows;
                                                    if ($row > 0) {
                                                        while ($data = $query->fetch_assoc()){
                                                            $id = $data['id'];
                                                            $name = $data['subject_name'];
                                                            echo "<option value=$id>$name</option>";
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                            <div class="form-group">
                                                <div class="col-lg-offset-3 col-lg-9">
                                                    <input type="submit" class="btn btn-sm btn-primary" name="request_subject" value="submit">
                                               
                                                </div>
                                            </div>


                                           
                                        </form>
                                        <!-- form -->

                                    </div> 
                                </div>
                                <div class="panel panel-card recent-activites">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                       Your Requested Subject List
                                    </div>
                                    <div class="panel-body">
                                        <div class="table-responsive">
                                            <table id="basic-datatables" class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th> Subject ID </th>
                                                        <th> Subject Name</th>
                                                        <th> Request Status </th>
                                                        <th> Action</th>
                                                    </tr>
                                                </thead>
                                               
                                                <tbody>
                                                     
                                                <?php 
                                                $sql = "SELECT subject.*,assign_subject_student.id as asn_id,
                                                assign_subject_student.request_status as status
                                                from 
                                                subject 
                                                left join assign_subject_student 
                                                on subject.id=assign_subject_student.subject_id
                                                where subject.status = 1
                                                and assign_subject_student.student_id = '$member_id'
                                                ";

                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) { ?>

                                                <tr>
                                                    <td><?php echo $row['subject_id'];?></td>
                                                   
                                                    <td><?php echo $row['subject_name'];?></td>

                                                    <td>
                                                    <?=$row['status'] == 0 ? '<span class="text-info font-weight-bold"><strong>Pending</strong></span>': ($row['status'] == 1 ? '<span class="text-success"><strong>Accepted</strong></span>' : '<span class="text-danger"><strong>Rejected</strong></span>' ) ?>
                                                    </td>
                                                         

                                                    <td class="text-center">
                                                    <?php if ($row['status'] == 0) : ?>
                                                        <a href="subject_request_edit.php?id=<?php echo $row['asn_id']?>&&sub_id=<?=$row['id']?>"class="btn btn-success">
                                                        <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a onclick="return confirm('Are you sure want to cancel')" href="<?=$base?>/sql/delete_sql.php?delete=cancel_request_subject&&id=<?php echo $row['id']?>" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Cancel Request">
                                                            <i class="fa fa-trash-o"></i>
                                                        </a>
                                                    <?php 
                                                    else : echo '--';
                                                    endif;?>
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
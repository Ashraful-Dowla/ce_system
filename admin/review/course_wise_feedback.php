
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
                                        <h4 class="pull-left">Course Wise Feedback</h4>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->
                        
                        <div class="row">
                            <div class="col-md-12">

                                <div class="panel panel-card recent-activites">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                    Course List
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
                                                        <th> ID </th>
                                                        <th> Assign Class ID </th>
                                                        <th> Teacher ID </th>
                                                        <th> Course Outline </th>
                                                        <th> Class No. </th>
                                                        <th> Status </th>
                                                        <th> Rating </th>
                                                    </tr>
                                                </thead>
                                               
                                                <tbody>
                                                     
                                                <?php 
                                                $dt = new DateTime();
                                                $dtt = $dt->format('y-m-d');

                                                $sql = "
                                                SELECT*
                                                FROM daily_class_lecture
                                                WHERE DATE(created_at)='$dtt'
                                                ";

                                                $result = $conn->query($sql);

                                                $inc = 0;

                                                if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) { ?>

                                                <tr>
                                                    <td><?php echo $inc+=1;?></td>
                                                    <td><?php echo $row['assign_class_id'];?></td>
                

                                                    <?php 
                                                        $val = $row['id'];
                                                        $sql2 = "
                                                        SELECT rating, teacher_id
                                                        FROM class_review
                                                        WHERE daily_class_lecture_id = '$val'
                                                        ";

                                                        $result2 = $conn->query($sql2);
                                                        $number_of_rows = $result2->num_rows;
                                                        $sum_of_rating = 0;

                                                        $teacher_id = "";

                                                        while($row2 = $result2->fetch_assoc()){
                                                            $sum_of_rating += $row2['rating'];
                                                            $teacher_id = $row2['teacher_id'];
                                                        }

                                                        if($number_of_rows == 0){
                                                            $rating = 0;
                                                        }
                                                        else{
                                                            $rating = $sum_of_rating/($number_of_rows*5);
                                                        }


                                                     ?>
                                                    <td><?php echo $teacher_id;?></td>
                                                    <td><?php echo $row['course_outline'];?></td>
                                                    <td><?php echo $row['class_no'];?></td>
                                                    <td><?php echo $row['status'];?></td>
                                                    <td><meter value="<?php echo $rating; ?>"></meter></td>
                                                </tr>

                                                <?php } } ?>


                                                </tbody>
                                               
                                            </table>
                                        </div>
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
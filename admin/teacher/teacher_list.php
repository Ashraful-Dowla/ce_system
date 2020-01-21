
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
                            <!-- <h4 class="pull-left">Data Tables</h4> -->
                        </div>
                    </div>
                </div>
            </div><!-- end .page title-->
            <a href="add_teacher.php" class="btn btn-primary">Add Teacher</a>
            <div class="row">
                <div class="col-md-12">

                    <div class="panel panel-card recent-activites">
                        <!-- Start .panel -->
                        <div class="panel-heading">
                            Teachers List
                        </div>
                        <div class="panel-body">

                        <div><?php
                            //if(isset($_SESSION['alert'])){
                                //echo '<div class="alert alert-'.$_SESSION['alert_type'].' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['alert'].'</div>';
                                //unset($_SESSION['alert']);
                                
                            ?></div>
                            <div class="table-responsive">
                                <table id="basic-datatables" class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th> Teacher ID</th>
                                            <th> Teacher Name</th>
                                            <th> Department</th>
                                            <th> E-mail</th>
                                            <th> Validation </th>
                                            <th> Avg Rating</th>
                                            <th> Activate </th>
                                            <th> Action </th>
                                        </tr>
                                    </thead>
                                
                                    <tbody>

                                    <?php 
                                    $sql = "SELECT 
                                    department.department_name as dept,
                                    registration.member_id as member_id,
                                    registration.name,
                                    registration.email,
                                    registration.authentication as status,
                                    (Select avg(rating) from class_review where teacher_id=member_id) as rating
                                    from  
                                    registration left join 
                                    teacher 
                                    on teacher.teacher_id=registration.member_id 
                                    left join 
                                    login on 
                                    login.id=registration.login_id
                                    left join 
                                    department on
                                    registration.department = department.id
                                    where registration.authentication != 2 
                                    and login.user_type=2";

                                    $result = $conn->query($sql);

                                    if ($result->num_rows > 0) {
                                    while($row = $result->fetch_assoc()) { ?>

                                    <tr>
                                        <td><?php echo $row['member_id'];?></td>
                                        <td><?php echo $row['name'];?></td>
                                        <td><?php echo $row['dept'];?></td>
                                        <td><?php echo $row['email'];?></td>
                                        
                                        <td>
                                            <?php
                                            if ($row['status'] == 1) {
                                                $status = 'Authenticated Account';
                                                $status_table = "<a onclick=\"return confirm('Are you sure want to deactivate?')\" href='".$base."/sql/update_sql.php?status=".$row['status']."&&id=".$row['member_id']."&&type=2' class='btn btn-info'>
                                                Deactivate
                                                </a>";
                                                $reject="";
                                            }
                                            elseif ($row['status'] == 0) {
                                                $status = 'Pending';
                                                $status_table = "<a onclick=\"return confirm('Are you sure want to activate?')\" href='".$base."/sql/update_sql.php?status=".$row['status']."&&id=".$row['member_id']."&&type=2' class='btn btn-success'>
                                                Active
                                                </a>";
                                                $reject="<a onclick=\"return confirm('Are you sure want to reject this user?')\" href='".$base."/sql/update_sql.php?status=2&&id=".$row['member_id']."&&type=2' class='btn btn-danger'>
                                                Reject
                                                </a>";
                                            }
                                            elseif($row['status'] == 2){
                                                $status = 'Rejected';
                                                $reject = '--';
                                                $status_table = '';
                                            }

                                            echo "$status";
                                            
                                            

                                            ?>
                                        </td>
                                        <td><?=$row['rating']!= '' ? $row['rating'] : '---';?></td>
                                        <td><?=$status_table?>
                                        <?=$reject?>
                                        </td>
                                                

                                        <td class="text-center">
                                            
                                            <a href="update_teacher.php?id=<?php echo $row['member_id']?>"class="btn btn-success">
                                                Details
                                            </a>
                                            <!-- <a onclick="return confirm('Are you sure want to delete')" href="<?=$base?>/sql/delete_sql.php?delete=delete_teacher&&id=</?php echo $row['member_id']?>" data-toggle="tooltip" title="" class="btn btn-danger" data-original-title="Delete">
                                                Delete
                                            </a> -->
                                        </td>
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
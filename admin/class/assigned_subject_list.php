
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
                                        <h4 class="pull-left"></h4>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->
                        
                        <div class="row">
                            <div class="col-md-12">

                                <div class="panel panel-card recent-activites">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                      Assigned Class Numbers
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
                                                        <th> Subject Name </th>
                                                        <th> Session </th>
                                                        <th width='7%'> Section </th>
                                                        <th width='10%'> No of class </th>
                                                        <th width='32%'> Assign/Reject Class </th>
                                                        <th width='20%'>Add Course Outline </th>
                                                        <!-- <th> Action </th> -->
                                                    </tr>
                                                </thead>
                                               
                                                <tbody>
                                                     
                                                <?php 
                                                if(isset($_SESSION['member_id'])){

                                                $id = $_SESSION['member_id'];
                                                
                                                $sql = "SELECT 
                                                a_class.number_of_class as number_of_class,
                                                a_class.id as a_class_id,
                                                ast.id as id,
                                                ast.status as ast_status,
                                                teacher.name as name,
                                                section.section_name as section,
                                                session.session_name as session,
                                                session.year as s_year,
                                                subject.subject_name as subject
                                                from assign_teacher as ast
                                                left join session 
                                                on ast.session_id=session.id
                                                left join assign_class as a_class
                                                on a_class.assign_teacher_id = ast.id
                                                left join section
                                                on ast.section_id=section.id
                                                left join teacher 
                                                on teacher.teacher_id=ast.teacher_id
                                                left join subject
                                                on subject.id=ast.subject_id
                                                where ast.teacher_id = '$id'
                                                and ast.status!=0 order by a_class.number_of_class is not NULL desc";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) { ?>

                                                <tr>
                                                    <td><?php echo $row['subject'];?></td>
                                                    
                                                    <td><?php echo $row['s_year']."(".$row['session'].")";?></td>
                                                    <td class="text-center"><?php echo $row['section'];?></td>
                                                    <td class="text-center"><?php echo $row['number_of_class'] == '' ?'<h5 class="text-center">--</h5>' : $row['number_of_class'] ;?></td>
                                                    
                                                    
                                                    <td>
                                                    <?php if($row['ast_status'] == 1) : ?>
                                                        <a onclick="return confirm('Are you sure want to cancel?')" href="<?=$base?>/sql/update_sql.php?class_status=cancel&&id=<?php echo $row['id']?>"class="btn btn-danger">
                                                        Cancel this subject
                                                        </a>
                                                       
                                                        
                                                        <a onclick="return confirm('You will take this class?')" href="<?=$base?>/sql/update_sql.php?class_status=accept&&id=<?php echo $row['id']?>"class="btn btn-info">
                                                        Accept
                                                        </a>
                                                    

                                                    <?php elseif($row['ast_status'] == 2) : ?>

                                                        <a href="assign_class.php?id=<?php echo $row['id']?>"class="btn btn-success">
                                                        Assign No. Of Class
                                                        </a>

                                                        <?php if($row['number_of_class'] != '') : ?>
                                                            <a href="update_class.php?id=<?php echo $row['a_class_id']?>"class="btn btn-info">
                                                            Update No. Of Class
                                                            </a>
                                                        <?php endif;?>
                                                    <?php endif;?>

                                                    </td>

                                              

                                                    <?php if($row['number_of_class'] == '') : ?>

                                                    <td class="text-center"> <h5>--</h5> </td>

                                                    <?php else: ?>
                                                    <!-- <td>    
                                                        
                                                    </td> -->
                                                    <td> 
                                                        <a href="<?=$base?>/course_outline/assign_course_outline.php?id=<?php echo $row['a_class_id']?>"class="btn btn-info">
                                                          Assign Course Outline
                                                        </a>
                                                    </td>
                                                    <?php endif;?>
                                                    

                                                    
                                                    <!-- <td class="text-center">
                                                       
                                                    </td> -->
                                                </tr>

                                                    <?php } } }?>
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
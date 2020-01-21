
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
                                if (isset($_GET['ast_id'])){
                                    $ast_id = $_GET['ast_id'];
                                }

                                if (isset($_SESSION['member_id'])) {
                                    $student_id = $_SESSION['member_id'];
                                }
                                
                                $details = "SELECT
                                teacher.id as t_id,
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
                                    
                                    $t_id = $data->t_id;
                                    echo '<h4 class="pull-left">Daily Course Lecture of <ins>'.$data->subject.'</ins> Taken by <ins> '.$data->teacher_name.' </ins></h4>';
                                
                                }

                                else{
                                    echo '<h4 class="pull-left">Class Lecture not assigned yet!!</h4>';
                                }



                                ?>

                            </div>
                        </div>
                    </div>
                </div><!-- end .page title-->
                

                <a class="btn btn-info" href="<?=$base?>/student/subject_list.php">Back</a>
                <div class="row">
                    <div class="col-md-10 col-md-offset-1"><div class="panel panel-card margin-b-30 m-4">
                            <div class="panel-heading">
                              <h5>CLASS OUTLINE LIST (Daily)</h5>
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
                                            <th width='80px'> Class No </th>
                                            <th> Topic </th>
                                            <th width='120px'> Rating </th>
                                            <th width='270px'> Your Review </th>
                                            <th width='230px'> Add Review </th>

                                        </tr>
                                        </thead>

                                        <tbody>

                                        <?php
                                        
                                        $sql = "SELECT
                                            -- class_review.id as class_review_id,
                                            -- class_review.comment as comment,
                                            -- class_review.rating as rating,
                                            daily_class_lecture.class_no as class_no,
                                            daily_class_lecture.id as daily_class_lecture_id,
                                            daily_class_lecture.course_outline as course_outline,
                                            (SELECT rating from class_review where daily_class_lecture_id=daily_class_lecture.id and student_id ='$student_id') as rating,
                                            (SELECT comment from class_review where daily_class_lecture_id=daily_class_lecture.id and student_id ='$student_id') as comment,
                                            (SELECT id from class_review where daily_class_lecture_id=daily_class_lecture.id and student_id ='$student_id') as class_review_id
                                            FROM `assign_teacher` 
                                            left join assign_class on assign_class.assign_teacher_id=assign_teacher.id
                                            left join daily_class_lecture on daily_class_lecture.assign_class_id = assign_class.id
                                            -- left join class_review on 
                                            -- daily_class_lecture.id = class_review.daily_class_lecture_id


                                            where assign_class.assign_teacher_id = $ast_id
                                            "
                                            ;

                                        $result = $conn->query($sql);

                                        if ($result->num_rows > 0) {
                                            while($row = $result->fetch_assoc()) { 

                                            ?>
                                            <tr>
                                                <td><?php echo "Class ".$row['class_no'];?></td>
                                                
                                                <td>
                                                
                                                    <?php
                                                    echo substr($row['course_outline'], 0, 10)."....";?>
                                                    
                                                    </td>
                                                    
                                                    <td>
                                                    
                                                    <?php
                                                    echo $row['rating'] != '' ? $row['rating'] : '--' ;?>
                                                    
                                                    <?php if($row['rating'] != ''): ?>

                                                    <input required class="review_star" name="rating" value="<?=$row['rating']?>" type="text" title="" disabled>

                                                    <?php endif; ?>
                                                    
                                                    </td>
                                                    
                                                    <td><?php
                                                    echo $row['comment'] != '' ? substr($row['comment'], 0, 50)."...." : '-Not Reviewed Yet-' ;?></td>
                                                    <td>

                                                    
                                                    <?php if ($row['class_review_id'] == '') : ?>
                                                    <a href="add_new_review.php?ast_id=<?=$ast_id?>&&id=<?php echo $row['daily_class_lecture_id']?>&&t_id=<?=$t_id?>"class="btn btn-info">
                                                        Add Review
                                                    </a>
                                                    
                                                    <?php elseif($row['class_review_id'] != '') : ?>

                                                        <a href="update_review.php?ast_id=<?=$ast_id?>&&id=<?php echo $row['daily_class_lecture_id']?>&&edit_id=<?php echo $row['class_review_id']?>&&t_id=<?=$t_id?>"class="btn btn-danger">
                                                        Edit Review
                                                    </a>

                                                    <?php endif; ?>
                                                    </td>
                                            </tr>
                                            <?php } }
                                            else{
                                                
                                            }
                                            
                                            
                                            ?>
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
    $(".review_star").rating({
        'size' : 'xs',
        'showCaption': false,
        'showClear': false
    });
</script>

</body>
</html>
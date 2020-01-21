
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
                                        <h4 class="pull-left">Add Review</h4>
                                    </div>
                                </div>
                                <?php 
                                if(isset($_GET['ast_id'])){
                                    $_SESSION['ast_id'] = $_GET['ast_id'];
                                }
                                ?>
                                <a class="btn btn-info" href="daily_class_review.php?ast_id=<?php echo $_SESSION['ast_id']?>">Go back</a> 
                            </div>
                        </div><!-- end .page title-->
                        
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->

                                    
                                    <div class="panel-heading">
                                      Edit Review Form
                                    </div>
                                    <div class="panel-body">
                                    
                                    <div><?php
                                    if(isset($_SESSION['alert'])){
                                    echo '<div class="alert alert-'.$_SESSION['alert_type'].' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['alert'].'</div>';
                                    unset($_SESSION['alert']);
                                    }
                                    ?></div>
                                        <!-- form -->
                                    <form class="form-horizontal" method="post" action="<?=$base?>/sql/update_sql.php">
                                    <?php 

                                                if(isset($_GET['id'])){

                                                    $class_no_id = $_GET['id'];

                                                }
                                                if (isset($_SESSION['member_id'])) {
                                                    $student_id = $_SESSION['member_id'];
                                                }
                                                

                                            
                                                $sql = "SELECT 
                                                class_review.comment as comment,
                                                class_review.teacher_id as t_id,
                                                class_review.rating as rating,
                                                daily_class_lecture.id as daily_class_lecture_id,class_no, course_outline,
                                                section.section_name as section,
                                                session.session_name as session,
                                                session.year as s_year,
                                                subject.subject_name as subject
                                                from daily_class_lecture
                                                inner join assign_class
                                                on assign_class.id=daily_class_lecture.assign_class_id
                                                inner join assign_teacher as ast
                                                on ast.id = assign_class.assign_teacher_id
                                                inner join subject
                                                on subject.id=ast.subject_id
                                                inner join session 
                                                on ast.session_id=session.id
                                                inner join section
                                                on ast.section_id=section.id
                                                inner join class_review 
                                                on class_review.daily_class_lecture_id=daily_class_lecture.id
                                                where daily_class_lecture.id = $class_no_id and daily_class_lecture.status = 1 and
                                                class_review.student_id = '$student_id'
                                                ";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                while($data = $result->fetch_assoc()) { 

                                                 $section=$data['section'];
                                                 $teacher_id=$data['t_id'];
                                                 $session=$data['session'];
                                                 $s_year=$data['s_year'];
                                                 $subject=$data['subject']; 
                                                 $course_outline=$data['course_outline']; 
                                                 $class_no=$data['class_no']; 
                                                 $comment=$data['comment']; 
                                                 $rating=$data['rating']; 
                                                    
                                                 $daily_class_lecture_id=$data['daily_class_lecture_id'];
                                                    
                                                    
                                                ?>

                                                <input type="hidden" name="daily_class_lecture_id" value="<?=$daily_class_lecture_id?>">

                                                <input type="hidden" name="page_id" value="<?=$_GET['ast_id']?>">

                                                <input type="hidden" name="edit_id" value="<?=$_GET['edit_id']?>">

                                                <input type="hidden" name="student_id" value="<?=$_SESSION['member_id']?>">

                                                
                                                <div class="form-group">
                                                <label class="col-lg-3 control-label">Session
                                                </label>
                                                <div class="col-lg-9">
                                                <?php echo $s_year." (".$session.")";?>
                                                </div>
                                                </div>

                                                <div class="form-group">
                                                <label class="col-lg-3 control-label">Class No.
                                                </label>
                                                <div class="col-lg-9">
                                                <?php echo $class_no;?>
                                                </div>
                                                </div>

                                                
                                                <div class="form-group">
                                                <label class="col-lg-3 control-label">Section Name
                                                </label>
                                        
                                                <div class="col-lg-9">

                                                <?=$section;?>
                                                <!-- <input type="text" name="session" placeholder="Class Name" class="form-control">  -->
                                                </div>
                                                </div>
                                                <div class="form-group">
                                                <label class="col-lg-3 control-label">Class topic
                                                </label>

                                                <div class="col-lg-9">
                                                <textarea name="course_outline" id="" rows="5" readonly class="form-control"><?php echo $course_outline;?></textarea>
                                                </div>
                                                </div>

                                                <div class="form-group">
                                                <label class="col-lg-3 control-label">Rating
                                                </label>

                                                <div class="col-lg-9">
                                                <input required id="review_star" name="rating" value="<?=$rating?>" type="text" title="">
                                                </div>
                                                </div>

                                                <div class="form-group">
                                                <label class="col-lg-3 control-label">Review
                                                </label>
                                                <div class="col-lg-9">
                                                <textarea name="comment" id="" rows="5" required class="form-control" placeholder="Enter your review"><?=$comment?></textarea>
                                                </div>
                                                </div>


                                                <div class="form-group">
                                                <div class="col-lg-offset-3 col-lg-9">
                                                    <input type="submit" class="btn btn-sm btn-primary" name="update_review" value="submit">
                                                </div>
                                            </div>

                                                    <?php } } ?>
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

          <script>
          $('.select2').select2();
          $("#review_star").rating();

          CKEDITOR.replace( 'course_outline' );
          CKEDITOR.replace( 'comment' );
          </script>

    </body>
</html>
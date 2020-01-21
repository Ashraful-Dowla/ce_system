
<?php include('../includes/db/connection_db.php');?>

<!DOCTYPE html>
<html lang="en">
<head>
        <?php include('../includes/head_link.php');?>

    </head>
    <style>
      .class-layout{
        width:100%;
        font-size: 15px;
      }
      .class-layout tr,
      .class-layout tbody th,
      .class-layout td{
        padding: 12px;
        border:1px solid rgba(0, 0, 0, 0.2)
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
                                        <h4 class="pull-left">Add Class</h4>
                                    </div>
                                </div>
                                <?php 
                                if(isset($_GET['page_id'])){
                                    $_SESSION['page_id'] = $_GET['page_id'];
                                }
                                ?>
                                <a class="btn btn-info" href="course_outline_list.php?id=<?php echo $_SESSION['page_id']?>">Go back</a> 
                            </div>
                        </div><!-- end .page title-->
                        
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->

                                    
                                    <div class="panel-heading">
                                      Class Outline
                                    </div>
                                    <div class="panel-body">
                                    
                                    <div>
                                    <table class='class-layout'>

                                      <thead>
                                        <tr>
                                          <th width=40%></th>
                                          <th></th>
                                        </tr>
                                      </thead>

                                      <tbody>
                                      
                                      <?php 

                                                if(isset($_GET['id'])){

                                                    $class_no_id = $_GET['id'];

                                                }
                                                $sql = "SELECT class_no, course_outline,
                                                section.section_name as section,
                                                session.session_name as session,
                                                session.year as s_year,
                                                subject.subject_name as subject
                                                from course_outline
                                                inner join assign_class
                                                on assign_class.id=course_outline.assign_class_id
                                                inner join assign_teacher as ast
                                                on ast.id = assign_class.assign_teacher_id
                                                inner join subject
                                                on subject.id=ast.subject_id
                                                inner join session 
                                                on ast.session_id=session.id
                                                inner join section
                                                on ast.section_id=section.id
                                                where course_outline.id = $class_no_id and course_outline.status = 1";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                while($data = $result->fetch_assoc()) { 

                                                 $section=$data['section'];
                                                 $session=$data['session'];
                                                 $s_year=$data['s_year'];
                                                 $subject=$data['subject']; 
                                                 $course_outline=$data['course_outline']; 
                                                 $class_no=$data['class_no']; 
                                                    
                                                //  $number_of_class=$data['number_of_class'];
                                                    
                                                    
                                                ?>

                                                <tr>
                                                  <th>Session</th>
                                                  <td><?php echo $s_year." (".$session.")";?></td>
                                                </tr>
                                                <tr>
                                                  <th>Class No</th>
                                                  <td><?php echo $class_no;?></td>
                                                </tr>
                                                <tr>
                                                  <th>Subject</th>
                                                  <td><?=$subject;?></td>
                                                </tr>
                                                <tr>
                                                  <th>Section</th>
                                                <td><?=$section;?></td>
                                                </tr>
                                                <tr>
                                                  <th>Outline</th>
                                                <td><?php echo $course_outline;?></td>
                                                </tr>
                                             

                                           


                                              

                                                    <?php } } ?>

                                                    </tbody>
                                    </table>
                                 
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
          CKEDITOR.replace( 'course_outline' );
          </script>

    </body>
</html>
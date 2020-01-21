
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
                                        <h4 class="pull-left">Assign Course Outline</h4>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->
                        
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2">
                                <div class="panel panel-card margin-b-30">
                                    <!-- Start .panel -->
                                    <div class="panel-heading">
                                      <h5>ASSIGN NEW CLASS OUTLINE (Daily)</h5>
                                    </div>
                                    <div class="panel-body">

                                    <div><?php
                                    if(isset($_SESSION['alert'])){
                                    echo '<div class="alert alert-'.$_SESSION['alert_type'].' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['alert'].'</div>';
                                    unset($_SESSION['alert']);
                                    }
                                    ?></div>
                                        <!-- form -->
                                    <form class="form-horizontal" method="post" action="<?=$base?>/sql/insert_sql.php">
                                    <?php 
                                    
                                          if(isset($_GET['id'])){

                                          $a_class_id = $_GET['id'];
                                          
                                          $sql = "SELECT teacher.name as name,
                                          a_class.number_of_class as number_of_class,
                                          a_class.id as a_class_id,
                                          -- c_outline.class_no as class_no,
                                          section.section_name as section,
                                          session.session_name as session,
                                          session.year as s_year,
                                          subject.subject_name as subject
                                          from assign_teacher as ast
                                          left join session 
                                          on ast.session_id=session.id
                                          left join section
                                          on ast.section_id=section.id
                                          left join assign_class as a_class
                                          on a_class.assign_teacher_id = ast.id
                                          left join teacher 
                                          on teacher.teacher_id=ast.teacher_id
                                          -- left join course_outline as c_outline
                                          -- on c_outline.assign_class_id=a_class.id
                                          left join subject
                                          on subject.id=ast.subject_id
                                          where a_class.id =$a_class_id";
                                          $query=$conn->query($sql);

                                          if($query->num_rows > 0) {
                                              while($data = $query->fetch_assoc()){
                                                //  $teacher_name=$data['name'];
                                                 $section=$data['section'];
                                                 $session=$data['session'];
                                                 $s_year=$data['s_year'];
                                                 $subject=$data['subject']; 
                                                 $number_of_class=$data['number_of_class'];
                                                //  $assigned_no_of_class=$data['class_no'];
                                                 
                                            ?>

                                            <input type="hidden" value="<?=$a_class_id?>" name="assign_class_id">
                                            
                                            <div class="form-group">
                                            <label class="col-lg-3 control-label">Session
                                            </label>
                                            <div class="col-lg-9">
                                            <?php echo $s_year." (".$session.")";?>
                                            </div>
                                            </div>
                                            <div class="form-group">
                                            <label class="col-lg-3 control-label">Subject Name
                                            </label>
                                            <div class="col-lg-9">
                                            <?=$subject;?> 
                                            
                                            <!-- <input type="text" name="session" placeholder="Class Name" class="form-control">  -->
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
                                            <label class="col-lg-3 control-label">No. Of class
                                            </label>

                                            <div class="col-lg-9">
                                            <!-- <input type="number"  name="total_class_number" placeholder="Enter total number of class" class="form-control">  -->
                                            <select name="number_of_class" class="form-control" id="">
                                              <?php 
                                              $sql2 = "SELECT class_no from daily_class_lecture where assign_class_id=$a_class_id and status = 1";

                                              $result2 = $conn->query($sql2);
                                              $options = '';
                                              // if class topic already added for some class
                                              if ($result2->num_rows > 0) {
                                              while($row2 = $result2->fetch_assoc()) {
                                                for ($i=1; $i <= $number_of_class ; $i++) { 
                                                  if ($row2['class_no'] != $i) {
                                                    $options .= '<option value="'.$i.'">Class '.$i.'</option>';
                                                  }
                                                  else{
                                                      $options ='';
                                                    }
                                                  }

                                                }
                                              }
                                              // if class topic not added at all
                                              else{
                                                for ($i=1; $i <= $number_of_class ; $i++) { 
                                                    $options .= '<option value="'.$i.'">Class '.$i.'</option>';
                                                    }
                                              }

                                              echo $options;
                                              
                                                
                                              ?>
                                            </select>
                                            </div>
                                            </div>
                                   

                                            <div class="form-group">
                                            <label class="col-lg-3 control-label">Class Outline
                                            </label>

                                            <div class="col-lg-9">
                                            <textarea name="course_outline" id="" rows="5" class="form-control"></textarea>
                                            </div>
                                            </div>
                                          
                                            <div class="form-group">
                                                <div class="col-lg-offset-3 col-lg-9">
                                                    <input type="submit" class="btn btn-sm btn-primary" name="add_course_outline_daily" value="submit">
                                                </div>
                                            </div>

                                            <?php   }
                                          }

                                        }

                                    
                                        ?>
                                        </form>
                                        <!-- form -->


                                        

                                    </div>

                                    
                                </div>
                            </div>
                        </div>

                        <div class="row">
                        <div class="col-md-10 col-md-offset-1"><div class="panel panel-card margin-b-30 m-4">
                              <div class="panel-heading">
                                      <h5>CLASS OUTLINE LIST (Daily)</h5>
                                    </div>
                              <div class="panel-body">
                              <div class="table-responsive">
                                            <table id="basic-datatables" class="table table-bordered" style="table-layout:fixed">
                                                <thead>
                                                    <tr>
                                                        <th> Class No. </th>
                                                        <th> Topic </th>
                                                        <th> Edit Topic </th>
                                                        
                                                    </tr>
                                                </thead>
                                               
                                                <tbody>
                                                     
                                                <?php 

                                                
                                                $sql = "SELECT id,class_no, course_outline
                                                from daily_class_lecture where assign_class_id = $a_class_id and status = 1";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) { ?>

                                                <tr>
                                                    
                                                    <td><?php echo "Class ".$row['class_no'];?></td>
                                                    <td><?php 
                                                    
                                                    echo substr($row['course_outline'], 0, 15)."....";?></td>
                                                    <td>  <a href="update_course_outline_daily.php?page_id=<?php echo $a_class_id;?>&&id=<?php echo $row['id'];?>"class="btn btn-info">
                                                        Edit
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

          CKEDITOR.replace( 'course_outline' );
          
          </script>

    </body>
</html>
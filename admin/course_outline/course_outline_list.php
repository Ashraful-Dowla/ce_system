
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
                                        <h4 class="pull-left">Course Outline</h4>
                                    </div>
                                </div>
                            </div>
                        </div><!-- end .page title-->
           

                        <div class="row">
                        <div class="col-md-10 col-md-offset-1"><div class="panel panel-card margin-b-30 m-4">
                              <div class="panel-heading">
                                      <h5>Class Outline List</h5>
                                    </div>
                              <div class="panel-body">
                              <div class="table-responsive">
                                            <table id="basic-datatables" class="table table-bordered" style="table-layout:fixed">
                                                <thead>
                                                    <tr>
                                                        <th> Class No. </th>
                                                        <th> Topic </th>
                                                        <th> View Details </th>
                                                        
                                                    </tr>
                                                </thead>
                                               
                                                <tbody>
                                                     
                                                <?php 
                                                  if(isset($_GET['id'])){

                                                  $a_class_id = $_GET['id'];
                                                 }
                                                                                                
                                                $sql = "SELECT id,class_no, course_outline
                                                from course_outline where assign_class_id = $a_class_id and status = 1";
                                                $result = $conn->query($sql);

                                                if ($result->num_rows > 0) {
                                                while($row = $result->fetch_assoc()) { ?>

                                                <tr>
                                                    
                                                    <td><?php echo "Class ".$row['class_no'];?></td>
                                                    <td><?php 
                                                    
                                                    echo substr($row['course_outline'], 0, 15)."....";?></td>
                                                    <td>  
                                                    
                                                    <a href="course_outline_details.php?page_id=<?php echo $a_class_id;?>&&id=<?php echo $row['id'];?>"class="btn btn-info">
                                                        View Details
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
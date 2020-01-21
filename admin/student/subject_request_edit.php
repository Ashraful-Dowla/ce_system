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
                  <h4 class="pull-left">Request For Subject Edit</h4>
                </div>
              </div>
            </div>
          </div><!-- end .page title-->
          <div><?php
                         $member_id = $_SESSION['member_id'];
                         $asn_id = $_GET['id'];
                         $sub_id = $_GET['sub_id'];
                         ?></div>


          <a class="btn btn-info" href="<?=$base?>/student/subject_request.php">Back</a>
          <div class="row">
            <div class="col-md-8 col-md-offset-2">
              <div class="panel panel-card margin-b-30">
                <!-- Start .panel -->
                <div class="panel-heading">
                  Select Your Subject
                </div>
                <div class="panel-body">

                  <?php 
                    if(isset($_SESSION['alert'])){
                        echo '<div class="alert alert-'.$_SESSION['alert_type'].' alert-dismissible"><a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>'.$_SESSION['alert'].'</div>';
                        unset($_SESSION['alert']);
                        }

                    ?>
                  <!-- form -->
                  <form class="form-horizontal" method="post" action="<?=$base?>/sql/update_sql.php">
                    <div class="form-group">

                      <input type="hidden" name="student_id" value="<?=$member_id?>">
                      <input type="hidden" name="prev_subject" value="<?=$sub_id?>">
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
                                    $selected = $id == $sub_id ? 'selected' : '';
                                    echo "<option value='$id' $selected>$name</option>";
                                }
                            }
                            ?>
                        </select>
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="col-lg-offset-3 col-lg-9">
                        <input type="submit" class="btn btn-sm btn-primary" name="request_subject_edit" value="submit">
                      </div>
                    </div>
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
  </script>

</body>

</html>

<head>
    <?php $base='http://localhost/ces/admin';?>
    
    <?php session_start();
    if (!isset($_SESSION['username']) &&  !isset($_SESSION['user_type'])) {
        $_SESSION['alert'] = "Cannot Enter without Login!!";
        header("Location: http://localhost/ces/login.php");
        exit;
    }
    ?>
        <meta charset="utf-8" />
        <title>Class Evolution System</title>
        <meta name="keywords" content="HTML5,CSS3,Admin Template"/>
        <meta name="description" content="" />
        <meta name="Author" content="Psd2allconversion [www.psd2allconversion.com]" />
        <!-- mobile settings -->
        <meta name="viewport" content="width=device-width, maximum-scale=1, initial-scale=1, user-scalable=0"/>
        <!-- WEB FONTS : use %7C instead of | (pipe) -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400%7CRaleway:300,400,500,600,700%7CLato:300,400,400italic,600,700" rel="stylesheet" type="text/css" />

        <!-- CORE CSS -->
        <!-- <link href="<?=$base?>/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" /> -->
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet" type="text/css" />
       
        <link href="<?=$base?>/assets/plugins/metis-menu/metisMenu.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$base?>/assets/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=$base?>/assets/plugins/simple-line-icons-master/css/simple-line-icons.css" rel="stylesheet" type="text/css" />
        <link href="<?=$base?>/assets/plugins/animate/animate.css" rel="stylesheet" type="text/css" />

        <link href="<?=$base?>/assets/plugins/select/select.css" type="text/css" rel="stylesheet">
        <link href="<?=$base?>/assets/plugins/c3/c3.min.css" rel="stylesheet">
        <link href="<?=$base?>/assets/plugins/widget/widget.css" rel="stylesheet">
        <!-- <link href="<?=$base?>/assets/plugins/calendar/fullcalendar.min.css" rel="stylesheet"> -->
        <!-- <link href="<?=$base?>/assets/plugins/ui/jquery-ui.css" rel="stylesheet"> -->
        <!-- <link rel="stylesheet" href="<?=$base?>/assets/plugins/toastr/toastr.min.css"/> -->
        <!-- THEME CSS -->
        <link href="<?=$base?>/assets/css/style.css" rel="stylesheet" type="text/css" /> 
        <link href="<?=$base?>/assets/css/theme/dark.css" rel="stylesheet" type="text/css" />
        <link href="<?=$base?>/assets/css/theme/dark.css" rel="stylesheet" type="text/css" />
        <!-- <link href="<?=$base?>/assets/css/jquery-ui.css" rel="stylesheet" type="text/css" /> -->
        <!-- <script src="js/jquery-1.9.1.js"></script> -->
        <!-- PAGE LEVEL SCRIPTS -->

        <link href="<?=$base?>/assets/css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>

        <!-- <script src="<?=$base?>/assets/ckeditor/ckeditor.js"></script> -->
          <style type="text/css">
            .validation_error {
                color:red;
            }
        </style
        

    </head>

    
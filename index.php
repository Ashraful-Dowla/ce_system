<!DOCTYPE html>
<html lang="en">

<title></title>

<head>
    <link rel="icon" type="image/png" href="<?=$baseurl?>assets/images/puc.png"/>
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg_img bg-color">
    <div class="main">

        <div class="container">
            <center>
                <div class="word_container">

                    <div class="content">
                        <h1>Class Evaluation System</h1>

                    </div>
                </div>
                <div class="middle">
                    <div id="div_button">
                        <form action="javascript:void(0);" method="get">
                            <button  class="btn-hover color-1">
                             <a href="registration.php" id="login_button"> Registration</a>
                            </button>
                            <button  class="btn-hover color-7">
                                <a href="login.php" id="login_button">Login</a>
                            </button>
                            <button class="btn-hover color-8" id="">Exit</button>
                            <div class="clearfix"></div>
                        </form>

                        <div class="clearfix"></div>

                    </div>
                    <!-- end login -->
                    <div class="logo">
                        <img src="assets/images/puc.png" alt="logo">
                        <div class="clearfix"></div>
                    </div>

                </div>
            </center>
        </div>

    </div>
    <?php include "includes/footer_link.php";?>
</body>

</html>
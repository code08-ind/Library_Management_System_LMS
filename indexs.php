<!DOCTYPE html>

<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Library Management System</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/225/225932.png" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="assets/css/style2.css">
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <!-- Default theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.min.css" integrity="sha512-IXuoq1aFd2wXs4NqGskwX2Vb+I8UJ+tGJEu/Dc0zwLNKeQ7CW3Sr6v0yU3z5OQWe3eScVIkER4J9L7byrgR/fA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Semantic UI theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/semantic.min.css"/>
    <!-- Bootstrap theme -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
</head>

<body>

<?php
    session_start();

    session_unset();
    session_destroy();

    // header("Location: indexs.php");

    $emailmsg="";
    $pasdmsg="";
    $msg="";

    $ademailmsg="";
    $adpasdmsg="";


    if(!empty($_REQUEST['ademailmsg'])){
        $ademailmsg=$_REQUEST['ademailmsg'];
    }

    if(!empty($_REQUEST['adpasdmsg'])){
        $adpasdmsg=$_REQUEST['adpasdmsg'];
    }

    if(!empty($_REQUEST['emailmsg'])){
        $emailmsg=$_REQUEST['emailmsg'];
    }

    if(!empty($_REQUEST['pasdmsg'])){
    $pasdmsg=$_REQUEST['pasdmsg'];
    }

    if(!empty($_REQUEST['msg'])){
        $msg=$_REQUEST['msg'];
    }

?>

<h1 class="text-center mt-5 text-white text-bold" style="font-weight:bold;">Library Management System (LMS)</h1>

    <div class="container login-container">
        <div class="row">
            <h4 class="text-center text-white" style="text-align: center;">
                <?php echo $msg?>
            </h4>
        </div>
        <div class="row">
            <div class="col-md-6 login-form-1">
                <h3>Student Login</h3>
                <form action="login_server_page.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="logins_email" placeholder="Enter Your Email"
                            value="" />
                            <span class="mt-2 ml-3">*</span>
                    </div>
                    <Label style="color:red">
                        <?php echo $emailmsg?>
                    </label>
                    <div class="form-group">
                        <input type="password" class="form-control" name="logins_password" placeholder="Enter Your Password"
                            value="" />
                            <span class="mt-2 ml-3">*</span>
                    </div>
                    <Label style="color:red">
                        <?php echo $pasdmsg?>
                    </label>
                    <div class="form-group">
                        <input type="submit" class="btnSubmit" id="submit1" value="Login" style="background-color: #16DF7E !important"/>
                    </div>
                </form>
            </div>
            <div class="col-md-6 login-form-2" style="background: #16DF7E !important;">
                <h3>Admin Login</h3>
                <form action="loginadmin_server_page.php" method="post">
                    <div class="form-group">
                        <input type="text" class="form-control" name="login_email" placeholder="Enter Your Email"
                            value="" />
                            <span class="mt-2 ml-3">*</span>
                    </div>
                    <Label style="color:red">
                        <?php echo $ademailmsg?>
                    </label>
                    <div class="form-group">
                        <input type="password" class="form-control" name="login_password" placeholder="Enter Your Password"
                            value="" />
                            <span class="mt-2 ml-3">*</span>
                    </div>
                    <Label style="color:red">
                        <?php echo $adpasdmsg?>
                    </label>
                    <div class="form-group">
                        <input type="submit" class="btnSubmit" value="Login" style="color: #16DF7E !important" id="submit"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <h5 class="text-center text-white" style="font-size: 25px; font-weight: bold;">Created By @Aryan Garg &copy;2022</h5>
    <div class="container onebtn">
        <a href="index.php">
            <button 
                style="color: rgb(255, 0, 93);
                border-radius: 30px;
                background-color: #fff;
                cursor: pointer;
                transition: all 0.4s ease-in-out;
                border: 3px solid rgb(255, 0, 93);
                padding:8px 30px;
                font-size:15px;"
            >
                Go To HomePage
            </button>
        </a>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js" integrity="sha512-JnjG+Wt53GspUQXQhc+c4j8SBERsgJAoHeehagKHlxQN+MtCCmFDghX9/AcbkkNRZptyZU4zC8utK59M5L45Iw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let submit = document.getElementById('submit');
        let submit1 = document.getElementById('submit1');
        submit.onclick = function() { 
            alertify.alert('Login', 'Admin Login Successfull!', function(){ alertify.success('Successfully Logined!');
            windlow.location('admin_server_dashboard.php'); });
            // alert("Admin Login Successfull!");
        }
        submit1.onclick = function() { 
            alertify.alert('Login', 'Student Login Successfull!', function(){ alertify.success('Successfully Logined!');
            windlow.location('admin_server_dashboard.php');
            });
            // alert("User Login Successfull!");
        }
    </script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
</body>
</html>
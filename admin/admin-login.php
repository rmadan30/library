<?php
    include "connection.php";
    include "navbar.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Login</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style class="text/css">
        <?php
            include "style.css";
        ?>
        section{
            margin: -20px;
        }
    </style>
</head>
<body>
    <!--
        <nav class="navbar navbar-inverse" style="width: 1536px;">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand active">ONLINE LIBRARY MANAGEMENT SYSTEM</a>
                </div>
                <ul class="nav navbar-nav">
                    <li><a href="index.php">HOME</a></li>
                    <li><a href="books.php">BOOKS</a></li>
                    <li><a href="registration.php">REGISTRATION</a></li>
                    <li><a href="feedback.php">FEEDBACK</a></li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    <li><a href="student-login.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
                    <li><a href="student-login.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></li>
                    <li><a href="registration.php"><span class="glyphicon glyphicon-user"> SIGN-UP</span></a></li>
                </ul>
            </div>
        </nav>


    <header style="height: 117px;">
        <div class="logo">
            
            <h1 style="color: white; font-size: 30px; line-height: 50px; margin-top: 35px; word-spacing: 5px;">ONLINE LIBRARY MANAGEMENT SYSTEM</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.html">HOME</a></li>
                <li><a href="">BOOKS</a></li>
                <li><a href="student-login.html">STUDENT-LOGIN</a></li>
                <li><a href="registration.html">REGISTRATION</a></li>
                <li><a href="">FEEDBACK</a></li>
            </ul>
        </nav>
    </header> !-->
    <section style="height: 720px; width: 1556px">
        <div class="log_img">
            <br>
            <div class="box1">
                <h1 style="text-align: center; font-size: 35px; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                    Library Management System
                </h1><br><br>
                
                <h1 style="text-align: center; font-size: 25px;">
                    USER LOGIN FORM
                </h1>

                <form name="login" action="" method="post">
                    <br><br>
                    <div class="login">
                        <input class="form-control" type="text" name="username" placeholder="Username" required=""><br>
                        <input class="form-control" type="password" name="password" placeholder="Password" required=""><br>
                        <input class="btn btn-default" type="submit" name="submit" value="Submit" style="color: black; width: 70px; height: 30px;">
                    </div>
                
                    <p style="font-size:15px; color: white; padding-left: 45px;">
                        <br><br>
                        <a style="font-size:15px; color: white; text-decoration: none;" href="update_password.php">Forgot Password?</a>&nbsp; &nbsp;
                        New to this Website? <a style="font-size:15px; color: white; text-decoration: none;" href="registration.php">Sign-Up</a>
                    </p>
                </form>
            </div>
        </div>
    </section>

    <?php
        
        if(isset($_POST['submit'])){
            $count=0;
            $result=mysqli_query($db,"SELECT * FROM `admin` WHERE username='$_POST[username]' && password='$_POST[password]';");
            $row= mysqli_fetch_assoc($result);
            $count=mysqli_num_rows($result);

            if($count==0){
    ?>
    <!-- <script text="text/javascript">
        alert('The username and password does not match.');
    </script> -->
    <div class="alert alert-danger" style="width: 400px; margin-left: 550px; text-align:center; margin-top:-150px; background-color:#de1313; color:white;">
        <strong>The username and password does not match. Log in Again!</strong>
    </div>
    <?php
            }
            //if username and password matches
            else{
                $_SESSION['login_user']= $_POST['username'];
                $_SESSION['pic']= $row['pic'];
                $_SESSION['username']='';
    ?>
    <script text="text/javascript">
        window.location="index.php";
    </script> 
    <?php
            }
        }
    ?>
</body>
</html>
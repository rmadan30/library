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
    <title> Student Registration</title>
    
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <style class="text/css">
        <?php
            include "style.css";
        ?>
        section{
            margin-top: -20px;
        }
        .box2{
            height: 630px;
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
    <style class="text/css">
        nav{
            float: right;
            word-spacing: 30px;
            padding: 20px;
        }
        
        nav li{
            display: inline-block;
            line-height: 80px;
        }
    </style>
</head>
<body>
    <header style="height: 117px;">
        <div class="logo">
            <h1 style="color: white; font-size: 30px; line-height: 50px; margin-top: 35px; word-spacing: 5px;">ONLINE LIBRARY MANAGEMENT SYSTEM</h1>
        </div>
        <nav>
            <ul>
                <li><a href="index.html">HOME</a></li>
                <li><a href="">BOOKS</a></li>
                <li><a href="student-login.html">STUDENT-LOGIN</a></li>
                <li><a href="">ADMIN-LOGIN</a></li>
                <li><a href="">FEEDBACK</a></li>
            </ul>
        </nav>
    </header>!-->
    <section style="height: 670px;">
        <div class="reg_img">
            <br>
            <div class="box2">
                <h1 style="text-align: center; font-size: 35px; font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;">
                    Library Management System
                </h1><br>
                
                <h1 style="text-align: center; font-size: 25px;">
                    USER REGISTRATION FORM
                </h1>
                <br>

                <form name="Registration" action="" method="post">
                    
                    <div class="reg">
                        <input class="form-control" type="text" name="firstname" placeholder="First Name" required=""><br>
                        <input class="form-control" type="text" name="lastname" placeholder="Last Name" required=""><br>
                        <input class="form-control" type="text" name="rollnumber" placeholder="Roll Number" required=""><br>
                        <input class="form-control" type="number" name="contact" placeholder="Contact Number" required=""><br>
                        <input class="form-control" type="email" name="email" placeholder="E-mail" required=""><br>
                        <input class="form-control" type="text" name="username" placeholder="Username" required=""><br>
                        <input class="form-control" type="password" name="password" placeholder="Password" required=""><br>
                        <input class="btn btn-default" type="submit" name="submit" value="Sign-Up" style="color: black; width: 70px; height: 27px; padding-left: 9px; padding-top: 3px;">

                    </div>
                </form>
            </div>
        </div>
    </section>

    <?php

        if(isset($_POST['submit'])){
            $count=0;
            $sql="SELECT username from student";
            $result= mysqli_query($db, $sql);

            //check the username with all the usernames already entered
            //variable row because we are checking every row
            while($row = mysqli_fetch_assoc($result)){
                if($row['username']==$_POST['username']){
                    $count=$count+1;
                }
            }
            if($count==0){
                mysqli_query($db,"INSERT INTO `student` VALUES('$_POST[firstname]','$_POST[lastname]','$_POST[rollnumber]','$_POST[contact]','$_POST[email]', '0' ,'$_POST[username]','$_POST[password]','user.jpg');");

                $otp= rand(10000,99999);
                $date=date("Y-m-d");
                mysqli_query($db, "INSERT INTO verify VALUES('$_POST[username]', '$otp', '$date' ) ;");
                $msg= "Hello your OTP code is: ".$otp." .";
                $from="From:khushisood2001@gmail.com";
                if(mail($_POST['email'] ,"OTP", $msg, $from))
                {
    ?>

        <script type="text/javascript">
            window.location="../verify.php";
        </script>
    <?php
                }
                else{
    ?>
                
        <script type="text/javascript">
            alert("Email not sent");
        </script>
                
    <?php

            }
        }
        else{
    ?>

    <script type="text/javascript">
        alert("Username already exists!");
    </script>

    <?php
            }
        }
    ?>
</body>
</html>
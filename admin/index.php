<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library Management System</title>
    
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> 

    <style type="text/css">
        <?php
            include "style.css";
        ?>
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
    <div class="wrapper">
        <header>
            <div class="logo">
                <img src="images/logo.png">
                <h3 style="color: white; font-size: 18px; margin-top: 0px; font-family: 'Times New Roman', Times, serif;">ONLINE LIBRARY MANAGEMENT SYSTEM</h3>
            </div>

            <?php
                /*if(session name has a value that means user has logged in then)*/
                if(isset($_SESSION['login_user'])){
            ?>
            <nav>
                <ul>
                    <li style="font-family: 'Times New Roman', Times, serif; font-size: 20px"><a href="index.php">HOME</a></li>
                    <li style="font-family: 'Times New Roman', Times, serif; font-size: 20px"><a href="books.php">BOOKS</a></li>
                    <li style="font-family: 'Times New Roman', Times, serif; font-size: 20px"><a href="logout.php">LOGOUT</a></li>
                    <li style="font-family: 'Times New Roman', Times, serif; font-size: 20px"><a href="feedback.php">FEEDBACK</a></li>
                </ul>
            </nav>
            <?php
                }
                else{
            ?>

            <nav>
                <ul>
                    <li style="font-family: 'Times New Roman', Times, serif; font-size: 20px"><a href="index.php">HOME</a></li>
                    <li style="font-family: 'Times New Roman', Times, serif; font-size: 20px"><a href="books.php">BOOKS</a></li>
                    <!-- <li style="font-family: 'Times New Roman', Times, serif; font-size: 20px"><a href="student-login.php">STUDENT-LOGIN</a></li> -->
                    <li style="font-family: 'Times New Roman', Times, serif; font-size: 20px"><a href="admin-login.php">LOGIN</a></li>
                    <li style="font-family: 'Times New Roman', Times, serif; font-size: 20px"><a href="registration.php">SIGN-UP</a></li>
                    <li style="font-family: 'Times New Roman', Times, serif; font-size: 20px"><a href="feedback.php">FEEDBACK</a></li>
                </ul>
            </nav>

            <?php
                }
            ?>
        </header>
        <section>
                <div class="sec_img">
                    <br>
                    <div class="box">
                        <br><br>
                        <h1 style="text-align: center; font-size: 35px;">WELCOME TO LIBRARY</h1><br><br><br><br>
                        <h1 style="text-align: center; font-size: 25px;">OPENS AT 7.00 a.m.</h1><br><br>
                        <h1 style="text-align: center; font-size: 25px;">CLOSES AT 8.00 p.m.</h1><br>
                    </div>
                </div>
        </section>
        <!-- <footer>
            <p style="color: orangered; text-align: center; padding: 0px;">
                <br>
                E-mail: &nbsp online.library@thapar.edu
                <br><br>
                Mobile: &nbsp +9170099*****
            </p>
        </footer> -->
    </div>
    <?php
        include "footer.php";
    ?>
</body>
</html>
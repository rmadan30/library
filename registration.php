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
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

    <style class="text/css">
        <?php
            include "style.css";
        ?>
        section{
            margin-top: -20px;
            height: 700px;
            width: 1536px;
            background-image: url(images/f.jpg);
            background-repeat: no-repeat;
        }

        .box{
            height: 300px;
            width: 450px;
            background-color: #000;
            margin: 0px auto;
            opacity: .8;
            color: white;
            padding: 20px;
            padding-top: 50px;
        }
        label{
            font-weight: 600;
            font-size: 20px;
            font-family: 'Times New Roman', Times, serif;
        }
    </style>
</head>
<body>
    <section><br><br><br><br><br><br><br>
        <div class="box">
            <form name="login" action="" method="post">        
                <br><br>
                &nbsp; <b><p style="font-family:'Times New Roman', Times, serif; padding-left: 50px; font-size: 22px; font-weight: 700;">Sign Up As: </p></b>
                <br>
                <input style="margin-left: 75px; width: 18px;" type="radio" name="user" id="admin" value="admin">
                <label for="admin">Admin</label>
                <input style="margin-left: 75px; width: 18px;" type="radio" name="user" id="student" value="student" checked="">
                <label for="student">Student</label>
                &nbsp;&nbsp;&nbsp;&nbsp;
                <div style="margin-top: 15px; text-align: center;">
                    <button class="btn btn-default" type="submit" name="submit1" style=" color: #000; font-weight: 700; width: 70px; height: 30px;">OK</button>
                </div>
            </form>
        </div>
        <?php
            if(isset($_POST['submit1'])){
                if($_POST['user']=='admin')
                {
        ?>
        <script text="text/javascript">
            window.location="admin/registration.php";
        </script> 
        <?php
                }
                else{
        ?>
        <script text="text/javascript">
            window.location="student/registration.php";
        </script> 
        <?php
                }
            }
        ?>
    </section>
</body>
</html>
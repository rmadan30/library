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
    <title>Change Password</title>
    <style type="text/css">
        body{
            height: 650px;
            background-image: url(images/password.jpeg);
        }
        .wrapper{
            width: 400px;
            height: 400px;
            background-color: black;
            opacity: .8;
            margin: 100px auto;
            color: white;
            padding: 27px 15px;
        }

        .form-control{
            width: 300px;
        }

        .form{
            padding-left: 30px;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div style="text-align: center;">
            <h1 style="text-align: center; font-size: 35px; font-family:Georgia, 'Times New Roman', Times, serif;">
                Change Your Password
            </h1><br><br>
        </div>
        <div class="form">
            <form action="" method="post">
                <input type="text" name="username" class="form-control" placeholder="Username" required=""><br>
                <input type="text" name="email" class="form-control" placeholder="E-mail" required=""><br>
                <input type="text" name="password" class="form-control" placeholder="Enter new password" required=""><br>
                <button class="btn btn-default" type="submit" name="submit">Update</button>
            </form>
        </div>
    </div>
    <?php
        if(isset($_POST['submit'])){
            if(mysqli_query($db,"UPDATE `admin` SET password='$_POST[password]' WHERE username='$_POST[username]' AND email= '$_POST[email]';")){
    ?>

    <script type="text/javascript">
        alert("Password updated successfully..!");
    </script>
    <?php
            }
        }
    ?>
</body>
</html>
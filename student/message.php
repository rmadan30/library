<?php
    include "navbar.php";
    include "connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MESSAGES</title>

    <style type="text/css">
        body{
            background-image: url("images/msg.png");

        }
        .wrapper{
            height: 600px;
            width: 500px;
            background-color: black;
            opacity: .9;
            color: white;
            margin: -20px auto;
            padding: 10px;
        }
        .form-control{
            height: 45px;
            width: 75%;
        }
        .msg{
            height: 450px;
            overflow-y: scroll;
        }
        .btn-info{
            background-color: #02c5b6;
        }
        .chat{
            display: flex;
            flex-flow: row wrap;
        }

        .user .chatbox{
            height: 50px;
            width: 400px;
            padding: 13px 10px;
            background-color: #821b69;
            color: white;
            border-radius: 10px;
            order: -1;
        }

        .admin .chatbox{
            height: 50px;
            width: 400px;
            padding: 13px 10px;
            background-color: #423471;
            color: white;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <?php
        if(isset($_POST['submit'])){
            //when message is sent no user sees it immediately so status is no
            mysqli_query($db,"INSERT INTO `message` VALUES('','$_SESSION[login_user]','$_POST[message]','no','student');");
            $result=mysqli_query($db,"SELECT * from `message` where username= '$_SESSION[login_user]';");

        }
        else{
            $result=mysqli_query($db,"SELECT * from `message` where username= '$_SESSION[login_user]';");
        }
        mysqli_query($db,"UPDATE `message` set `status`='yes' where sender='admin'  and username='$_SESSION[login_user]';");
    ?>
    <div class="wrapper">
        <div style="height: 70px; width: 100%; background-color: #2eac8b; text-align:center; color:white;">
            <h2 style="font-weight: bolder; font-family:'Times New Roman', Times, serif; margin-top: -5px; padding-top: 10px;">ADMIN</h2>
        </div>
        <div class="msg">
            <br>
            
            <?php
                while($row=mysqli_fetch_assoc($result)){
                    if($row['sender']=='student'){
                
            ?>
            
            <!--________________________________________________student______________________________________________________________-->
            <div class="chat user">
                <div style="float: left; padding-top: 5px;">
                &nbsp;
                    <?php    
                        echo "<img class='img-circle profile_img' height=40 width=40 src='images/".$_SESSION['pic']."'>";
                    ?>
                &nbsp;
                </div>
                <div style="float: left;" class="chatbox">
                <?php
                    echo $row['message'];
                ?>
                </div>
            </div>
            <br>
            <?php
                }
                else{
            ?>

            <!--___________________________________________________admin_________________________________________________________________-->
            <div class="chat admin">
                <div style="float: left; padding-top: 5px;">
                &nbsp;

                    <img style="height: 40px; width:40px; border-radius:50%;" src="images/user.jpg" alt="">
                &nbsp;
                </div>
                <div style="float: left;" class="chatbox">
                <?php
                    echo $row['message'];
                ?>
                </div>
            </div>
            <br>
            <?php
                }
            }
            ?>
        </div>
        <div style="height: 100px; padding-top: 10px;">
            <form action="" method="POST">
                <input type="text" name="message" class="form-control" required="" placeholder="Write your Message.." style="float: left;">&nbsp;
                <button class="btn btn-info btn-lg" type="submit" name="submit"> <span class="glyphicon glyphicon-send "></span>&nbsp;SEND</button>
            </form>
        </div>
    </div>
</body>
</html>


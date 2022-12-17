<?php
    session_start();
    include "connection.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>

    </title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

</head>
<body>
    <?php
        //$r=mysqli_query($db,"SELECT COUNT(status) as total from `message` where `status`='no' and username='$_SESSION[login_user]' and sender='admin';");
        //$count=mysqli_fetch_assoc($r);
    ?>
    
    <nav class="navbar navbar-inverse" style="width: 1536px;">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand active">ONLINE LIBRARY MANAGEMENT SYSTEM</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="../index.php">HOME</a></li>
                <li><a href="books.php">BOOKS</a></li>
                <li><a href="feedback.php">FEEDBACK</a></li>
                

            </ul>

            <?php
                if(isset($_SESSION['login_user']))
                {
                    
                    $r=mysqli_query($db,"SELECT COUNT(status) as total from `message` where `status`='no' and username='$_SESSION[login_user]' and sender='admin';");
                    $count=mysqli_fetch_assoc($r);
                
            ?>

            

            <ul class="nav navbar-nav"> 
                <li><a href="profile.php">PROFILE</a></li>
                <li><a href="fine.php">FINES</a></li>
            </ul>    
            <ul class="nav navbar-nav navbar-right">
                
                <li><a><p style="color: #ff1503; font-size: 20px;" id="demo";></p></a></li>
                <li><a href="message.php"><span class="glyphicon glyphicon-envelope"></span> &nbsp;<span class="badge bg-green"><?php echo $count['total']; ?></span></a></li>
                <li>
                    <a href="">
                        <div style="color: white;">
                            <?php
                                //echo "WELCOME: ".$_SESSION['login_user'];
                                echo "<img class='img-circle profile_img' height=25 width=25 src='images/".$_SESSION['pic']."'>";
                                echo " ".$_SESSION['login_user'];
                            ?>
                        </div>
                    </a>
                </li>
               <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"> LOGOUT</span></a></li>
            </ul>

            <?php
                }
                else{
            ?>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="../login.php"><span class="glyphicon glyphicon-log-in"> LOGIN</span></a></li>
                <li><a href="registration.php"><span class="glyphicon glyphicon-user"> SIGN-UP</span></a></li>
            </ul>

            <?php
                }
            
            ?>
            
        </div>
    </nav> 
    <?php
        if(isset($_SESSION['login_user']))
        {
            $day=0;
            $exp='<p style="color: yellow; background-color: red;"> EXPIRED </p>';
            $res = mysqli_query($db, "SELECT * from issue_book where username='$_SESSION[login_user]' and issue_book.status= '$exp' ;");
            while($row=mysqli_fetch_assoc($res)){
                //string to time changes date to second
                
                $date= strtotime($row['return']);
                $c= strtotime(date("Y-m-d"));
                
                $diff= $c-$date;
                //difference is shown in seconds
                //so divided by 60*60*24 to change to days
                //floor for decimal values incase 
                //echo floor($diff/(3600*24));

                //current > expired date means expired
                if($diff>=0){
                    //to show same data inside another page we created session variable
                    
                    $day=$day+floor($diff/(3600*24));
                    
                }
                
            }
            $_SESSION['fine']=$day*10;
            //total days
            //echo $day;
        }
    ?>
</body>
</html>
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
    <title>Approve Request</title>

    <style>
        body {
            background-image: url("images/approve.jpg");
            font-family: "Lato", sans-serif;
            transition: background-color .5s;
        }
        .search{
            padding-left: 850px ;
        }
        .form-control{
            width: 300px;
            height: 40px;
            background-color: #e2d8d8;
            color: black;
        }
        .form-control::-webkit-input-placeholder {
            color: black;
        }
        .sidenav {
            height: 100%;
            margin-top: 50px;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            left: 0;
            background-color: #222;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            right: 25px;
            font-size: 36px;
            margin-left: 50px;
        }   

        #main{
            transition: margin-left .5s;
            padding: 16px;
        }

        @media screen and (max-height: 450px) {
            .sidenav {padding-top: 15px;}
            .sidenav a {font-size: 18px;}
        }

        .img-circle{
            margin-left: 20px;
        }
        .h:hover{
            color: white;
            height: 50px;
            width: 300px;
            background-color: #00544c;
        }
        .container{
            background-color: #0000006e;
            height: 600px;
            opacity: .9;
            color: white;
        }

        .Approve{
            margin-left: 400px ;
        }
    </style>
</head>
<body>
    <!--___________________________________________side nav__________________________________________________________________-->
    <div id="mySidenav" class="sidenav">

        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div style="color: white; margin-left: 60px; font-family:'Times New Roman', Times, serif; font-size: 20px;">
            <?php 
            if(isset($_SESSION['login_user'])){
            //echo "WELCOME: ".$_SESSION['login_user'];
                echo "<img class='img-circle profile-img' height=120 width=120 src='images/".$_SESSION['pic']."'>";
                echo "<br><br>";
                echo "Welcome: ".$_SESSION['login_user'];
            }
            ?>
        </div>  
        <br><br>
        <div class="h"><a href="books.php">Books</a></div>
        <div class="h"><a href="request.php">Book Requests</a></div>
        <div class="h"><a href="issue_info.php">Issue Information</a></div>
        <div class="h"><a href="expired.php">Expired List</a></div>
    </div>

    <div id="main">
        <span style="color:black; font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>

        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "300px";
                document.getElementById("main").style.marginLeft = "300px";
                document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft= "0";
                document.body.style.backgroundColor = "white";
            }
        
        </script>
        <div class="container">
            <h3 style="text-align: center; font-family:'Times New Roman', Times, serif; font-size: 40px;">APPROVE REQUESTS</h3><br><br>
            <form class="Approve" action="" method="POST">
                <input class="form-control" type="text" name="approve" placeholder="Yes or No" required=""><br>
                <input class="form-control" type="text" name="issue" placeholder="Issue Date yyyy-mm--dd" required=""><br>
                <input class="form-control" type="text" name="return" placeholder="Return Date yyyy-mm--dd" required=""><br>
                <button class="btn btn-default" type="submit" name="submit">Approve</button>
            </form>
        </div>
    </div>
    <?php
        //not checking logged in as its already checked in book requests page
        if(isset($_POST['submit'])){
            //session bcz its happening on admin side

            //we are not adding session in php above because we have already started session in navbar so we can use session here
            mysqli_query($db,"UPDATE `issue_book` SET `status`='$_POST[approve]',`issue`='$_POST[issue]',`return`='$_POST[return]' WHERE username= '$_SESSION[st_name]' and bid= '$_SESSION[bid]';");

            //now if the request is approved we need to decrease nu,ber of available books too
            mysqli_query($db, "UPDATE `books` SET quantity= quantity-1 where bid='$_SESSION[bid]';");

            mysqli_query($db, "UPDATE `books` SET bcount= bcount+1 where bid='$_SESSION[bid]';");

            //to check if the quantity is 0 or not
            $result= mysqli_query($db, "SELECT quantity from `books` where bid='$_SESSION[bid]';");

            //fetch value from result
            while($row= mysqli_fetch_assoc($result)){
                if($row['quantity']==0){
                    mysqli_query($db, "UPDATE books set status='not-available' where bid='$_SESSION[bid]';");
                }
            }
    ?>
    <script>
        //alert("Updated Successfully");
        window.location="request.php";
    </script>
    <?php
        }
    ?>
</body>
</html>
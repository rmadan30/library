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
    <title>Books</title>

    <style type="text/css">
        body{
            background-image: url("images/add.jpg");
            font-family: "Lato", sans-serif;
            transition: background-color .5s;
        }

        .form-control::-webkit-input-placeholder {
            color: black;
        }

        .search{
            padding-left: 1200px;
        }
        body {
            font-family: "Lato", sans-serif;
            transition: background-color .5s;
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
        
        .book{
            width: 400px;
            margin: 0 auto;
        }

        .form-control{
            background-color: #fbfbfb70;
            border: 1px solid black;
            height: 40px;
        }

        .btn{
            border: 1px solid black;
        }
    </style>
</head>
<body>
    
    <!--____________________________________________side nav_________________________________________________________________-->
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
        <div class="h"><a href="add.php">Add Books</a></div>
        <div class="h"><a href="books.php">Delete Books</a></div>
        <div class="h"><a href="#">Book Requests</a></div>
        <div class="h"><a href="#">Issue Information</a></div>
    </div>

    <div id="main">
        <span style="font-size:30px; cursor:pointer; color: black;" onclick="openNav()">&#9776; open</span>
        <div class="container" style="text-align: center;">
            <h2 style=" text-align: center; color: black; font-family: Lucida Console; "><b>ADD NEW BOOKS</b></h2>
            <form class="book" action="" method="POST">
                <input type="text" name="bid" class="form-control" placeholder="Book Id" required=""><br>
                <input type="text" name="name" class="form-control" placeholder="Book Name" required=""><br>
                <input type="text" name="authors" class="form-control" placeholder="Authors" required=""><br>
                <input type="text" name="edition" class="form-control" placeholder="Edition" required=""><br>
                <input type="text" name="status" class="form-control" placeholder="Status" required=""><br>
                <input type="text" name="quantity" class="form-control" placeholder="Quantity" required=""><br>
                <input type="text" name="department" class="form-control" placeholder="Department" required=""><br>

                <button class="btn btn-default" type="submit" name="submit">ADD</button>
            </form>
        </div>
        <?php
            if(isset($_POST['submit'])){
                if(isset($_SESSION['login_user'])){
                    mysqli_query($db,"INSERT INTO `books` VALUES('$_POST[bid]','$_POST[name]','$_POST[authors]','$_POST[edition]','$_POST[status]','$_POST[quantity]','$_POST[department]', '0' );");
        ?>

        <script type="text/javascript">
            //alert("Book Inserted Successfully");
        </script>

        <?php
                }
                else{
        ?>

        <script type="text/javascript">
            alert("User Not Logged In! You need to Log-In first");
        </script>
        <?php
                }
            }
        ?>
    </div>
     <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "300px";
            document.getElementById("main").style.marginLeft = "300px";
            document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0";
            document.getElementById("main").style.marginLeft= "0";
            document.body.style.backgroundColor = "#d9edf7";
        }
     </script>
</body>
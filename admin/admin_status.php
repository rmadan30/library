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
    <style type="text/css">
        .search{
            padding-left: 860px;
            float: right;
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
    </style>
</head>
<body>
    <!--______________________________________________________Side nav________________________________________________________-->
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
        <div class="h"><a href="request.php">Book Requests</a></div>
        <div class="h"><a href="issue_info.php">Issue Information</a></div>
        <div class="h"><a href="expired.php">Expired List</a></div>
        
    </div>

    <div id="main">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>

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



    <!--____________________________________________search bar_______________________________________________________________-->
    <div class="container">
        <h2 style="font-family: 'Times New Roman', Times, serif; font-weight:bolder; text-align:center;">Search one username at a time to approve the request.</h2>
        <div class="search">
            <form class="navbar-form" method="post" name="form1">
                    <input class="form-control" type="text" name="search" placeholder="student username.." required="">
                    <button style="background-color: #6db6b9e6 ;" type="submit" name="submit" class="btn btn-default"> 
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
            </form>
        </div>
    <h2 style="text-align: center; font-family:Georgia, 'Times New Roman', Times, serif; font-weight: bolder;" >New Requests:</h2>
    <?php

        if(isset($_POST['submit'])){
            $q=mysqli_query($db, "SELECT `first`, `last`, `contact`, `email`, `username` FROM `admin` WHERE username like '%$_POST[search]%' and `status`='' ");
            if(mysqli_num_rows($q)==0){
                echo "Sorry! No new request with that username found. Try searching again. "; 
            }
            else{
                echo "<table class='table table-bordered table-hover'>";
                echo "<tr style='background-color: #6db6b9e6;'>";
        
                    echo"<th>"; echo "First Name"; echo "</th>";
                    echo"<th>"; echo "Last Name"; echo "</th>";
                    echo"<th>"; echo "Contact"; echo "</th>";
                    echo"<th>"; echo "E-mail"; echo "</th>";
                    echo"<th>"; echo "Username"; echo "</th>";
    
                echo "</tr>";
        
                while($row=mysqli_fetch_assoc($q)){
                    $_SESSION['test_name']=$row['username'];
                    echo "<tr>";
                    echo "<td>"; echo $row['first']; echo "</td>";
                    echo "<td>"; echo $row['last']; echo "</td>";
                    echo "<td>"; echo $row['contact']; echo "</td>";
                    echo "<td>"; echo $row['email']; echo "</td>";
                    echo "<td>"; echo $row['username']; echo "</td>";
                    echo "</tr>";
                }
                echo "</table>"; 

    ?>

    <form method="post">
        <button type="submit" name="submit1" style="background-color: #101010ed; color: red; font-weight: bolder; font-size: 17px;" class="btn btn-default">
            <span style="color: red;" class="glyphicon glyphicon-remove-sign"></span>&nbsp;Remove 
        </button>
        <button type="submit" name="submit2" style="background-color: #101010ed; color: green; font-weight: bolder; font-size: 17px;" class="btn btn-default">
            <span style="color: green;" class="glyphicon glyphicon-ok-sign"></span>&nbsp;Approve 
        </button>
    </form>

    <?php

        
            }
        }

        /* if no button is pressed. */
        else{
            $result= mysqli_query($db,"SELECT `first`, `last`, contact, email, username FROM `admin` where `status`='' ;");
            echo "<table class='table table-bordered table-hover'>";
            echo "<tr style='background-color: #6db6b9e6;'>";

                echo"<th>"; echo "First Name"; echo "</th>";
                echo"<th>"; echo "Last Name"; echo "</th>";
                echo"<th>"; echo "Contact"; echo "</th>";
                echo"<th>"; echo "E-mail"; echo "</th>";
                echo"<th>"; echo "Username"; echo "</th>";

            echo "</tr>";

            while($row=mysqli_fetch_assoc($result)){
                echo "<tr>";

                echo "<td>"; echo $row['first']; echo "</td>";
                echo "<td>"; echo $row['last']; echo "</td>";
                echo "<td>"; echo $row['contact']; echo "</td>";
                echo "<td>"; echo $row['email']; echo "</td>";
                echo "<td>"; echo $row['username']; echo "</td>";
                
                echo "</tr>";
            }
            echo "</table>";
        }
        if(isset($_POST['submit1'])){
            mysqli_query($db, "DELETE from `admin` where username='$_SESSION[test_name]' and `status`='';");
            unset($_SESSION['test_name']);
        }
        if(isset($_POST['submit2'])){
            mysqli_query($db, "UPDATE `admin` set `status`='yes' where username='$_SESSION[test_name]' ;");
            unset($_SESSION['test_name']);
        }   

    ?>
    </div>
</body>
</html>
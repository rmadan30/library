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
        .search{
            padding-left: 1150px;
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
    <?php
        $b=mysqli_query($db,"SELECT * FROM `books` order by bcount DESC limit 0,3;
        ;");
        // while($b2=mysqli_fetch_assoc($b)){
        //     echo $b2['name'];
        // }

    ?>
    <div style="width: 100%; height: 50px; margin-top: -20px;">
        <div style="background-color: #F44336; padding: 10px; width: 10%; height: 50px; float: left;">
            <h3 style="color: white; margin-top: 0px; font-family:Georgia, 'Times New Roman', Times, serif">Trending -></h3>
        </div>
        <div style="background-color: #ffcccc; width: 90%; height: 50px; float: left; padding: 10px; ">
            <table>
                <?php
                    while($b2=mysqli_fetch_assoc($b)){
                        echo "<tr style='color: black; width: 400px; margin-top: 0px; float: left; '>";
                            echo "<td>"; echo "[".$b2['bid']."] &nbsp; &nbsp;"; echo "</td>";
                            echo "<td>"; echo $b2['name']; echo "</td>";
                        echo "</tr>";
                    }
                ?>
            </table>
        </div>
    </div>
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
        <div class="h"><a href="expired.php">Expired Information</a></div>

    </div>
    <div class="search">
        <form class="navbar-form" method="post" name="form1">
                <input class="form-control" type="text" name="search" placeholder="search books.." required="">
                <button style="background-color: #6db6b9e6 ;" type="submit" name="submit" class="btn btn-default"> 
                    <span class="glyphicon glyphicon-search"></span>
                </button>
        </form>
        <!--______________________________________request book__________________________________________________________________-->
        <form class="navbar-form" method="post" name="form1">
                <input class="form-control" type="text" name="bid" placeholder="Enter book Id.." required="">
                <button style="background-color: #6db6b9e6 ;" type="submit" name="submit1" class="btn btn-default">Request Book</button>
        </form>
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
            document.body.style.backgroundColor = "#d9edf75c";
        }
     </script>
    
    <!--____________________________________________search bar_______________________________________________________________-->
    <!-- <div class="search">
        <form class="navbar-form" method="post" name="form1">
                <input class="form-control" type="text" name="search" placeholder="search books.." required="">
                <button style="background-color: #6db6b9e6 ;" type="submit" name="submit" class="btn btn-default"> 
                    <span class="glyphicon glyphicon-search"></span>
                </button>
        </form>
          ____________________________________request book__________________________________________________________________
        <form class="navbar-form" method="post" name="form1">
                <input class="form-control" type="text" name="bid" placeholder="Enter book Id.." required="">
                <button style="background-color: #6db6b9e6 ;" type="submit" name="submit1" class="btn btn-default">Request Book</button>
        </form>
    </div> -->
    <h2 style="text-align: center; font-family:Georgia, 'Times New Roman', Times, serif; font-weight: bolder;" >List of Books</h2>
    <?php

        if(isset($_POST['submit'])){
            $q=mysqli_query($db, "SELECT * from `books` WHERE name like '%$_POST[search]%'");
            if(mysqli_num_rows($q)==0){
    ?>

    <h1 style="font-size: 30px; font-weight: bold; text-align: center; font-family:'Times New Roman', Times, serif;">
        <?php
          echo "SORRY NO BOOKS FOUND TRY SEARCHING AGAIN";
        ?>
    </h1>
    <?php
                 
            }
            else{
                echo "<table class='table table-bordered table-hover'>";
                echo "<tr style='background-color: #6db6b9e6;'>";
        
                    echo"<th>"; echo "ID"; echo "</th>";
                    echo"<th>"; echo "Book-Name"; echo "</th>";
                    echo"<th>"; echo "Authors Name"; echo "</th>";
                    echo"<th>"; echo "Edition"; echo "</th>";
                    echo"<th>"; echo "Status"; echo "</th>";
                    echo"<th>"; echo "Quantity"; echo "</th>";
                    echo"<th>"; echo "Department"; echo "</th>";
        
                echo "</tr>";
        
                while($row=mysqli_fetch_assoc($q)){
                    echo "<tr>";
                    echo "<td>"; echo $row['bid']; echo "</td>";
                    echo "<td>"; echo $row['name']; echo "</td>";
                    echo "<td>"; echo $row['authors']; echo "</td>";
                    echo "<td>"; echo $row['edition']; echo "</td>";
                    echo "<td>"; echo $row['status']; echo "</td>";
                    echo "<td>"; echo $row['quantity']; echo "</td>";
                    echo "<td>"; echo $row['department']; echo "</td>"; 
                    echo "</tr>";
                }
                echo "</table>"; 
            }
        }

        /* if no button is pressed. */
        else{
            $result= mysqli_query($db,"SELECT * from `books` ORDER BY `books`.`name` ASC ;");
            echo "<table class='table table-bordered table-hover'>";
            echo "<tr style='background-color: #6db6b9e6;'>";

                echo"<th>"; echo "ID"; echo "</th>";
                echo"<th>"; echo "Book-Name"; echo "</th>";
                echo"<th>"; echo "Authors Name"; echo "</th>";
                echo"<th>"; echo "Edition"; echo "</th>";
                echo"<th>"; echo "Status"; echo "</th>";
                echo"<th>"; echo "Quantity"; echo "</th>";
                echo"<th>"; echo "Department"; echo "</th>";

            echo "</tr>";

            while($row=mysqli_fetch_assoc($result)){
                echo "<tr>";
                echo "<td>"; echo $row['bid']; echo "</td>";
                echo "<td>"; echo $row['name']; echo "</td>";
                echo "<td>"; echo $row['authors']; echo "</td>";
                echo "<td>"; echo $row['edition']; echo "</td>";
                echo "<td>"; echo $row['status']; echo "</td>";
                echo "<td>"; echo $row['quantity']; echo "</td>";
                echo "<td>"; echo $row['department']; echo "</td>"; 
                echo "</tr>";
            }
            echo "</table>";
        }

        if(isset($_POST['submit1'])){
            $sql1=mysqli_query($db,"SELECT * FROM `books` where bid='$_POST[bid]';");
            $row1=mysqli_fetch_assoc($sql1);
            $count1=mysqli_num_rows($sql1);
            //$count1 !=0 means book id is on book table
            if($count1!=0){
                if(isset($_SESSION['login_user'])){
                    mysqli_query($db,"INSERT INTO `issue_book` VALUES('$_SESSION[login_user]','$_POST[bid]',' ',' ',' ');");
            
    ?>
    <script type="text/javascript">
        window.location="request.php";
    </script>
    
    <?php
                }
                else{
    ?>
     <script type="text/javascript">
        alert("You must Login first to request a book!");
    </script>
    <?php
                }
            }
            else{
    ?>
    <script type="text/javascript">
        alert("The book you requested is not available in the library");
    </script>
    <?php
            }
        }
    ?>
</div>
</body>
</html>
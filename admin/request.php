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
    <title>Book Request</title>

    <style>
        body {
            background-image: url("images/request.jpeg");
            font-family: "Lato", sans-serif;
            transition: background-color .5s;
        }
        .search{
            padding-left: 850px ;
        }
        .form-control{
            width: 300px;
            height: 40px;
            background-color: black;
            color: white;
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
            background-color: black;
            height: 600px;
            opacity: .6;
            color: white;
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
        <span style="color:white; font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>

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
            <div class="search">
                <form action="" method="post" name="form1">
                    <br>
                    <input type="text" name="username" class="form-control" placeholder="Username" required=""><br>
                    <input type="text" name="bid" class="form-control" placeholder="Book Id" required=""><br>
                    <button class="btn btn-default" name="submit" type="submit">Submit</button>
                </form>

            </div>
            <h3 style="text-align: center; font-size:30px; color: white; font-weight: bolder; font-family:'Times New Roman', Times, serif;">REQUEST OF BOOK</h3><br>
            <?php
                if(isset($_SESSION['login_user'])){
                    $sql= "SELECT student.username,rollnumber, books.bid,name,authors,edition,books.status FROM student INNER JOIN issue_book on student.username= issue_book.username INNER JOIN books on issue_book.bid=books.bid where issue_book.status=''";
                    $result= mysqli_query($db, $sql);
                    if(mysqli_num_rows($result)==0){
                        ?>
                        <h1 style="font-size: 30px; font-weight: bolder; text-align: center; font-family:'Times New Roman', Times, serif; color: black;">
                            <?php
                                echo "Sorry! No pending requests";
                            ?>
                        </h1>
                        <?php
                    }
                    else{
                        echo "<table class='table table-bordered'>";
                        echo "<tr style='background-color: #6db6b9e6;'>";
            
                        echo"<th>"; echo "Student Username"; echo "</th>";
                        echo"<th>"; echo "Student Roll Number"; echo "</th>";
                        echo"<th>"; echo "Book Id"; echo "</th>";
                        echo"<th>"; echo "Book Name"; echo "</th>";
                        echo"<th>"; echo "Author Name"; echo "</th>";
                        echo"<th>"; echo "Book Edition"; echo "</th>";
                        echo"<th>"; echo "Book Status"; echo "</th>";
            
                        echo "</tr>";
            
                        while($row=mysqli_fetch_assoc($result)){
                            echo "<tr>";
                            echo "<td>"; echo $row['username']; echo "</td>";
                            echo "<td>"; echo $row['rollnumber']; echo "</td>";
                            echo "<td>"; echo $row['bid']; echo "</td>";
                            echo "<td>"; echo $row['name']; echo "</td>"; 
                            echo "<td>"; echo $row['authors']; echo "</td>";
                            echo "<td>"; echo $row['edition']; echo "</td>";
                            echo "<td>"; echo $row['status']; echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>"; 
                    }
                }else{
            ?>
            <div style="border: 3px solid black; margin:0 auto; width: 400px; height: 100px; background-color: #c6c6c673;">
                <h1 style="font-size: 25px; font-weight: bolder; text-align: center; font-family:'Times New Roman', Times, serif; color: #fff2f2;">
                    <?php
                        echo "User not Logged In! ";
                        echo "<br>";
                        echo"Please Login to see book requests";
                    ?>
                </h1>
            </div>
            <?php
            }

                if(isset($_POST['submit'])){
                    //session variable has value we enter as input in the form- search
                    $_SESSION['st_name']=$_POST['username'];
                    //another variable for bookid
                    $_SESSION['bid']=$_POST['bid'];
            ?>
            <script type="text/javascript">
                window.location="approve.php";
            </script>
            <?php
                }
            ?>

        </div>
    </div>
</body>
</html>
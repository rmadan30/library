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
            background-image: url("images/expired1.jpg");
            background-repeat: no-repeat;
            font-family: "Lato", sans-serif;
            transition: background-color .5s;
        }
        .search{
            padding-left: 75% ;
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
            padding-left: 10px;
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
            height: 800px;
            width: 85%;
            opacity: .75;
            color: white;
            margin-top: -65px;
        }
        .scroll{
            width: 100%;
            height: 400px;
            overflow: auto;
        }

        th, td{
            width: 10%;
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
        <span style="color:white; font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>

        <script>
            function openNav() {
                document.getElementById("mySidenav").style.width = "300px";
                document.getElementById("main").style.marginLeft = "300px";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft= "0";
                document.body.style.backgroundColor = "white";
            }
        
        </script>
        <div class="container">

            <?php
                if(isset($_SESSION['login_user'])){
            ?>
            <div style="float: left; padding-left: 5px; padding-top: 20px;">
                <form action="" method="POST">
                    <button class="btn btn-default" style="background-color: green; color: yellow;" name="submit2" type="submit">RETURNED</button>&nbsp;&nbsp;
                    <button class="btn btn-default" style="background-color: red; color: yellow;" name="submit3" type="submit">EXPIRED</button>
                </form>
            </div>
            <div style="float: right; padding-top: 10px; color: red;">
                <?php
                    $var=0;
                    $result=mysqli_query($db,"SELECT * from `fine` where username='$_SESSION[login_user]' and fine.status='not paid';");
                    while($r=mysqli_fetch_assoc($result)){
                        $var= $var+$r['fine'];
                    }
                    $var2=$var+$_SESSION['fine'];
                ?>
                <h3 style="font-weight:bolder; font-family: 'Times New Roman', Times, serif;">YOUR FINE IS : 
                    <?php
                        echo "₹".$var2;
                    ?>

                </h3>
            </div>
            <br><br><br><br>
            <?php
                
            }
            ?>
            <!--<h2 style="font-family:'Times New Roman', Times, serif; text-align: center;">DATE EXPIRED LIST</h2>--><br><br>
            <?php
                //$var='<p style="color: yellow; background-color: red;"> EXPIRED </p>';

                if(isset($_SESSION['login_user'])){

                    $ret='<p style="color: yellow; background-color: green;"> RETURNED </p>';
                    $exp='<p style="color: yellow; background-color: red;"> EXPIRED </p>';

                    //means if status is not '' or yes or no then we will show it here
                    //$sql="SELECT student.username,rollnumber, books.bid,name,authors,edition,issue_book.status,issue,issue_book.return FROM student INNER JOIN issue_book on student.username= issue_book.username INNER JOIN books on issue_book.bid=books.bid where issue_book.status!='' and issue_book.status!='Yes' and issue_book.status!='no' order by `issue_book`.`return` DESC;";
                    
                    //check if the second button that is the returned button is pressed or not
                    //condition changed checked if the return variable is pressed
                    //check only for yourself not other students
                    if(isset($_POST['submit2'])){
                        $sql="SELECT student.username,rollnumber, books.bid,name,authors,edition,issue_book.status,issue,issue_book.return FROM student INNER JOIN issue_book on student.username= issue_book.username INNER JOIN books on issue_book.bid=books.bid where issue_book.status ='$ret' and issue_book.username='$_SESSION[login_user]' order by `issue_book`.`return` DESC;";

                        //result copied in every condition and main one commented 
                        $result=mysqli_query($db,$sql);
                    }
                    // if 2nd button is not pressed and the 3rd that is expired button is pressed 
                    // condition changed checked if the exp variable is used
                    else if(isset($_POST['submit3'])){
                        $sql="SELECT student.username,rollnumber, books.bid,name,authors,edition,issue_book.status,issue,issue_book.return FROM student INNER JOIN issue_book on student.username= issue_book.username INNER JOIN books on issue_book.bid=books.bid where issue_book.status ='$exp' and issue_book.username='$_SESSION[login_user]' order by `issue_book`.`return` DESC;";
                        $result=mysqli_query($db,$sql);
                    }

                    //if both the buttons are not pressed then
                    else{
                        $sql="SELECT student.username,rollnumber, books.bid,name,authors,edition,issue_book.status,issue,issue_book.return FROM student INNER JOIN issue_book on student.username= issue_book.username INNER JOIN books on issue_book.bid=books.bid where issue_book.status!='' and issue_book.status!='Yes' and issue_book.status!='no' and issue_book.username='$_SESSION[login_user]'  order by `issue_book`.`return` DESC;";
                        $result=mysqli_query($db,$sql);
                    }
                    //$result=mysqli_query($db,$sql);
                    

                    echo "<table class='table table-bordered' style='width:100%;'>";
                    
                        echo "<tr style='background-color: #6db6b9e6;'>";
            
                        echo"<th>"; echo "Student Username"; echo "</th>";
                        echo"<th>"; echo "Student Roll Number"; echo "</th>";
                        echo"<th>"; echo "Book Id"; echo "</th>";
                        echo"<th>"; echo "Book Name"; echo "</th>";
                        echo"<th>"; echo "Author Name"; echo "</th>";
                        echo"<th>"; echo "Book Edition"; echo "</th>";
                        echo"<th>"; echo "Status"; echo "</th>";
                        echo"<th>"; echo "Issue Date"; echo "</th>";
                        echo"<th>"; echo "Return Date"; echo "</th>";
            
                        echo "</tr>";
                        echo"</table>";

                        
                    echo "<div class='scroll'>";
                    echo "<table class='table table-bordered'>";
            
                        while($row=mysqli_fetch_assoc($result)){
                            
                           
                            echo "<tr>";
                            echo "<td>"; echo $row['username']; echo "</td>";
                            echo "<td>"; echo $row['rollnumber']; echo "</td>";
                            echo "<td>"; echo $row['bid']; echo "</td>";
                            echo "<td>"; echo $row['name']; echo "</td>"; 
                            echo "<td>"; echo $row['authors']; echo "</td>";
                            echo "<td>"; echo $row['edition']; echo "</td>";
                            echo "<td>"; echo $row['status']; echo "</td>";
                            echo "<td>"; echo $row['issue']; echo "</td>";
                            echo "<td>"; echo $row['return']; echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>"; 
                        echo "</div>";
                }
                else{
            ?>

            <h3 style="text-decoration: underline; font-family:'Times New Roman', Times, serif; text-align: center;">LOGIN FIRST TO SEE INFORMATION OF BORROWED BOOKS</h3><br><br>
            
            <?php
                }
            
            ?>
        </div>
    </div>
</body>
</html>
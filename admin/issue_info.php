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
            background-image: url("images/issue.jpg");
            background-repeat: no-repeat;
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
            opacity: .9;
            color: white;
        }
        .scroll{
            width: 100%;
            height: 500px;
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
                document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
            }

            function closeNav() {
                document.getElementById("mySidenav").style.width = "0";
                document.getElementById("main").style.marginLeft= "0";
                document.body.style.backgroundColor = "white";
            }
        
        </script>
        <div class="container">
            <form style="padding-top: 20px;" method="post">
                <button class="btn btn-default" style="float: left;" name="submit_m" type="submit">Send Email</button>
            </form>
            <h2 style="font-family:'Times New Roman', Times, serif; text-align: center;">INFORMATION OF BORROWED BOOKS</h2><br><br>
            <?php
                $count=0;
                
               
                    $sql="SELECT student.username,rollnumber, books.bid,name,authors,edition,issue,issue_book.return FROM student INNER JOIN issue_book on student.username= issue_book.username INNER JOIN books on issue_book.bid=books.bid where issue_book.status='Yes' order by `issue_book`.`return` ASC;";
                    $result=mysqli_query($db,$sql);
                    
                    echo "<table class='table table-bordered' style='width:100%;'>";
                    
                        echo "<tr style='background-color: #6db6b9e6;'>";
            
                        echo"<th>"; echo "Student Username"; echo "</th>";
                        echo"<th>"; echo "Student Roll Number"; echo "</th>";
                        echo"<th>"; echo "Book Id"; echo "</th>";
                        echo"<th>"; echo "Book Name"; echo "</th>";
                        echo"<th>"; echo "Author Name"; echo "</th>";
                        echo"<th>"; echo "Book Edition"; echo "</th>";
                        echo"<th>"; echo "Issue Date"; echo "</th>";
                        echo"<th>"; echo "Return Date"; echo "</th>";
            
                        echo "</tr>";
                        echo"</table>";

                        
                    echo "<div class='scroll'>";
                    echo "<table class='table table-bordered'>";
            
                        while($row=mysqli_fetch_assoc($result)){
                            //todays date fetched
                            $date=date("Y-m-d");

                            if($date > $row['return']){
                                $count= $count+1;
                                $var='<p style="color: yellow; background-color: red;"> Expired </p>';
                                //limit is used if more than one person has its return date expired
                                //approved(status) in the issue table has also been changed to expired
                                //on browsing again the expired value is removed from the table and only those whose return date is not expired are present
                                mysqli_query($db, "UPDATE `issue_book` SET `status`='$var' where `return`='$row[return]' and `status`='Yes' limit $count;");

                                echo $date."<br>";
                            }
                            //can check here 
                            //echo $date. "<br>";
                           
                            echo "<tr>";
                            echo "<td>"; echo $row['username']; echo "</td>";
                            echo "<td>"; echo $row['rollnumber']; echo "</td>";
                            echo "<td>"; echo $row['bid']; echo "</td>";
                            echo "<td>"; echo $row['name']; echo "</td>"; 
                            echo "<td>"; echo $row['authors']; echo "</td>";
                            echo "<td>"; echo $row['edition']; echo "</td>";
                            echo "<td>"; echo $row['issue']; echo "</td>";
                            echo "<td>"; echo $row['return']; echo "</td>";
                            echo "</tr>";
                        }
                        echo "</table>"; 
                        echo "</div>";

                        if(isset($_POST['submit_m']))
                        {
                            $t= mysqli_query($db, "SELECT * from `issue_book` where `status`='yes' ;");
                            $date1= date_create(date("Y-m-d"));

                            while($row=mysqli_fetch_assoc($t))
                            {
                                $date2= date_create($row['return']);
                                $diff= date_diff($date1,$date2);
                                
                                //cant use diff directly - string issue
                                $day= $diff->format("%a");

                                if($day==2)
                                {
                                    $name_m= $row['username'];
                                    $bid_m= $row['bid'];

                                    $sql_m=mysqli_query($db, "SELECT * FROM `student` where username='$row[username]';");
                                    $to=mysqli_fetch_assoc($sql_m);
                                    $subject= "Regarding book return date";
                                    $msg="Hello! This is sent to notify that you need to return the book (Id: ".$bid_m.") in two days.";
                                    $from="From:khushisood2001@gmail.com";

                                    if(mail($to['email'], $subject, $msg, $from))
                                    {
                                    ?>
                                        <!-- <script type="text/javascript">
                                            alert("Mail sent successfully");
                                        </script> -->
                                    <?php
                                        }
                                        else
                                        {
                                    ?>
                                        <!-- <script type="text/javascript">
                                            alert("Mail not sent");
                                        </script> -->
                                    <?php    
                                        }
                                    
                                }
                            }
                        }   
            
            ?>
        </div>
    </div>
</body>
</html>
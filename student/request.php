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
            margin-left: 20px;
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

        th,td,input{
            width: 100px;;
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
        <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; open</span>
        <div class="container">
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
            <br><br><br><br>
        
            <?php
                //since we have already logged in to reach this request.php page we neednt login again
                    $q=mysqli_query($db, "SELECT * from `issue_book` WHERE username='$_SESSION[login_user]' and issue_book.status= '';");
                    if(mysqli_num_rows($q)==0){
            ?>
            <h1 style="font-size: 30px; font-weight: bold; text-align: center; font-family:'Times New Roman', Times, serif; text-decoration:underline;">
                
                <?php
                    echo "SORRY NO PENDING REQUESTS";
                ?>
            
            </h1>
    
            <?php
                    }
                    else{
            
            ?>
        
            <form method="post">
   
                <?php
                    echo "<table class='table table-bordered table-hover'>";
                    echo "<tr style='background-color: #6db6b9e6;'>";
                        
                        echo"<th>"; echo "Select"; echo "</th>";
                        echo"<th>"; echo "Book-Id"; echo "</th>";
                        echo"<th>"; echo "Approve Status"; echo "</th>";
                        echo"<th>"; echo "Issue Date"; echo "</th>";
                        echo"<th>"; echo "Return Date"; echo "</th>";
            
                    echo "</tr>";
        
                    while($row=mysqli_fetch_assoc($q)){
                        echo "<tr>";
                ?>
        
                <td><input type="checkbox" name="check[]" value="<?php echo $row["bid"] ?>"></td>

                 <?php
                        echo "<td>"; echo $row['bid']; echo "</td>";
                        echo "<td>"; echo $row['status']; echo "</td>";
                        echo "<td>"; echo $row['issue']; echo "</td>";
                        echo "<td>"; echo $row['return']; echo "</td>"; 
                        echo "</tr>";
                    }
                    echo "</table>"; 
                ?>

                <p align="center"><button type="submit" name="delete" class="btn btn-success" onclick="location.reload()" >Delete</button></p>

            </form>
        </div>
    </div> 
    
    <?php
        }
        
        if(isset($_POST['delete']))
        {
            if(isset($_POST['check']))
            {
                foreach($_POST['check'] as $delete_id){
                    mysqli_query($db, "DELETE from `issue_book` where bid='$delete_id' and username='$_SESSION[login_user]' order by bid ASC LIMIT 1;");
                }
            }             
        }
            
    ?>
</body>
</html>
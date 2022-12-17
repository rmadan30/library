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
    <title>Profile</title>
    <style type="text/css">
        .wrapper{
            width: 350px;
            margin: 0 auto;
            color: white;
        }
        body{
            background-image: url("images/profile.jpg");
        }
    </style>
</head>
<body>
    <div class="container">
        <form action="" method="post">
            <button class="btn btn-default" style="float: right; width: 70px;" name="submit1" type="submit">EDIT</button>
        </form>
        <div class="wrapper">

            <?php
            if(isset($_POST['submit1'])){
            ?>
            <script type="text/javascript">
                window.location="edit.php";
            </script>
            <?php
            }
                if(isset($_SESSION['login_user'])){
                    $q=mysqli_query($db,"SELECT * from `admin` where username='$_SESSION[login_user]';");

            ?>
            <h2 style="text-align: center; font-family:'Times New Roman', Times, serif; font-weight: bolder;">MY PROFILE</h2>
            <?php
                $row= mysqli_fetch_assoc($q);

                echo "<div style='text-align: center'>
                        <img class='img-circle profile-img' height=110 width=120 src='images/".$_SESSION['pic']."'>
                    </div>";
            ?>
            <div style="text-align: center; font-size: 25px;"><b><br>WELCOME</b>
                <h4>
                    <?php
                        echo $_SESSION['login_user'];
                    ?>
                </h4><br>
            </div>
            <?php
              echo "<b>";
                echo "<table class='table table-bordered'>";
                    echo "<tr>"; 
                        echo "<td>"; 
                            echo "<b> First Name: </b>";
                        echo "</td>";
                        echo "<td>"; 
                            echo $row['first'];
                        echo "</td>";
                    echo "</tr>";

                    echo "<tr>";
                        echo "<td>"; 
                            echo "<b> Last Name: </b>";
                        echo "</td>";
                        echo "<td>"; 
                            echo $row['last'];
                        echo "</td>";
                    echo "</tr>";

                    // echo "<tr>";  
                    //     echo "<td>"; 
                    //         echo "<b> Contact:  </b>";
                    //     echo "</td>";
                    //     echo "<td>"; 
                    //         echo $row['contact'];
                    //     echo "</td>";
                    // echo "</tr>";
                        
                    echo "<tr>"; 
                        echo "<td>";
                            echo "<b> Contact: </b>"; 
                        echo "</td>";
                        echo "<td>"; 
                            echo $row['contact'];
                        echo "</td>";
                    echo "</tr>";
                    
                    echo "<tr>"; 
                        echo "<td>";
                            echo "<b> E-mail: </b>"; 
                        echo "</td>";
                        echo "<td>"; 
                            echo $row['email'];
                        echo "</td>";
                    echo "</tr>";
                    
                    echo "<tr>"; 
                        echo "<td>"; 
                            echo "<b> Username: </b>";
                        echo "</td>";
                        echo "<td>"; 
                            echo $row['username'];
                        echo "</td>";
                    echo "</tr>";
                    
                    echo "<tr>"; 
                        echo "<td>";
                            echo "<b> Password: </b>"; 
                        echo "</td>";
                        echo "<td>"; 
                            echo $row['password'];
                        echo "</td>";
                    echo "</tr>";
                echo "</table>";
              echo "<b>";
             }else{
            ?>
            <h1 style="font-size: 30px; font-weight: bold; text-align: center; font-family:'Times New Roman', Times, serif;">
                <?php
                  echo "USER NOT LOGGED IN! LOGIN FIRST";
                ?>
            </h1>
            <?php
             }
            ?>
        </div>
    </div>
</body>
</html>
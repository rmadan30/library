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
    <title>Edit Information</title>

    <style type="text/css">
        body{
            background-image: url("images/editt.jpg");
        }
        .form-control{
            width: 300px;
            margin: 0 auto;
            height: 38px;
            border: 2px solid black;
        }
        .btn{
            border: 1px solid black;
        }
        .form1{
            margin: 0 610px;
            font-size: 20px;
        }
        label{
            margin-top: 3px;
        }
    </style>
</head>
<body>
    <h2 style="text-align:center; font-weight:bolder; font-family:'Times New Roman', Times, serif;">EDIT INFORMATION</h2>

    <?php
        $sql= "SELECT * from `student` where username='$_SESSION[login_user]'";
        $result= mysqli_query($db, $sql);
        while($row= mysqli_fetch_assoc($result)){
            $first= $row['firstname'];
            $last= $row['lastname'];
            $rollnumber= $row['rollnumber'];
            $contact= $row['contact'];
            $email= $row['email'];
            $username= $row['username'];
            $password= $row['password'];
        }
    ?>
    <div class="profile_info" style="text-align: center;">
        <span style="font-family:'Times New Roman', Times, serif; font-weight:bold; font-size: 25px;">WELCOME:</span>
        <h4 style="font-family:'Times New Roman', Times, serif; margin-top: 0px;"><?php echo $_SESSION['login_user']; ?></h4>
    </div>
    <div class="form1">
    <form action="" method="POST" enctype="multipart/form-data">
        <label><h5><b>First Name:</b></h5></label>    
        <input class="form-control" type="text" name="firstname" value="<?php echo $first; ?>">

        <label><h5><b>Last Name:</b></h5></label>    
        <input class="form-control" type="text" name="lastname"  value="<?php echo $last; ?>">

        <label><h5><b>Roll Number:</b></h5></label>    
        <input class="form-control" type="text" name="rollnumber"  value="<?php echo $rollnumber; ?>">

        <label><h5><b>Contact:</b></h5></label>    
        <input class="form-control" type="text" name="contact" value="<?php echo $contact; ?>">
        
        <label><h5><b>E-mail:</b></h5></label>  
        <input class="form-control" type="text" name="email" value="<?php echo $email; ?>">
        
        <label><h5><b>Username:</b></h5></label>  
        <input class="form-control" type="text" name="username" value="<?php echo $username; ?>">
        
        <label><h5><b>Password:</b></h5></label>  
        <input class="form-control" type="text" name="password" value="<?php echo $password; ?>">
        
        <label><h5><b>Profile picture:</b></h5></label>  
        <input class="form-control" type="file" name="file"><br>


        <div style="text-align: center;"><button class="btn btn-default" type="submit" name="submit">Save</button></div><br>
    </form>
    </div>
    <?php
        if(isset($_POST['submit'])){
            //photo file
            //for image 
            move_uploaded_file($_FILES['file']['tmp_name'], "images/".$_FILES['file']['name']);
            //posting the data we entered finally and pressed submit

            $first= $_POST['firstname'];
            $last= $_POST['lastname'];
            $rollnumber= $_POST['rollnumber'];
            $contact= $_POST['contact'];
            $email= $_POST['email'];
            $username= $_POST['username'];
            $password= $_POST['password'];
            $pic= $_FILES['file']['name'];

            $sql1= "UPDATE `student` SET  `firstname`='$first', `lastname`='$last', `rollnumber`='$rollnumber', `contact`='$contact', `email`='$email', `username`='$username', `password`='$password', `pic`='$pic' where username='".$_SESSION['login_user']."';";

            if(mysqli_query($db,$sql1)){
    ?>
    <script type="text/javascript">
        // alert("Saved Successfully");
        window.location="profile.php";
    </script>
    <?php
            }
        }
    ?>
</body>
</html>
 
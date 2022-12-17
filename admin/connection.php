<?php
    //statement is enough to make connection 
    $db=mysqli_connect("localhost","root","","library"); /*server name, root-> username, password, db name */

    //just in case connection is not made
    /*if(!$db){
        die("Connection failed: " . mysqli_connect_error());
    }

    echo "Connection successful";*/

?>
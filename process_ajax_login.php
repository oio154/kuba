<?php

$salt="psdofkpsdoOIJOIJ398049IUHIUH";

include 'db.php';




    if(!empty($_REQUEST['user']) && !empty($_REQUEST['pass'])){

        $username = mysqli_real_escape_string($conn, strip_tags($_REQUEST['user']));
        $password = mysqli_real_escape_string($conn, strip_tags($_REQUEST['pass']));


        $sql="SELECT * FROM `user` WHERE  password=PASSWORD('{$password}{$salt}') and u_name='{$username}'";
        $response=mysqli_query($conn, $sql);
        
        


        print_r($response->num_rows);
    }

?>
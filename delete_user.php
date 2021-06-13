<?php
    session_start();
    include("connect_db.php");
    if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']))
    {
        if(isset($_GET['user_id']) && !empty($_GET['user_id']))
        {
            // echo "  if (confirm('Are you sure you want to delete the User?')) {";  
                 
                    $qu="delete from user where user_id=".$_GET['user_id'];
                    $res=mysqli_query($conn,$qu);
                    if($res)
                    {
                        header('location: users.php?msg=Successfully deleted the user!');
                    }
                    else
                        echo "Failed to delete a user!".$_GET['user_id'];
            // echo " }";
            // echo "else {";
            // header('location:users.php');
            // echo "}";  
        }
        
    }
    else
        header("location: homepage.php");
?>
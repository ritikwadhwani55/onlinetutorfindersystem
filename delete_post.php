<?php
    session_start();
    include("connect_db.php");
    if($conn)
    {
        // echo "<script>if(confirm('Do you confirm to delete the post?'))</script>";
        if(isset($_GET['share_id']) && !empty($_GET['share_id']))
        {
            $share_id=$_GET['share_id'];
            $q_sql="delete from batch_shares where share_id=".$_GET['share_id']." and batch_id=".$_GET['b_id'];
            $res=mysqli_query($conn,$q_sql);
            if($res)
            {
                // echo "Successfully deleted the post!";
                header('location: batch_details.php?b_id='.$_GET['b_id']."&message=Successfully deleted the post!");
            }
            else
            {
                // echo var_dump($_POST['share_id']);
                echo "Failed to delete the post!";
            }
        }
        else
        {
            header('location:homepage.php');
        }
    }
?>
<?php
    session_start();
    include("connect_db.php");
    if($conn)
    {
        if(isset($_GET['bf_id']) && !empty($_GET['bf_id']) && isset($_GET['b_id']) && !empty($_GET['b_id']))
        {
            $sql_query="delete from batch_feedback where bf_id=".$_GET['bf_id']." and batch_id=".$_GET['b_id'];
            $res=mysqli_query($conn,$sql_query);
            if($res)
            {
                header('location: batch_details.php?b_id='.$_GET['b_id']."&message=Successfully deleted the feedback!");
            }
            else
            {
                echo 'Failed to delete the feedback';
            }
        }
        else
        {
            header('location:homepage.php');
        }
    }
?>
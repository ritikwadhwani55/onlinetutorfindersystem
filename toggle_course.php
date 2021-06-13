<?php
    session_start();
    include("connect_db.php");
    if(!(isset($_SESSION['teach_id']) && !empty($_SESSION['teach_id']) || isset($_SESSION['admin_id'])))
    {
        header("location: homepage.php");
    }
    else
    {
        // echo var_dump($_GET['is_complete']);
        // echo var_dump();
        if((isset($_GET['b_id']) && !empty($_GET['b_id'])) && isset($_GET['is_complete']))
        
        {
           
            $sql_q="update batch set isComplete=".$_GET['is_complete']." where batch_id=".$_GET['b_id'];
            $r=mysqli_query($conn, $sql_q);
            if($r)
            {
                header("location: batch_details.php?b_id=".$_GET['b_id']);
            }
            else
            {
                echo "query failed to execute";
            }
        }
        else
        {
            echo "query failed due to parameters";
        }
    }
?>
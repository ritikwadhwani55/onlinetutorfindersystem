<?php
    session_start();
    ob_start();
    include("connect_db.php");
    if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
    {
        if(isset($_GET['pg']))
        {
            if(isset($_SESSION['teach_id']) && isset($_GET['batch_id']))
            {
                if($conn)
                {
                    $query="select * from batch where batch_id=".$_GET['batch_id'].";";
                    $res=mysqli_query($conn,$query);
                    if($res)
                    {
                        $row=mysqli_fetch_assoc($res);
                        $course_name=$row['course_name'];
                    }
                    $query="delete from batch where batch_id=".$_GET['batch_id'].";";
                    $res=mysqli_query($conn,$query);
                    if($res)
                    {
                        echo "<script>alert('".$course_name." batch is deleted successfully!')</script>";
                    }
                    else
                    {
                        echo "<script>alert('Failed to delete ".$course_name." batch!Please try again later.')</script>";
                    }
                    header("location: ". $_GET['pg']);
                    ob_end_flush();
                }
                else
                {
                    echo "Failed to establish connection";
                }
            }
            echo "Session id for teacher is not set";
        }
        else
        {
            echo "url error";
        }
    }
?>
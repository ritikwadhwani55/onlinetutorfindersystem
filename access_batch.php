<?php
    session_start();
    include("connect_db.php");
    // $data = json_decode(file_get_contents("php://input"));
    if(!(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])))
    {
        header("location: login.php?pg=view_batches.php");
        // echo $_SESSION['user_id'];
    }
    else
    {
        $b_id=$_GET['b_id'];
        // echo $_GET['b_id'];
        if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']))
        {
            $query="select * from user u inner join admin a on u.user_id=a.user_id where a.admin_id=".$_SESSION['admin_id'];
            $res=mysqli_query($conn,$query);
            if($res)
            {
                $count=mysqli_num_rows($res);
                if($count>0)
                {
                    header("location: batch_details.php?b_id=".$b_id);
                }
            }
        }
        else
        {
            $query="select * from enroll where batch_id=".$b_id." and user_id=".$_SESSION['user_id'];
            $res=mysqli_query($conn,$query);
            if($res)
            {
                $count=mysqli_num_rows($res);
                if($count>0)
                {
                    header("location: batch_details.php?b_id=".$b_id);
                }
                // echo $b_id." is the batch you want to visit and you are enrolled";
                else
                {
                    $query="select * from batch where batch_id=".$b_id." and teach_id=".$_SESSION['teach_id'];
                    $res=mysqli_query($conn,$query);
                    if($res)
                    {
                        // echo $b_id." is the batch you want to visit and you are the teacher";
                        if($res)
                        {
                            $count=mysqli_num_rows($res);
                            if($count>0)
                            {
                                header("location: batch_details.php?b_id=".$b_id);
                            }
                            else
                            {
                                header("location: view_batch_details.php?b_id=".$b_id);
                            }
                        }
                        else
                        {
                            echo "query did not execute!";   
                        }
                    }
                    else
                    {
                        header("location: view_batch_details.php?b_id=".$b_id);
                    }
                    
                }
            }
        }
    }
?>
<?php    
          session_start();
          include("connect_db.php");
          if($_SERVER['REQUEST_METHOD']=='POST')
          {    
            if(isset($_POST['submit_data']) && !empty($_POST['submit_data']) && $_SERVER['REQUEST_METHOD']=='POST')
            {
                $file=rand(1000,100000)."-".$_FILES['share_file']['name'];
                $file_loc=$_FILES['share_file']['tmp_name'];
                $file_type=$_FILES['share_file']['type'];
                $folder='uploads/';
                move_uploaded_file($file_loc,$folder.$file);
                if(!(isset($file) && !empty($file) && isset($file_type) && !empty($file_type)))
                {
                    $file="NULL";
                    $file_type="NULL";
                }
                
                  if(isset($_POST['url_link']) && !empty($_POST['url_link']))
                  {
                    $url_link=$_POST['url_link'];
                  }
                
                else
                {
                  $url_link="NULL";
                }
                $b_id=$_GET['b_id'];
                if(isset($_POST['message']) && !empty($_POST['message'])){
                  $message=$_POST['message'];
                }
                else
                {
                  $message="NULL";
                }
                  if(!(isset($file) && !empty($file) && isset($url_link) && !empty($url_link) && isset($message) && !empty($message)))
                {
                  echo "<script>alert('Please select or enter the data to be uploaded!'); return false;</script>";
                  unset($_POST);
                  header("location: batch_details.php?b_id=".$_GET['b_id']."&message=Please select or enter the data to be uploaded!");
                  //echo "this is the source of error!";
                }
                else
                {
                  $date=date('Y-m-d H:i:s');
                  $sql_query="insert into batch_shares(batch_id,user_id,share_date_time,file,file_type, url,message) values(".$b_id.",".$_SESSION['user_id'].",now(),'".$file."','".$file_type."','".$url_link."','".$message."')";
                }
                $res=mysqli_query($conn,$sql_query);
                if($res)
                {
                    unset($_POST);
                    header("location: batch_details.php?b_id=".$_GET['b_id']."&message=A new item is uploaded successfully!");
                }
                else
                {
                  // echo "<script>alert('Failed to upload the data!')</script>";
                  // echo $res;
                  unset($_POST);
                  header("location: batch_details.php?b_id=".$_GET['b_id']."&message=Failed to upload the data");
                }
                // echo var_dump($_SESSION['user_id']);
                //header("location: batch_details.php?b_id=".$_GET['b_id']."&message=Failed to upload the data");
                // echo "I think, this is the source of error!";
            }
           
          }
          else
          {
            // echo var_dump($_SESSION['user_id']);
            // echo "I think, this is the source of error!";
             header("location: batch_details.php?b_id=".$_GET['b_id']."&message=Failed to upload the data");
          }
?>
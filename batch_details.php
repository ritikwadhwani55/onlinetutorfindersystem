<?php
    session_start();
    include("connect_db.php");
    if(!(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])))
    {
        header("location: login.php?pg=batch_details.php");
    }
    
    if(!(isset($_GET['b_id']) && !empty($_GET['b_id'])))
    {
      header("location: view_batches.php");
    }
    
    if(isset($_GET['message']) && !empty($_GET['message']))
    {
        echo "<script>alert('".$_GET['message']."')</script>";
        unset($_GET['message']);
        header('location: batch_details.php?b_id='.$_GET['b_id']);
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="device=device-width, initial-scale=1.0">
        <title>Batch Details</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="css/style.css" rel="stylesheet">
        <style>
            div.mybatch {
                text-align:center;
                margin: 10px auto;
                /* border-bottom: 2px solid brown; */
                /* background-color:yellow; */
            }
            div.row {
                border-bottom: 2px solid brown;
                margin:auto 1%;
            }
            div.batch_btns form.inline-form {
                display:flex;
                flex-direction:row;
                justify-content:space-around;
                margin-top:1%;
            }
            .btn1 {
              background-color:white;
              border: 1px solid red;
              border-radius: 8px;
              color:red;
              width: 250px;
            }
            .btn1:hover {
              background-color:red;
              color:white;
              
            }
            /* input[type=submit] {
              background-color:purple;
              color:white;
              border:none;
              padding: 4px;
              border-radius: 5px;
            } */
            
            #share {
              text-align: center;
              /* margin: auto 10px; */
              /* display: flex; */
              /* flex-direction: column; */
              justify-content:space-between;

            }
            .collapsible_container {
              
              text-align: center;
             
            }
            .collapse_btn {
              width: 15%;
              background-color: purple;
              color:white;
              padding: 4px;
              border:none;
              margin: auto;
              margin-bottom:5px;
              border-radius: 6px;
            }
            .url_btn {
              width: 12%;
              /* background-color: yellow; */
              color:black;
              border:1px solid grey;
              margin: auto;
              margin-bottom:5px;    
              border-radius: 6px;        
            }
            .bg-modal {
              position:fixed;
              top:0;
              left: 0;
              width: 100%;
              height: 100vh;
              background-color: rgba(0,0,0,0.3);
              display: flex;
              justify-content: center;
              display: none;
            }
            .myModal {
                
                position: relative;
                width: 30%;
                height: 30%;
                display: flex;
                
                justify-content: space-around;
                align-items: center;
                flex-direction: column;
                background: white;
                margin: auto;
            }
            .close-cross-btn {
              position: absolute;
              top: 2px;
              right: 4px;
              cursor:pointer;
              font-weight: bold;
            }
            .submit_btn {
              background-color:yellow;
              color:black;
              border: none;
              font-size: 1.2rem;
              border-radius: 5px;
              font-weight: bold;
              
            }
            .submit_btn:hover {
              background-color:black;
              color:yellow;
            }
            .batch_relevant .batch_share {
                width: 100%;
                height:250px;
                text-align: center;
                border: 1px solid grey;
                border-bottom: none;
                font-size: 1.12rem;
                margin: auto;
                position: relative;
            }
            .batch_relevant {
              display: flex;
            }
            .batch_relevant .batch_share h6 {
              float:right;
              border: 1px solid grey;
              margin: 5px;
              padding: 3px;
              /* margin: 3%; */
              /* text-align: center; */
            }
            .batch_hr {
              color:black;
            }
            .enrolled_icon {
              width: 62px;
              height: 62px;
              border-radius: 3px;
            }
            .course_feedbacks {
              display: none;
            } 
            .student {
              display: flex;
              flex-direction: row;
              justify-content: flex-start;
              align-items: center;
              width: 100%;
              margin: auto;
              border: 5px solid red;
              display: none;
              text-align: center;
            }
            .enrolled_students {
              width: 95%;
              margin: 1.5% auto;
            }
            #fdbk_btn {
              color: black;
              background-color: yellow;
              border-radius: 9px;
            }
            .fbk h5 {
              border-bottom: 2px dotted green;
              border-top: 2px dotted green;
              margin-top: 2%;
              font-family: verdana;
              
            }
            .fbk{
              display: block;
              text-align: center;
              margin:  auto; 
              width: 100%;
              
            }
            
            .change_shared_data {
                display: flex;
                flex-direction: row;
                height: 100px;
                width: 80%;
                justify-content: flex-end;
                text-align: right;
                align-items: flex-end;
                /* background-color: yellow; */
                /* margin: auto 92%; */
                position:absolute;
                right: 5%;
                bottom: 10%;
            }
            .change_shared_data a {
              padding: 5px;
              width: 100px;
              /* margin: auto 92%; */
              flex-self: flex-start;
            }
            div.fbk form{
              width: 100%;
              display: block;
              margin: auto;
              text-align: center;
              display: flex;
              flex-direction: row;
              align-items: center;
              justify-content: center;
            }
            .user_fb {
              /* border-bottom: 2px solid purple; */
              text-align: center;
              /* width: 95%; */
              margin: auto;
              background-color: rgba(182,214,316,0.7);
              /* border: 3px dotted blue; */
              font-weight: bold;
            }
            .finished {
              background-color: red;
              color: pink;
              width: 50%;
              margin: 10px auto;
              border-radius: 4px;
              padding: 4px;
            }
            .meet_link_form {
              display:none;
            }
            @media only screen and (max-width: 732px)
            {
              .btn1 {
                width: 180px;
                font-size: 0.9rem;
                /* font-weight: bold; */
              }
              .share_with_batch {
              display: flex;
              flex-direction: column;
            }
            }
            @media(max-width: 520px)
            {
              .btn1 {
                width: 136px;
                font-size: 0.92rem;
                /* font-weight: bold; */
              }
              .share_with_batch {
              display: flex;
              flex-direction: column;
            }
            }
            @media(max-width:395px)
            {
              .btn1 {
                width: 112px;
                font-size: 0.7rem;
                font-weight: bold;
              }
            }
            @media(max-width:325px)
            {
              .btn1 {
                width: 100px;
                font-size: 0.6rem;
                font-weight: bold;
              }
            }
            
        </style>
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
    <nav class="navbar navbar-expand-md navbar-light">
            <!-- Brand -->
            <a class="navbar-brand" href="homepage.php">Hat-trick</a>
          
            <!-- Toggler/collapsibe Button -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
              <span class="navbar-toggler-icon"></span>
            </button>
          
            <!-- Navbar links -->
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
              <ul class="navbar-nav">
                <li class="nav-item">
                  <a class="nav-link" href="homepage.php">Home</a>
                </li>
                <?php
                  if(isset($_SESSION['teach_id']) && !empty($_SESSION['teach_id']))
                  {
                      echo "<li class='nav-item'>
                      <a class='nav-link' href='teacher_page.php'>Teachers Homepage</a>
                    </li>
                    <li class='nav-item'>
                      <a class='nav-link' href='teacher_batches.php'>My Batches</a>
                    </li>";
                  }
                  else
                  {
                    echo "<li class='nav-item'>
                      <a class='nav-link' href='become_a_tutor.php'>Become a Tutor</a>
                    </li>
                    <li class='nav-item'>
                      <a class='nav-link' href='view_batches.php'>View Batches</a>
                    </li>
                    <li class='nav-item'>
                      <a class='nav-link' href='#'>About Us</a>
                    </li>";
                  }
                ?>
                
                <!-- </li> -->
                <!-- <li class="nav-item">
                  <a class="nav-link" href="#" title="create a batch"><img src="images/images.png" class="batch"></a>
                </li> -->
                
              </ul>
              <!-- <div class="buttons d-flex justify-content-end ml-auto row">
                <a class="color_btn" href="login.php">Login</a>
                <a class="color_btn" href="login.php">Sign Up</a>
              </div>  -->
              <?php
                if(isset($_SESSION['user_id']))
                {
                  echo "<div class='username'><h6>".$_SESSION['full_name']."</h6><a href='logout.php?pg=batch_details.php' class='logout'>Logout</a></div>";
                }
                else
                {
                  echo "<form class='d-flex justify-content-end ml-auto buttons'>
                  <a class='btn btn-outline-success mr-2' href='login.php?pg=batch_details.php'>Login</a>
                  <a class='btn btn-outline-success' href='login.php?pg=batch_details.php'>Sign Up</a>
                  </form>";
                }
              ?>
              </div>
          </nav>
          <div class="fluid-container">
                <div class='batch_header row'>
                    <?php
                        if(isset($_GET['b_id']) && !empty($_GET['b_id']))
                        {
                            $q="select * from batch where batch_id=".$_GET['b_id'];
                            $res=mysqli_query($conn,$q);
                            if($row=mysqli_fetch_assoc($res))
                            {
                                $teach_id=$row['teach_id'];
                            }
                            $_SESSION['b_id']=$_GET['b_id'];
                            $query="select * from batch as b inner join teacher as t on t.teach_id=b.teach_id where b.batch_id=".$_GET['b_id']." and b.teach_id=".$teach_id.";";
                            $res=mysqli_query($conn,$query);
                            if($res)
                            {
                                $row=mysqli_fetch_assoc($res);
                                $hasFinished=$row['isComplete'];
                                if($row['meet_link']!=NULL)
                                {
                                  $meet_link=$row['meet_link'];
                                }
                                else
                                $meet_link='No link';
                                echo "<div class='mybatch' id='batch_details_".$_GET['b_id']."'><h5>".$row['course_name']."</h5>".$row['course_description']."<br>Start date: ".$row['start_date']."<br>Course Duration: ".$row['duration']."<br>Fees: Rs.".$row['fees']."<br>Teacher: ".$row['full_name']."<br>Meet Link: ";
                                //echo "<a href='".$row['meet_link']."' title='Lecture Meet link' class='add_lecture_link'>".$row['meet_link']."</a>";
                                if(isset($row['meet_link']))
                                {
                                   $meet_change='Edit';
                                   echo "<a href='".$row['meet_link']."' title='Lecture Meet link' class='add_lecture_link' target='_blank'>".$row['meet_link']."</a>";
                                }
                                else
                                {
                                  $meet_change='Add';
                                  echo 'Not assigned';
                                  //echo "<form method='POST' class='mx-auto text-center d-block'><label>Meet URL:</label><input type='text' name='meet_url' required><input type='submit' value='Add' name='add_url'></form>";
                                }
                                if(isset($_SESSION['teach_id']) && !empty($_SESSION['teach_id']) && $row['teach_id']==$_SESSION['teach_id'] || isset($_SESSION['admin_id']))
                                {
                                  $query="select * from batch where batch_id=".$_GET['b_id']." and teach_id=".$row['teach_id'];
                                  $r=mysqli_query($conn,$query);
                                  if($r)
                                  {
                                      if(mysqli_num_rows($r)==1)
                                      {
                                        echo "<br><button class='change_meet_url btn btn-dark btn-sm mb-1'>".$meet_change." Lecture Link</button>";
                                        echo "<div class='meet_link_form'><form method='POST' class='mx-auto text-center d-block'><label>Meet URL:</label><input type='text' name='meet_url' required><input type='submit' value='".$meet_change."' name='".strtolower($meet_change)."_url'></form></div>";
                                        echo "<script>
                                        document.getElementsByClassName('change_meet_url')[0].addEventListener('click', () => {
                                          var meet_form=document.querySelector('.meet_link_form');
                                          // console.log(meet_form);
                                          if(meet_form.style.display=='none')
                                          {
                                            meet_form.style.display='block';
                                          }
                                          else
                                          {
                                            meet_form.style.display='none';
                                          }
                                      });</script>
                                        ";
                                      }
                                  }
                                  
                                }
                                
                            }
                            // echo var_dump($hasFinished);
                            if(isset($_SESSION['teach_id']) && $_SESSION['teach_id']==$row['teach_id'] || isset($_SESSION['admin_id']))
                            {
                              if($hasFinished==1)
                              {
                                // echo var_dump($hasFinished);
                                echo "<form method='POST' action='toggle_course.php?is_complete=0&b_id=".$_GET['b_id']."'><input type='submit' id='batch_id_'".$row['batch_id']."' class='btn btn-warning b_id_".$row['batch_id']." d-block text-center mx-auto mt-2' value='Activate the Course' name='activate_btn'></form>";
                              }
                              else
                              {
                                // echo var_dump($hasFinished);
                                echo "<form method='POST' action='toggle_course.php?is_complete=1&b_id=".$_GET['b_id']."'><input type='submit' id='batch_id_'".$row['batch_id']."' class='btn btn-warning b_id_".$row['batch_id']." d-block text-center mx-auto mt-2' value='Finish the Course' name='deactivate_btn'></form>";
                              
                              }
                            }
                            
                            
                        }
                        
                        else
                        {
                           goToTeacherPage();
                        }
                        if($hasFinished==1)
                            {
                                echo "<div class='finished'>Our course is completed Successfully!</div>";
                                echo "<script>
                                setInterval(() => {
                                  var x=document.querySelector('.finished');
                                  if(x.style.backgroundColor=='red')
                                  {
                                    x.style.backgroundColor='yellow';
                                    x.style.color='red';
                                    // x.style.padding='5px';
                                  }
                                  else { x.style.backgroundColor='red';x.style.color='yellow';}
                                }, 800);
                                </script>";
                            }
                        
                        echo "</div>";
                        function goToTeacherPage()
                        {
                          $teach_id=$_SESSION['teach_id'];
                          // echo "I think, this is the source of error!";
                          header("location: teacher_batches.php?teach_id=".$teach_id);
                        }
                        ob_start();
                    ?>
                    
                    <?php

                        if($_SERVER['REQUEST_METHOD']=='POST')
                        {
                          if(isset($_POST['add_url']) || isset($_POST['edit_url']))
                          {
                              $url=$_POST['meet_url'];
                              if($conn)
                              {
                                $q="update batch set meet_link='".$url."' where batch_id=".$_GET['b_id'];
                                $res=mysqli_query($conn,$q);
                                if($res)
                                {
                                   // header('location: batch_details.php?b_id='.$_GET['b_id']);
                                  echo  "<script>alert('Successfully Updated the meet link!')</script>";
                                  /*echo "<br><div class='alert alert-success alert-dismissible text-center mx-auto'><button class='close close-alert' data-dismiss='alert'>&times;</button>
                                  Successfully Updated the meet link!</div>";*/
                                  // alert()
                                  
                                }
                                else
                                {
                                  
                                    echo 'Failed to add meet link!';
                                }
                              }
                          }
                        }
                    ?> 
                </div>
                <div class="batch_btns">
                    <form class='inline-form row mb-2'>
                        <input type="button" class="btn1" name="batch_shares" value="Batch Shares">
                        <input type="button" class="btn1" name="feedbacks" value="Course Feedbacks">
                        <input type="button" class="btn1" name="enrolled_stud" value="Enrolled Students">
                    </form>
                </div>
                <div class="collapsible_container">
                      <a href="#share" data-toggle="collapse">Share data with your Batch</a>
                      <div id="share" class="collapse">
                        
                        <form class="share_with_batch" method="post" enctype="multipart/form-data" action=<?php echo "share_with_batch.php?b_id=".$_SESSION['b_id']?>>
                          <input type="file" name="share_file" id="share_file">
                          <input type="text" name="message" id="message">
                          <!-- <input type="button" value="URL" class="url_btn" id="url_btn"> -->
                          <input type="text" name="url_link" id="url_link" placeholder="Enter URL">
                          <input type="submit" value="Submit" id="submit_data" name="submit_data">
                        </form>
                       </div>
                </div>
                
                <div class="batch_relevant row">
                    <?php
                      $query="select * from batch_shares where batch_id=".$_SESSION['b_id']." order by 	
                      share_id desc";
                      $res=mysqli_query($conn,$query);
                      if($res)
                      {
                        $shares=array();
                        $i=0;
                         while($row=mysqli_fetch_assoc($res))
                         {
                          //  echo var_dump($row);
                            echo "<div class='batch_share overflow-ellipsis' id='batch_share".$row['share_id']."'>";
                            echo "<h6>".$row['share_date_time']."</h6>";
                            $q_sql="select full_name from user where user_id=".$row['user_id'];
                            $res1=mysqli_query($conn,$q_sql);
                            if($r=mysqli_fetch_assoc($res1))
                            {
                              echo "<h6>".$r['full_name']."</h6><br>";
                            }
                            if(!(is_null($row['file']) || empty($row['file']) || $row['file']=='NULL'))
                            {
                              echo "File: ";
                              echo "<br><a href='uploads/".$row['file']."' target='_blank'>".$row['file']."</a><br>";
                            }
                            if(!(is_null($row['url']) || $row['url']=='NULL'))
                            {
                                echo "<br>Link: <a href='".$row['url']."'>".$row['url']."</a>"."<br>";
                            }
                            if(!(is_null($row['message']) || $row['message']=='NULL'))
                            {
                              echo "<br>".$row['message'];
                            }
                            // echo "<hr class='batch_hr'>";
                            $shares[$i++]=$row['share_id'];
                            if($row['user_id']==$_SESSION['user_id'] || isset($_SESSION['admin_id']))
                            {
                              echo "<div class='change_shared_data'><a class='btn btn-sm btn-dark' id='_".$row['share_id']."' href='delete_post.php?b_id=".$_GET['b_id']."&share_id=".$row['share_id']."'>Delete</a></div>";
                            }
                            
                            echo "</div>";
                            
                         }
                      }
                    ?>
                    <?php

                        $sql_q="select * from batch where batch_id=".$_GET['b_id'];
                        $res=mysqli_query($conn,$query);
                        if($row=mysqli_fetch_assoc($res))
                        {
                            $teach_id=$row['teach_id'];
                        }
                    ?>
                </div>
                <div class="enrolled_students">
                      <?php
                        $query="select u.* from enroll as e inner join user as u on e.user_id=u.user_id where batch_id=".$_GET['b_id'];
                        $res=mysqli_query($conn,$query);
                        while($row=mysqli_fetch_assoc($res))
                        {
                            echo "<div class='student'><img class='enrolled_icon' src='images/anonymous-user-circle-icon-vector-18958255.jpg' alt='enrolled_student_icon'><h5 class='name'>".$row['full_name']."</h5>
                            </div>";
                        }
                      ?>
                </div>
                <div class='course_feedbacks'>
                <?php
                    $query="select * from user u inner join enroll e on e.user_id=u.user_id where u.user_id=".$_SESSION['user_id']." and e.batch_id=".$_GET['b_id'];
                    $result=mysqli_query($conn,$query);
                    if($result)
                    {
                        if(mysqli_num_rows($result)==1 && ( isset($_SESSION['admin_id']) || $_SESSION['teach_id']==$teach_id))
                        {
                            echo "
                            <div class='fbk'>
                                <form method='post' class='>
                                  <textarea rows='4' cols='48' class='mx-2' name='feedback' placeholder='Please give your feedback for this course...'></textarea>
                                  <input type='submit' value='Submit' name='fdbk_btn' id='fdbk_btn'>
                                </form>
                                ";
                                
                                
                                  if(isset($_POST['fdbk_btn']))
                                      {
                                          $feedback=$_POST['feedback'];
                                          $query="insert into batch_feedback(batch_id,user_id,feedback) values(".$_GET['b_id'].",".$_SESSION['user_id'].",'".$feedback."')";
                                          $result=mysqli_query($conn,$query);
        
                                          if($result)
                                          {
                                            echo "<script>alert('Your feedback is added successfully!')</script>";
                                          }
                                          else
                                          {
                                            echo var_dump($result);
                                            echo $_GET['b_id'];
                                            echo $_SESSION['user_id'];
                                            echo $feedback;
                                            // echo "<script>alert('Failed to add your feedback!')</script>";
                                          }
                                          
                                      }
                            
                                     
                        }
                        echo " <h5 class='text-center mt-3  mx-auto'>COURSE FEEDBACKS</h5></div>";
                      }
                      
                ?>

                    <div class="students_fdbk">
                    
                        <?php
                            
                            $query="select * from batch_feedback as bf inner join user as u on u.user_id=bf.user_id where bf.batch_id=".$_GET['b_id']." order by bf_id desc";
                            $r=mysqli_query($conn,$query);
                            if($r)
                            {
                              
                                while($row=mysqli_fetch_assoc($r))
                                {

                                    echo "<div class='user_fb'><h6>".$row['full_name']."</h6><p>".$row['feedback']."</p>";
                                    if($row['user_id']==$_SESSION['user_id'])
                                    {
                                      echo "<a class='btn btn-dark btn-md' href='delete_feedback.php?b_id=".$row['batch_id']."&bf_id=".$row['bf_id']."'>Delete</a></div>";
                                    }
                                    
                                }
                            }
                        ?>
                        
                        <?php
                          if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']))
                          {
                                echo "<script>
                                document.querySelector('.dropdown button').addEventListener('click', () => {
                                  var dropdown=document.getElementsByClassName('dropdown-content')[0];
                                  if(dropdown.style.display=='flex')
                                  {
                                    dropdown.style.display='none';
                                  }
                                  else
                                  {
                                    dropdown.style.display='flex';
                                  }
                              });</script>
                                ";
                          }
                        ?>
                    </div>
                </div>
          </div>
          
          <script>
            if (window.history.replaceState) {
            window.history.replaceState( null, null, window.location.href );
              }
            /* document.querySelector('.url_btn').addEventListener('click', function() {
              document.getElementsByClassName('bg-modal')[0].style.display="flex";
            }); 
            
            document.querySelector('.close-cross-btn').addEventListener('click', function() {
              document.getElementsByClassName('bg-modal')[0].style.display="none";
            }); x
            document.querySelector('#submit_btn').addEventListener('click',() => {
                document.getElementsByClassName('bg-modal')[0].style.display="none";
            }); */
            var btns=document.getElementsByClassName("btn1");
            for(let i=0;i<btns.length;i++)
            {
                btns[i].addEventListener('click', () => {
                  if(btns[i].name=='batch_shares')
                  {
                    document.getElementsByClassName('batch_relevant')[0].style.display='flex';
                    for(let div=0;div<document.getElementsByClassName('student').length;div++)
                    {
                      document.getElementsByClassName('student')[div].style.display='none';
                    }
                    document.querySelector('.course_feedbacks').style.display="none"; 
                  }
                  else if(btns[i].name=='enrolled_stud')
                  {
                    document.getElementsByClassName('batch_relevant')[0].style.display='none';
                    for(let div=0;div<document.getElementsByClassName('student').length;div++)
                    {
                      document.getElementsByClassName('student')[div].style.display='flex';
                    }
                    document.querySelector('.course_feedbacks').style.display="none"; 
                  }
                  else if(btns[i].name=='feedbacks')
                  {
                     document.querySelector('.course_feedbacks').style.display="block"; 
                     document.getElementsByClassName('batch_relevant')[0].style.display='none';
                    for(let div=0;div<document.getElementsByClassName('student').length;div++)
                    {
                      document.getElementsByClassName('student')[div].style.display='none';
                    }
                  }
                });
            }
            
            // console.log(document.getElementsByClassName('change_meet_url'));
            
            // document.querySelector('#submit_data').addEventListener('click',function() {
            //     var xhr=new XMLHttpRequest();
            //     xhr.open("POST","share_with_batch.php",true);
            //     xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
            //     var file=document.querySelector("#share_file").value;
            //     var message=document.querySelector("#message").value;
            //     var url_link=document.querySelector("#url_link").value;
                
            //     xhr.send();
            //   }
            // );
            
            var shares=<?php echo json_encode($shares); ?>;
            // for(var i=0;i<shares.length;i++)
            // {
            //     document.querySelector('#_'+shares[i]).addEventListener('click', deletePost, false);
            //     document.querySelector("#_"+shares[i]).myParam=shares[i];
                
            // }
            function deletePost(event)
            {
                // if(confirm("Do you confirm to delete the post!"))
                // {
                  // var xhr=new XMLHttpRequest();
                  // xhr.open('POST', "delete_post.php", true);
                  // xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
                  // var post_id=event.currentTarget.myParam;
                  // xhr.send("share_id="+post_id);
                  // if(this.readyState== 4 && this.status == 200) {
                  //   // alert(JSON.parse(xhr.responseText).message);
                  //   console.log(xhr.responseText);
                  //   location.reload(true);
                  // }
                   
                  
            }
          </script>
          <script>
            if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
            }
          </script>
    </body>
</html>
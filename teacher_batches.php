<?php
  session_start();
  include("connect_db.php");
  if(!(isset($_SESSION['user_id'])) && !(isset($_SERVER['teach_id'])))
  {
    header("location: login.php?pg=teacher_batches.php");
  }
  
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="device=device-width, initial-scale=1.0">
        <title>Teachers Batches</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="css/style.css" rel="stylesheet">
        <style>
            div.batches div.mycard{
                
                border: 1px solid grey;
                box-shadow: 3px 3px 5px grey;
                /* width: 50%; */
                margin: auto;
                /* height: 200px; */
                text-align: center;
                
            }
            /* .mycard {
                text-overflow: ellipsis;
            } */
            
            .overflow-ellipsis {
                /* text-wrap:nowrap; */
                text-overflow: ellipsis;
                overflow: hidden;
                white-space: nowrap;
                height:200px;
                /* overflow:scroll; */
            }

            
                div.batches {
                display: flex;
                /* justify-content: space-around; */
                padding: 4px;
                border-radius: 7px;
                margin: 12px auto;
                
            }
            div.batches div {
                font-size: 1.1rem;
                
            }
            .image img{
                width:100%;
                margin-top:0;
                height:300px;
            }
            nav.navbar {
                margin-bottom:1px;
                box-shadow: 1px 1px 4px grey;
            }
            .nav-link img {
                width:13%;
                border-radius: 14px;
            }
            div.myModal {
                position: absolute;
                top: 0%;
                display:none;
                width:100%;
                height:100vh;
                opacity: 1;
                background-color: rgba(255,255,255,0.3);

            }
            .modal-body form input[type=text], .modal-body form input[type=date] {
                width: 80%;
            }
            div.modal-content {
                 width:71%;
                 top: 5%;
                 /* position:absolute;  */
                /* background-color: rgba(0,0,0,0.5); */
                /* opacity: 0.5; */
                border: 1px solid grey; 
                margin: 0 auto;
                text-align:center;
            }
            .modal-header {
                text-align: center;
                background-color:black;
                color:white;
                justify-content:center;
            }
            .modal-header h5 {
                text-align: center;
            }
            .modal-content .closeBtn,.modal-content p {
                float:right;
                font-size: 47px;
                position:absolute;
                right:3%;
                top: 7%;
                margin-bottom:10px;
                /* cursor: pointer; */
            }
            .modal-content .closeBtn:hover,.modal-content p:hover {
                cursor: pointer;
                background-color: #cef4;
            }
            .col {
                height: 300px;
                border: 1px solid grey;
            }
            div.dot {
                /* position:absolute;
                font-size: 22px;
                top:2px;
                right:2px; */
                float:right;
                margin-bottom: 10px;
                cursor:pointer;
                /* position:relative;
                background-color:blue; */
                text-align:center;
                /* background-color:red; */
                
            } 
            div.dot .dot_dropdown {
                list-style:none;
                display:flex;
                flex-direction:column;
                display:none;
                /* position:absolute; */
                background-color:#80ccff;
                color:black;
            }
            div.view_course_btn {
                height: 45px;
                width: 35px;
            }
            .active {
                background-color: orange;
                border-radius: 18px;
                color:blue;
              }
        </style>
        
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
                <li class="nav-item">
                  <a class="nav-link" href="teacher_page.php">Teachers Page</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="teacher_batches.php">My Batches</a>
                <li>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#" title="create a batch"><img src="images/images.png" class="batch"></a>
                </li>
                
              </ul>
              <!-- <div class="buttons d-flex justify-content-end ml-auto row">
                <a class="color_btn" href="login.php">Login</a>
                <a class="color_btn" href="login.php">Sign Up</a>
              </div>  -->
              <?php
                if(isset($_SESSION['user_id']))
                {
                  echo "<div class='username'><h6>".$_SESSION['full_name']."</h6><a href='logout.php?pg=teacher_batches.php' class='logout'>Logout</a></div>";
                }
                else
                {
                  echo "<form class='d-flex justify-content-end ml-auto buttons'>
                  <a class='btn btn-outline-success mr-2' href='login.php?pg=teacher_batches.php'>Login</a>
                  <a class='btn btn-outline-success' href='login.php?pg=teacher_batches.php'>Sign Up</a>
                  </form>";
                }
              ?>
              </div>
          </nav>
          <div class="fluid-container">
                <div class="image">
                    <img src="images\Online-Tutoring-Market.png" alt="online_tutoring_image">
                </div>
                <?php
                    $query="select teach_id from teacher where user_id=".$_SESSION['user_id'];
                    // echo $_SESSION['user_id'];
                    $res=mysqli_query($conn,$query);
                    if($row=mysqli_fetch_assoc($res))
                    {
                        
                        
                        $teach_id=$row['teach_id'];
                        $query="select * from batch where teach_id=".(int)$teach_id;
                        // echo $teach_id;
                        $res=mysqli_query($conn,$query);
                        if($res)
                        {
                            $count=mysqli_num_rows($res);
                            $batch_ids=array();
                            
                            // $dot_data="<ul class='dot_dropdown' id='".$row['batch_id']."'><li>Delete &#10006;</li></ul>";
                            // echo $count;
                            if($count==1)
                            {
                                $row=mysqli_fetch_assoc($res);
                                $batch_ids[0]=$row['batch_id'];
                                echo "<div class='row batches'>";
                                echo "<div class='col mycard overflow-ellipsis' id='batch_details_".$batch_ids[0]."'><div><div class='dot' id='b".$batch_ids[0]."'>&#10247;<ul class='dot_dropdown' id='mybatch".$batch_ids[0]."'><li><a href='delete.php?pg=teacher_batches.php&batch_id=".$batch_ids[0]."'>Delete &#10006;</a></li></ul></div></div><h5>".$row['course_name']."</h5>".$row['course_description']."<br>Start date: ".$row['start_date']."<br>Course Duration: ".$row['duration']."<br>Fees: Rs.".$row['fees']."<br><button class='btn btn-primary' id='view_course_btn".$batch_ids[0]."'>View Course</button></div></div>";
                            }
                            elseif($count==2)
                            {
                                $row=mysqli_fetch_assoc($res);
                                $batch_ids[0]=$row['batch_id'];
                                echo "<div class='row batches'>";
                                echo "<div class='col-md-4 mycard overflow-ellipsis' id='batch_details_".$batch_ids[0]."'><div><div class='dot' id='b".$batch_ids[0]."'>&#10247;<ul class='dot_dropdown' id='mybatch".$batch_ids[0]."'><li><a href='delete.php?pg=teacher_batches.php&batch_id=".$batch_ids[0]."'>Delete &#10006;</a></li></ul></div></div><h5>".$row['course_name']."</h5>".$row['course_description']."<br>Start date: ".$row['start_date']."<br>Course Duration: ".$row['duration']."<br>Fees: Rs.".$row['fees']."<br><button class='btn btn-primary' id='view_course_btn".$batch_ids[0]."'>View Course</button></div>";
                                $row=mysqli_fetch_assoc($res);
                                $batch_ids[1]=$row['batch_id'];
                                echo "<div class='col-md-4 mycard overflow-ellipsis' id='batch_details_".$batch_ids[1]."'><div class='dot' id='b".$batch_ids[1]."'>&#10247;<ul class='dot_dropdown' id='mybatch".$batch_ids[1]."'><li><a href='delete.php?pg=teacher_batches.php&batch_id=".$batch_ids[1]."'>Delete &#10006;</a></li></ul></div><h5>".$row['course_name']."</h5>".$row['course_description']."<br>Start date: ".$row['start_date']."<br>Course Duration: ".$row['duration']."<br>Fees: Rs.".$row['fees']."<br><button class='btn btn-primary' id='view_course_btn".$batch_ids[1]."'>View Course</button></div></div>";
                            }
                            else
                            {
                                for($i=0;$i<$count;$i++)
                                {
                                    $row=mysqli_fetch_assoc($res);
                                    $batch_ids[$i]=$row['batch_id'];
                                    if($i%3==0)
                                    {
                                        echo "<div class='row batches'>";
                                        echo "<div class='col-sm-3 mycard overflow-ellipsis' id='batch_details_".$batch_ids[$i]."'><div class='dot' id='b".$batch_ids[$i]."'>&#10247;<ul class='dot_dropdown' id='mybatch".$batch_ids[$i]."'><li><a href='delete.php?pg=teacher_batches.php&batch_id=".$batch_ids[$i]."'>Delete &#10006;</a></li></ul></div><h5>".$row['course_name']."</h5>".$row['course_description']."<br>Start date: ".$row['start_date']."<br>Course Duration: ".$row['duration']."<br>Fees: Rs.".$row['fees']."<br><button class='btn btn-primary' id='view_course_btn".$batch_ids[$i]."'>View Course</button></div>";
                                    }
                                    else
                                    {
                                        echo "<div class='col-sm-3 mycard overflow-ellipsis' id='batch_details_".$batch_ids[$i]."'><div class='dot' id='b".$batch_ids[$i]."'>&#10247;<ul class='dot_dropdown' id='mybatch".$batch_ids[$i]."'><li><a href='delete.php?pg=teacher_batches.php&batch_id=".$batch_ids[$i]."'>Delete &#10006;</a></li></ul></div><h5>".$row['course_name']."</h5>".$row['course_description']."<br>Start date: ".$row['start_date']."<br>Course Duration: ".$row['duration']."<br>Fees: Rs.".$row['fees']."<br><button class='btn btn-primary' id='view_course_btn".$batch_ids[$i]."'>View Course</button></div>";
                                        if(($i+1)%3==0)
                                        echo "</div>";
                                    }
                                }
                            }
                        }
                    }
                ?>
                <div class="myModal">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5>Create a Batch</h5>
                        </div>
                        <p class='closeBtn'>&times;</p>
                        <div class="modal-body">
                            <form method="post" enctype="multipart/form-data">
                                <label>Course Name: </label>
                                <div class="form-group">
                                    <input type="text" name="course_name">
                                </div>
                                <label>Course Description: </label>
                                <div class="form-group">
                                    <input type="text" name="course_desc">
                                </div>
                                <label>Start Date: </label>
                                <div class="form-group">
                                    <input type="date" name="course_start_date" id="min_date">
                                </div>
                                <label>Course Duration: </label>
                                <div class="form-group">
                                    <input type="text" name="course_duration">
                                </div>
                                <label>Fees: </label>
                                <div class="form-group">
                                    <input type="text" name="course_fees">
                                </div>
                                <label>Batch Image: </label>
                                <div class="form-group">
                                    <input type="file" name="batch_image">
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="color_btn" name="submit" value="Submit">
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
                <?php
                        if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']))
                        {
                          echo "
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
                        });
                          ";
                      }
                   
                ?>
                <?php
                    if(isset($_POST['submit']))
                    {
                        $course_name=$_POST['course_name'];
                        $course_desc=$_POST['course_desc'];
                        $course_start_date=$_POST['course_start_date'];
                        $course_duration=$_POST['course_duration'];
                        $course_fees=(float)$_POST['course_fees'];
                        $query="select * from teacher where user_id=".$_SESSION['user_id'];
                        $file_name=addslashes($_FILES['batch_image']['name']);
                        $img_file=mysqli_real_escape_string($conn,file_get_contents($_FILES['batch_image']['tmp_name']));
                        $file_type=addslashes($_FILES['batch_image']['type']);
                        $res=mysqli_query($conn,$query);
                        if($row=mysqli_fetch_assoc($res))
                        {
                            $teach_id=$row['teach_id'];
                            $query="insert into batch(teach_id,start_date,duration,course_name,course_description,fees,mime_type,image,file_name) values(".$teach_id.",'".$course_start_date."','".$course_duration."','".$course_name."','".$course_desc."',".$course_fees.",'".$file_type."','".$img_file."','".$file_name."')";
                            $res=mysqli_query($conn,$query);
                            if($res)
                            {
                                echo "<script>alert('Batch created successfully!')</script>";
                            }
                            else
                            {
                                echo "<script>alert('Failed to create a Batch, please try again!')</script>";
                            }
                        }
                        else
                        {
                            echo "Invalid teacher Id";
                        }
                    }
                ?>
                <div class="myfooter">&copy; 2021, Hat-trick</div>
          </div>
          <script>
                if ( window.history.replaceState ) {
                    window.history.replaceState( null, null, window.location.href );
                }
          
            document.querySelector('.closeBtn').addEventListener('click', function() {
                    document.querySelector('.myModal').style.display="none";
            });
            document.querySelector('.batch').addEventListener('click',function() {
                    document.querySelector('.myModal').style.display="block";
            });
              document.getElementById('min_date').min=new Date(new Date().getTime() - new Date().getTimezoneOffset() * 60000).toISOString().split("T")[0];
            
            var batches_array=<?php echo json_encode($batch_ids); ?>;
            // console.log(batches_array); 
            function courseClick() {
                for(var i=0;i<batches_array.length;i++)
                {
                    var x=batches_array[i];
                    // console.log(x); 
                    document.querySelector("#b"+batches_array[i]).addEventListener('click',display_options,false);
                    document.querySelector("#b"+batches_array[i]).myParam=batches_array[i];
                    document.querySelector("#view_course_btn"+batches_array[i]).addEventListener('click',click_batch,false);
                    document.querySelector("#view_course_btn"+batches_array[i]).myParam=batches_array[i];
                }
            }
            courseClick();
            
            function click_batch(evnt)
            {
                var batch_details=document.querySelector("#batch_details_"+evnt.currentTarget.myParam);
                // console.log(evnt,batch_details); 
                batch_details.style.backgroundColor="#ff9999";
                setTimeout(function()
                {
                    batch_details.style.backgroundColor="white";
                },190, batch_details);
                window.location="http://localhost/OnlineTutorFinderSystem/batch_details.php?b_id="+evnt.currentTarget.myParam;
            }
            function display_options(event) {
                document.querySelector("#batch_details_"+event.currentTarget.myParam).removeEventListener("click",click_batch);
                    // console.log(event); 
                    // console.log(event.currentTarget.myParam);
                    var y=document.querySelector('#mybatch'+event.currentTarget.myParam);
                    // console.log(batches_array[i]);
                    // console.log(x);
                    // console.log(y);
                    // console.log(elem);
                    // document.querySelector('')
                    if(y.style.display=='block')
                    {
                        
                        y.style.display="none";
                    }
                    else
                    {
                        y.style.display="block";
                    }
                    courseClick();
            }
            
       
          </script>
    </body>
</html>
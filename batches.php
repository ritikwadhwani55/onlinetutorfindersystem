<?php
  session_start();
  include("connect_db.php");
  if(!(isset($_SESSION['user_id']) && (!empty($_SESSION['user_id']))))
  {
    header("location: login.php?pg=batches.php");
  }
  else
    {
       if(!(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])))
      {
        header("location: homepage.php");
      }
      
    }
    // if(!(isset($_GET['b_id']) && !empty($_GET['b_id'])))
    // {
    //   header("location: view_batches.php");
    // }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="device=device-width, initial-scale=1.0">
        <title>Batches</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style>
          * {
            margin: 0;
            padding: 0;
          }
          .container-fluid {
            margin: 0;
            padding: 0;
          }
          .view_batches {
            text-transform: uppercase;
            color: white;
            background-color: blue;
            text-align: center;
            width: 100%;
          }
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

            .dropdown-content {
                display: flex;
                flex-direction: column;
                display: none;  
                border:1px solid rgba(0,0,0,.5); 
              }
              .dropdown-content a {
                background-color:lightgreen;
                color: rgba(0,0,0,.5);
                border:1px solid rgba(0,0,0,.5); 
              } 

              .dropdown button {
                background: none;
                background-color:lightgreen;
                color: black;
                border: none;
                margin-top: 6px;
                color: rgba(0,0,0,.5);
              }
              .dropdown button:hover {
                color: black;
                border: none;
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
                        echo "
                        <li class='nav-item'>
                        <a class='nav-link' href='teacher_page.php'>Instructor Page</a>
                      </li>
                        ";
                    }
                    if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']))
                    {
                        echo "<div class='dropdown'>
                        <button>Admin View<i class='fa fa-caret-down'></i></button>
                        <div class='dropdown-content'>
                          <a href='users.php'>Users</a>
                          <a href='batches.php'>Batches</a>
                          
                        </div>
                      </div>";
                    }
                ?>
                <li class="nav-item">
                  <a class="nav-link" href="#">About Us</a>
                </li>
               
              </ul>
              <?php
                if(isset($_SESSION['user_id']))
                {
                  echo "<div class='username'><h6>".$_SESSION['full_name']."</h6><a href='logout.php?pg=batches.php' class='logout'>Logout</a></div>";
                }
                else
                {
                  echo "<form class='d-flex justify-content-end ml-auto buttons'>
                  <a class='btn btn-outline-success mr-2' href='login.php?pg=batches.php'>Login</a>
                  <a class='btn btn-outline-success' href='login.php?pg=batches.php'>Sign Up</a>
                  </form>";
                }
              ?>  
            </div>
        </nav>
        <div class="container-fluid">
              <h1 class="view_batches">View all batches</h1>
              <?php
                        $arr=array($_SESSION['admin_id']);
                        $query="select * from batch";
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
                                echo "<div class='col mycard overflow-ellipsis' id='batch_details_".$batch_ids[0]."'><div><div class='dot' id='b".$batch_ids[0]."'>&#10247;<ul class='dot_dropdown' id='mybatch".$batch_ids[0]."'><li><a href='delete.php?pg=batches.php&batch_id=".$batch_ids[0]."'>Delete &#10006;</a></li></ul></div></div><h5>".$row['course_name']."</h5>".$row['course_description']."<br>Start date: ".$row['start_date']."<br>Course Duration: ".$row['duration']."<br>Fees: Rs.".$row['fees']."<br><button class='btn btn-primary' id='view_course_btn".$batch_ids[0]."'>View Course</button></div></div>";
                            }
                            elseif($count==2)
                            {
                                $row=mysqli_fetch_assoc($res);
                                $batch_ids[0]=$row['batch_id'];
                                echo "<div class='row batches'>";
                                echo "<div class='col-md-4 mycard overflow-ellipsis' id='batch_details_".$batch_ids[0]."'><div><div class='dot' id='b".$batch_ids[0]."'>&#10247;<ul class='dot_dropdown' id='mybatch".$batch_ids[0]."'><li><a href='delete.php?pg=batches.php&batch_id=".$batch_ids[0]."'>Delete &#10006;</a></li></ul></div></div><h5>".$row['course_name']."</h5>".$row['course_description']."<br>Start date: ".$row['start_date']."<br>Course Duration: ".$row['duration']."<br>Fees: Rs.".$row['fees']."<br><button class='btn btn-primary' id='view_course_btn".$batch_ids[0]."'>View Course</button></div>";
                                $row=mysqli_fetch_assoc($res);
                                $batch_ids[1]=$row['batch_id'];
                                echo "<div class='col-md-4 mycard overflow-ellipsis' id='batch_details_".$batch_ids[1]."'><div class='dot' id='b".$batch_ids[1]."'>&#10247;<ul class='dot_dropdown' id='mybatch".$batch_ids[1]."'><li><a href='delete.php?pg=batches.php&batch_id=".$batch_ids[1]."'>Delete &#10006;</a></li></ul></div><h5>".$row['course_name']."</h5>".$row['course_description']."<br>Start date: ".$row['start_date']."<br>Course Duration: ".$row['duration']."<br>Fees: Rs.".$row['fees']."<br><button class='btn btn-primary' id='view_course_btn".$batch_ids[1]."'>View Course</button></div></div>";
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
                                        echo "<div class='col-lg-3 col-md-6 mycard overflow-ellipsis' id='batch_details_".$batch_ids[$i]."'><div class='dot' id='b".$batch_ids[$i]."'>&#10247;<ul class='dot_dropdown' id='mybatch".$batch_ids[$i]."'><li><a href='delete.php?pg=batches.php&batch_id=".$batch_ids[$i]."'>Delete &#10006;</a></li></ul></div><h5>".$row['course_name']."</h5>".$row['course_description']."<br>Start date: ".$row['start_date']."<br>Course Duration: ".$row['duration']."<br>Fees: Rs.".$row['fees']."<br><button class='btn btn-primary' id='view_course_btn".$batch_ids[$i]."'>View Course</button></div>";
                                    }
                                    else
                                    {
                                        echo "<div class='col-lg-3 col-md-6 mycard overflow-ellipsis' id='batch_details_".$batch_ids[$i]."'><div class='dot' id='b".$batch_ids[$i]."'>&#10247;<ul class='dot_dropdown' id='mybatch".$batch_ids[$i]."'><li><a href='delete.php?pg=batches.php&batch_id=".$batch_ids[$i]."'>Delete &#10006;</a></li></ul></div><h5>".$row['course_name']."</h5>".$row['course_description']."<br>Start date: ".$row['start_date']."<br>Course Duration: ".$row['duration']."<br>Fees: Rs.".$row['fees']."<br><button class='btn btn-primary' id='view_course_btn".$batch_ids[$i]."'>View Course</button></div>";
                                        if(($i+1)%3==0)
                                        echo "</div>";
                                    }
                                }
                            }
                        }
                    
                ?>
        </div>
        <script>
          if ( window.history.replaceState ) {
                window.history.replaceState( null, null, window.location.href );
          }
            var batches_array=<?php echo json_encode($batch_ids); ?>;
            var array=<?php echo json_encode($arr); ?>;
            // console.log(batches_array); 
            function courseClick() {
                for(var i=0;i<batches_array.length;i++)
                {
                    var x=batches_array[i];
                    console.log(x); 
                    document.querySelector("#b"+batches_array[i]).addEventListener('click',display_options,false);
                    document.querySelector("#b"+batches_array[i]).myParam=batches_array[i];
                    document.querySelector("#view_course_btn"+batches_array[i]).addEventListener('click',click_batch,false);
                    document.querySelector("#view_course_btn"+batches_array[i]).myParam=batches_array[i];
                }
            }
            courseClick();
            document.querySelector(".dropdown button").addEventListener("click", () => {
                  var dropdown=document.getElementsByClassName("dropdown-content")[0];
                  if(dropdown.style.display=='flex')
                  {
                    dropdown.style.display="none";
                  }
                  else
                  {
                    dropdown.style.display="flex";
                  }
              });
            function click_batch(evnt)
            {
                var batch_details=document.querySelector("#batch_details_"+evnt.currentTarget.myParam);
                // console.log(evnt,batch_details); 
                batch_details.style.backgroundColor="#ff9999";
                setTimeout(function()
                {
                    batch_details.style.backgroundColor="white";
                },190, batch_details);
                window.location="http://localhost/OnlineTutorFinderSystem/access_batch.php?b_id="+evnt.currentTarget.myParam;
                // alert(array[0]);
                
            }
            function display_options(event) {
                document.querySelector("#batch_details_"+event.currentTarget.myParam).removeEventListener("click",click_batch);
                    // console.log(event); 
                    console.log(event.currentTarget.myParam);
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
<?php
  session_start();
  ob_start();
  include("connect_db.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="device=device-width, initial-scale=1.0">
        <title>Become a Teacher</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="css/style.css" rel="stylesheet">
        <style>
         
          .image-top {
            position:relative;
            width:100%;
            height:500px;
            margin:0;
            top:2px;
          }
          .image-top .content {
            position:absolute;
            bottom:5%;
            left:2%;
            text-align:center;
            background-color: black;
            padding:7px;
            color:white;
            border-radius: 4px;
            opacity:0.7;
          }
          .image-top img{
            width:100%;
            height:500px;
            margin:0;
            /* opacity:0.7; */
          }
          nav.navbar {
            margin-bottom:0;
            box-shadow:2px 2px 8px grey;
          }
          div.mycards {
            display:flex;
            flex-direction: row;
            justify-content: space-between;
            /* border: 1px solid pink; */
            margin-top: 8px;
            margin:10px;
            /* width:100%; */
            /* margin-left:0;
            margin-right:0; */
          }
          div.mycards .mycard {
            border:1px solid grey;
            /* margin:2px; */
            box-shadow:1px 1px 3px grey;
          }
          div.mycards .mycard p {
            /* width:40%; */
            text-align:center;
            padding:6%;
            font-size:18px;
          }
          div.mycards .mycard h4 {
            text-align:center;
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
              .active {
                background-color: orange;
                border-radius: 18px;
                color:blue;
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
                <li class="nav-item">
                  <a class="nav-link active" href="become_a_tutor.php">Become a Tutor</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="view_batches.php">View Batches</a>
                </li>
                <?php
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
                  echo "<div class='username'><h6>".$_SESSION['full_name']."</h6><a href='logout.php?pg=become_a_tutor.php' class='logout'>Logout</a></div>";
                }
                else
                {
                  echo "<form class='d-flex justify-content-end ml-auto buttons'>
                  <a class='btn btn-outline-success mr-2' href='login.php?pg=become_a_tutor.php'>Login</a>
                  <a class='btn btn-outline-success' href='login.php?pg=become_a_tutor.php'>Sign Up</a>
                  </form>";
                }
              ?>  
            </div>
        </nav>
        <div class="fluid-container">
            <div class="image-top">
                <img src="images\3740035-min-1024x683.jpg" alt="tutor-teaching-pic">
                <div class="content">
                  <h4>Become a Tutor Now</h4>
                  <form method='post'>
                    <input type='submit' class="color_btn px-3" value="Go" name="go">
                  </form>
                </div>
            </div>
            <?php
              if(isset($_POST['go']))
              {
                  if(isset($_SESSION['user_id']) && !empty($_SESSION['user_id']))
                  {
                      $query="select * from teacher where user_id=".$_SESSION['user_id'];
                      $res=mysqli_query($conn,$query);
                      if($row=mysqli_fetch_assoc($res))
                      {
                          echo "<script>alert('You are already a tutor here!')</script>";
                      }
                      else
                      {
                        header("location: teacher_registration.php");
                        ob_end_flush();
                      }
                  }
                  else
                  {
                    echo "<script>alert('Please do the login first!')</script>";
                    header("location: login.php?pg=become_a_tutor.php");
                  }
              }
            ?>
            <div class="mycards row">
                <div class="mycard col-md-6">
                  <h4>Teach Online</h4>
                  <p>Online mode gives you the opportunity to teach from any where and anytime.</p>
                </div>
                <div class="mycard col-md-6">
                  <h4>Experience</h4>
                  <p>Teaching Online will not only help you to share your knowledge, but also give you an experience!</p>
                </div>
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
            <div class="homefooter">&copy; 2021, Hat-trick</div>
        </div>
       
    </body>
</html>
<?php
  session_start();
  include("connect_db.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="device=device-width, initial-scale=1.0">
        <title>Homepage</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style>
            span.username {
             
              display:block;
              float:right; 
              /* border:1px solid black; */
              margin-left:auto;
            }
            img {
                width:100%;
                height:500px;
                /* margin: 0 auto; */
            }
            div.carousel {
                /* margin-top:10px; */
                
                margin: auto;
                /* display: block; */
                width: 98%;
                height:500px;
                text-align: center;
               box-shadow: 5px 5px grey;
               margin-bottom: 10px;
              }
              div.container-fluid {
                display: flex;
                flex-direction: column;
                min-height: 100%;
                width: 100%;
                /* background-color: blue; */
                margin:0 auto;
              }
              div.container-fluid h2 {
                text-align: center;
              }
              
              div.small_block .row img {
                  width:50%;
                  float:right;
                  height:250px;
              }
              div.small_block .row .col-md-6 p {
                  width:40%;
                  font-family: monospace;
                  font-size: 18px;
              }
              hr {
                height:3px;
              }
              .small_block .row {
                display: flex;
                justify-content: space-between;
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
                  <a class="nav-link active" href="homepage.php">Home</a>
                </li>
                <li class="nav-item">
                <!-- <li class="nav-item">
                  <a class="nav-link" href="homepage.php">Home</a>
                </li class="nav-item"> --> 
                  <a class="nav-link" href="become_a_tutor.php">Become a Tutor</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="view_batches.php">View Batches</a>
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
              <!-- <div class="buttons d-flex justify-content-end ml-auto row">
                <a class="color_btn" href="login.php">Login</a>
                <a class="color_btn" href="login.php">Sign Up</a>
              </div>  -->
              <?php
                if(isset($_SESSION['user_id']))
                {
                  echo "<div class='username'><h6>".$_SESSION['full_name']."</h6><a href='logout.php?pg=homepage.php' class='logout'>Logout</a></div>";
                }
                else
                {
                  echo "<form class='d-flex justify-content-end ml-auto buttons'>
                  <a class='btn btn-outline-success mr-2' href='login.php?pg=homepage.php'>Login</a>
                  <a class='btn btn-outline-success' href='login.php?pg=homepage.php'>Sign Up</a>
                  </form>";
                }
              ?>
              
            </div>
          </nav>
          <div class="carousel" data-ride="carousel" id="demo">
            <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <!-- <li data-target="#demo" data-slide-to="2"></li> -->
            </ul>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="images\Online Tutoring Jobs.jpg" alt="Online Tutoring Jobs">
                  </div>
               
                <div class="carousel-item">
                    <img src="images\What-Is-an-Online-Tutor-Job-and-How-to-Get-One.jpg" alt="E-learning">
                </div>
          </div>
                <!-- Left and right controls -->
                <a class="carousel-control-prev" href="#demo" data-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#demo" data-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </a>
          </div>
          <div class="container-fluid">
            <div class="small_block">
              <hr>
              <h2>Learn from the best Teachers around the Globe</h2>
            <div class="row">
              
              <div class="col-md-6 col-sm-12">
               
              <p>We have one of best tutors with highest ratings given by enrolled students.
                Connect with them and they will make you an expertise in that domain/subject.
              </p>
              </div>
              <div class="col-md-6 col-sm-12"><img src="images\Online-Tutoring-Jobs-From-Home.jpg" alt="learn_from_tutors"></div>
              
            </div>
            <hr>
          </div>
          <div class="small_block">
            <hr>
            <h2>Be a Tutor</h2>
            <div class="row">
              <div class="col-md-6">
                <p>Become a teacher and get a chance to share your knowledge around the different corners of the world.
                </p>
              </div>
              <div class="col-md-6">
                <img src="images\Best-Online-Tutoring-Jobs (1).jpg" alt="become_a_tutor">
              </div>
            </div>
            <hr>
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
        
    </body>
</html>
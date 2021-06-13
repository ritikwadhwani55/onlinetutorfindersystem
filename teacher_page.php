<?php
  session_start();
  include("connect_db.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="device=device-width, initial-scale=1.0">
        <title>Teachers Page</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style>
        .container-fluid {
          width: 100%;
        }
          .curriculum_img {
            width: 100%;
            height:320px;
            margin: 0;
            box-shadow: 5px 10px grey;
          }
          .teach_online_img {
            width:130px;
            height: 130px;
            border-radius: 20px;
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
                </li class="nav-item">
                  <a class="nav-link" href="teacher_batches.php">My Batches</a>
                <li>
                </li>
                <?php
                  if(isset($_SESSION['teach_id']) && !empty($_SESSION['teach_id']))
                  {
                      echo "
                      <li class='nav-item'>
                      <a class='nav-link active' href='teacher_page.php'>Instructor Page</a>
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
                  echo "<div class='username'><h6>".$_SESSION['full_name']."</h6><a href='logout.php?pg=teacher_page.php' class='logout'>Logout</a></div>";
                }
                else
                {
                  echo "<form class='d-flex justify-content-end ml-auto buttons'>
                  <a class='btn btn-outline-success mr-2' href='login.php?pg=teacher_page.php'>Login</a>
                  <a class='btn btn-outline-success' href='login.php?pg=teacher_page.php'>Sign Up</a>
                  </form>";
                }
              ?>
              </div>
          </nav>
          <div class="container-fluid">
                <img src="./images/Success-Stories-of-People-Who-Landed-Online-Tutoring-Jobs.jpg" alt="curriculum image" class="curriculum_img" />
          </div>
          <div class="container-fluid">
                
                    <h3 class="text-center mt-3">So many reasons to start</h3>
                    <div class="teach_online row d-flex justify-content-space-between align-content-center ">
                        <div class="col-md-4 sm-12 text-center">
                        <img src="images/Online-Tutors00.jpg" class="teach_online_img">
                          <h5>Inspire learners</h5>
                          Teach what you know and help learners explore their interests, gain new skills, and advance their careers.
                        </div>
                        <div class="col-md-4 sm-12 text-center">
                        <img src="images/download.jfif" class="teach_online_img">
                        <h5>Teach your way</h5>
Publish the course you want, in the way you want, and always have of control your own content.
                        </div>
                        <div class="col-md-4 sm-12 text-center">
                        <img src="images/reward.png" class="teach_online_img">
                        <h5>Get rewarded</h5>
                        Expand your professional network, build your expertise, and earn money on each paid enrollment.
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
          </div>
          <div class="myfooter">&copy; 2021, Hat-trick</div>
          
    </body>
</html>
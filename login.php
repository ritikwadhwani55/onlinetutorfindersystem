<?php
  session_start();
  ob_start();
  include("connect_db.php");
  
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="device=device-width, initial-scale=1.0">
        <title>Log in Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="css/style.css" rel="stylesheet">
        <style>
          div.login {
            border: 1px solid grey;
           
            width: 50%;
            display: none;
            margin:auto;
            text-align: center;
            padding: 12px;
            padding-bottom: 15px;
            
          }
          div.login_button button[type="button"] {
              border:none;
              background-color:black;
              
              padding:7px;
              color:white;
              width:22%;
              margin-top:5px;
              margin-left:10px;
          }
          div.login_button {
            display: flex;
            flex-direction: row;
            justify-content: center;
          }
          .signup {
            width:70%;
            margin:auto;
            text-align:center;
            border: 1px solid grey;
            padding:7px;
            padding-left:4px;
            padding-right:4px;
            display: block;
          }
          input[type="text"],input[type="email"],input[type="password"] {
             margin:5px;
          }
          .signup input[type="text"],.signup input[type="email"],.signup input[type="password"] {
            width:75%;
          }
          @media(max-width:769px)
          {
            div.login_button button[type="button"] {
               width: 80px;
              padding:7px;
            }
          }
          p.pswd_match {
            display:none;
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
                </li class="nav-item">
                  <a class="nav-link" href="become_a_tutor.php">Become a Tutor</a>
                <li>
                <li class="nav-item">
                  <a class="nav-link" href="#">About Us</a>
                </li>
                
              </ul>
              <!-- <div class="buttons d-flex justify-content-end ml-auto row">
                <a class="color_btn" href="login.php">Login</a>
                <a class="color_btn" href="login.php">Sign Up</a>
              </div> -->
              <form class="d-flex justify-content-end ml-auto buttons">
                  <a class="btn btn-outline-success mr-2" href="login.php">Login</a>
                  <a class="btn btn-outline-success" href="login.php">Sign Up</a>
                </form>
            </div>
          </nav>
          <div class="container-fluid">
            <div class="login">
              <form method="post">
                <div class="form-group">
                  <label>Username: </label>
                  <input type="email" name="email" required>
                </div>
                <div class="form-group">
                  <label>Password: </label>
                  <input type="password" name="pswd" required>
                </div>
                <input type="submit" value="Submit" class="color_btn" name="submit">
              </form>
              
          <?php
                
                if(isset($_POST['submit']))
                  {
                      $username=$_POST['email'];
                      $pswd=$_POST['pswd'];
                      if($conn)
                      {
                          $query="select * from user where email_id='".$username."' and password='".$pswd."'";
                          $res=mysqli_query($conn,$query);
                          if($row=mysqli_fetch_assoc($res))
                          {
                              
                              echo "<script>alert('Login successfull!')</script>";
                              $_SESSION['user_id']=$row['user_id'];
                              $pg=$_GET['pg'];
                              $_SESSION['full_name']=$row['full_name'];
                              $query="select teach_id from teacher where user_id=".$_SESSION['user_id'];
                              $res=mysqli_query($conn,$query);
                              if($res)
                              {
                                $row=mysqli_fetch_assoc($res);
                                $_SESSION['teach_id']=$row['teach_id'];
                              }
                              // echo "<script>window.location='http://localhost/OnlineTutorFinderSystem/become_a_tutor.php'</script>";
                              // echo "<script>history.go(-1)</script>";
                              // header("location:javascript://history.go(-1)");
                              // ob_end_flush();
                              // exit();
                              // ob_start();

                              
                              // exit();
                              $query="select * from user u inner join admin a on u.user_id=a.user_id where u.user_id=".$_SESSION['user_id'];
                              $res=mysqli_query($conn,$query);
                              if($res)
                              {
                                $count=mysqli_num_rows($res);
                                if($count==1)
                                {
                                  $row=mysqli_fetch_assoc($res);
                                  $_SESSION['admin_id']=$row['admin_id'];
                                }
                              }
                              header('location:'.$pg);
                              ob_end_flush();
                          }
                          else
                          {
                            echo "<script>alert('Incorrect email id or password!')</script>";
                          }
                          
                      }
                      else
                      {
                        die("Sorry we failed to connect: ".mysqli_connect_error());
                      }
                      
                  }
                  
          ?>
                <div class="login_button">
                  <button type="button" class="login_btn">Log in</button>
                  <button type="button" class="signin_btn">Sign in</button>
                  </div>
                  
              </div>
            
            <div class="signup">
              <form method='post'>
                <label>Full Name:</label>
                <div class="form-group">
                  
                  <input type="text" name="full_name" required>
                </div>
                <label>
                  Email Id:
                </label>
                <div class="form-group">
                  
                  <input type="email" name="email_id" required>
                </div>
                <label>Password:</label>
                <div class="form-group">
                  
                  <input type="password" name="passwrd" required>
                </div>
                <label>Confirm Password:</label>
                <div class="form-group">
                  
                  <input type="password" name="confirm_pswd" required>
                  <!-- <p class="pswd_match">The password and the Confirm Password field doesn't match!</p> -->
                  
                </div>
                <label>Contact:</label>
                <div class="form-group">
                  <input type="text" name="contact" required>
                </div>
                <input type="submit" value="Submit" class="color_btn submit_signup_btn" name="submit_signup_btn">
              </form>
              <?php
                if(isset($_POST['submit_signup_btn']))
                {
                  $full_name=$_POST['full_name'];
                  $email=$_POST['email_id'];
                  $pswd=$_POST['passwrd'];
                  $confirm_pswd=$_POST['confirm_pswd'];
                  $contact=$_POST['contact'];
                  // echo $confirm_pswd;
                  if(isset($pswd) && isset($confirm_pswd) && strcmp($confirm_pswd,$pswd)!=0)
                  {
                    echo "<script>alert('The password and the Confirm Password field doesnt match!');</script>";
                  }
                  else
                  {
                      $r=mysqli_query($conn,"select * from user where email_id='".$email."'");
                      $count=mysqli_num_rows($r);
                      if($count>0)
                      {
                        echo "<script>alert('Email id already exists!');</script>";
                      }
                      else
                      {
                        $sql="insert into user(full_name,email_id,password,contact) values('".$full_name."','".$email."','".$pswd."',".(int)$contact.")";
                        $r=mysqli_query($conn,$sql);
                        if($r)
                        {
                          echo "<script>alert('Account created successfully!');</script>";

                        }
                        else
                        {
                          echo "<script>alert('Failed to create account. Please try again later!');</script>";
                        }
                      // echo "<script>alert('done')</script>";
                    }
                }
              }
                
              ?>
                <div class="login_button">
                  <button type="button" class="login_btn1">Log in</button>
                  <button type="button" class="signin_btn1">Sign in</button>
                </div>
                
            </div>
            </div>
            <div class="myfooter">&copy; 2021, Hat-trick</div>
          
          <script>
              document.querySelector('.login_btn1').addEventListener("click",function() {
                  document.querySelector(".login").style.display="block";
                  document.querySelector('div.signup').style.display="none";
                  document.querySelector(".login_btn").disabled=true;
              });
              document.querySelector('.signin_btn').addEventListener("click",function() {
                  document.querySelector("div.login").style.display="none";
                  document.querySelector('div.signup').style.display="block";
                  document.querySelector('.signin_btn1').disabled=true;
              });
              document.querySelector(".login_btn1").addEventListener("click",function() {
                  document.getElementsByClassName('signup').style.display="none";
                  document.getElementsByClassName("login").style.display="block";
                  document.querySelector(".login_btn").disabled=true;
                  
              });
              document.querySelector('.submit_signup_btn').addEventListener("click",function() {
                  document.querySelector('p.pswd_match').style.display="block";
                  setTimeout(function(){
                    document.querySelector('p.pswd_match').style.display="none";
                  },4000);
              });
          </script>
          
    </body>
    
</html>
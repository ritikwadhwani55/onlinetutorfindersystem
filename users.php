<?php
    session_start();
    include("connect_db.php");
    if(!(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id'])))
    {
        header("location: login.php");
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="device=device-width, initial-scale=1.0">
        <title>Users</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style>
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
              table.display_users {
                    border-collapse: collapse;
                    width: 98%;
                    text-align: center;
                    margin: auto;
                    
              }
              table.display_users td {
                padding-bottom: 5px;
              }
              table.display_users tr {
                border: 1px solid black;
               
              }
              table.display_users tr:nth-child(even)
              {
                color: white;
                background-color: blue;
                font-weight: bold;
              }
              table.display_users tr:nth-child(odd)
              {
                color: red;
                background-color: white;
                font-weight: bold;
              }
              table.display_users th {
                  background-color:white;
                  color: black;
                  font-weight: bold;
              }
              @media(max-width: 696 px)
              {
                .display_users td {
                    font-szie: 0.96rem;
                }
              }
              @media(max-width: 576 px)
              {
                .display_users td {
                    font-szie: 0.87rem;
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
          <h3 class='text-center text-primary'>VIEW ALL USERS</h3>
          <?php
                if($conn)
                {
                    $sql_query="select * from user where user_id!=9";
                    $res=mysqli_query($conn,$sql_query);
                    if($res)
                    {
                        echo "<div class='table-responsive-sm'><table class='display_users'><tr><th>User Id</th><th>Full Name</th><th>Email Id</th>
                        <th>Password</th><th>Contact</th><th>Update</th></tr>";
                        $user_ids=array();
                        $i=0;
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $user_ids[$i++]=$row['user_id'];
                            echo "<tr><td>".$row['user_id']."</td><td>".$row['full_name']."</td><td>".$row['email_id']."</td>
                            <td>".$row['password']."</td><td>".$row['contact']."</td><td><button type='button' class='btn btn-danger m-1' id='id_".$row['user_id']."' href='delete_user.php?user_id=".$row['user_id']."'>Delete</button><button type='button' class='btn btn-warning' id='id_".$row['user_id']."'>Edit</button></td></tr>";
                        }
                        echo "</table></div>";
                    }
                }
          ?>
          <script>
              var userIds=<?php echo json_encode($user_ids); ?>;
              for(let i=0;i<userIds.length;i++)
              {
                  document.querySelector('#id_'+userIds[i]).addEventListener('click', () => {
                      if(confirm('Do you confirm to delete a User?'))
                      {
                      window.location.href="http://localhost/OnlineTutorFinderSystem/delete_user.php?user_id="+userIds[i];
                      }
                      
                  });
              }
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
        </script>
    </body>
</html>
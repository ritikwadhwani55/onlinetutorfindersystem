<?php
  session_start();
  include("connect_db.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="device=device-width, initial-scale=1.0">
        <title>Teacher registration</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <link href="css/style.css" rel="stylesheet">
        <style>
            .teacher_register {
                width:85%;
                border:1px solid grey;
                margin:0 auto;
                text-align:center;
                padding:3px;
                margin-bottom: 10px;
                box-shadow: 1px 1px 3px grey;
            }
            .teacher_register input[type=text],.teacher_register input[type=date] {
                width:79%;
            }
            textarea {
                width:79%;
            }
            .teacher_register label {
                font-size: 20px;
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
              <?php
                if(isset($_SESSION['user_id']))
                {
                  echo "<div class='username'><h6>".$_SESSION['full_name']."</h6><a href='logout.php' class='logout'>Logout</a></div>";
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
        <div class="container-fluid">
        <div class='teacher_register'>
            <form method="post" enctype="multipart/form-data">
                <label>Full Name: </label>
                <div class='form-group'>
                    
                    <input type="text" name="full_name" required>
                </div>
                <label>Qualification: </label>
                <div class="form-group">
                    
                    <input type="text" name="qualification" required>
                </div>
                <label>Date of birth: </label>
                <div class="form-group">
                    
                    <input type="date" name="dob" required>
                </div>
                <label>Gender: </label>
                <div class="form-group">
                    <input type="radio" name="gender" value="Male">Male &nbsp;
                    <input type="radio" name="gender" value="Female">Female &nbsp;
                    <input type="radio" name="gender" value="Other">Other &nbsp;
                </div>
                <label>Contact:</label>
                <div class="form-group">
                    <input type="text" name="contact" required>
                </div>
                <label>Address:</label>
                <div class="form-group">
                    <textarea rows='3' cols='35' name='address' required>
                    </textarea>
                </div>
                <label>Country:</label>
                <div class="form-group">
                    <input type="text" name="country" required>
                </div>
                <label>Upload Document:</label>
                <div class="form-group">
                    <input type="file" name="document" required>
                    
                </div>
                <h6>***Upload pdf file only</h6>
                <div>
                    <input type="submit" value="Submit" name="submit" class="color_btn">
                </div>
            </form>
        </div>
        <?php
            if(isset($_POST['submit']) && isset($_SESSION['user_id']))
            {
                $name=$_POST['full_name'];
                $qualification=$_POST['qualification'];
                $dob=$_POST['dob'];
                $gender=$_POST['gender'];
                $contact=$_POST['contact'];
                $address=$_POST['address'];
                $country=$_POST['country'];
                $file_name=addslashes($_FILES['document']['name']);
                $type=addslashes($_FILES['document']['type']);
                $document=mysqli_real_escape_string($conn,file_get_contents($_FILES['document']['tmp_name']));
                // $document=base64_encode($document);
                $u_id=$_SESSION['user_id'];
                $query="insert into teacher(full_name,qualification,dob,gender,user_id,contact,address,country,mime_type,document,file_name) values('".$name."','".$qualification."','".$dob."','".$gender."',".(int)$u_id.",".$contact.",'".$address."','".$country."','".$type."','".$document."','".$file_name."')";
                if($conn)
                {
                    $res=mysqli_query($conn,$query);
                    if($res)
                    {
                        $query="select max(teach_id) from teacher";
                        $res=mysqli_query($conn,$query);
                        if($res)
                        {
                            $row=mysqli_fetch_assoc($res);
                            $teach_id=$row['max(teach_id)'];
                            // echo $teach_id;
                            // echo "<script>alert('".$teach_id."!')</script>"; 
                        }
                        echo "<script>alert('Successfully registered!')</script>";
                        
                        echo "<script>window.location='http://localhost/OnlineTutorFinderSystem/teacher_page.php'</script>";
                    }
                    else
                    {
                        echo "<script>alert('Failed to register, Please try again later!')</script>";
                        // echo var_dump($res);
                    }
                }
            }
        ?>
        <br>
        <!-- <div class="homefooter">&copy; 2021, Hat-trick</div> -->
        </div>
        <script>

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
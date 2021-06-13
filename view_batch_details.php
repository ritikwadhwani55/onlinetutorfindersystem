<?php
    session_start();
    include("connect_db.php");
    if(!(isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])))
    {
        header("location: login.php?pg=batch_details.php");
    }
    else
    {
      if(!(isset($_SESSION['teach_id']) && !empty($_SESSION['teach_id'])))
      {
          // header("location: homepage.php");
      }
    }
    if(isset($_GET['message']) && !empty($_GET['message']))
    {
        echo "<script>alert('".$_GET['message']."')</script>";
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
            .card {
                text-align: center;
                width: 80%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: space-between;
                /* margin: auto; */
                border: none;
            }
            .myEnrollModal {
                text-align: center;
                background-color: white;
                height: 320px;
                width: 73%;
                border-radius: 8px;
                position:relative;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                /* display: block; */
                margin: auto;
                /* top: 50%; */
                /* left: 50%; */
            }
            .cross {
              position: absolute;
              top: 0;
              right: 3px;
              cursor: pointer;
            }
            .card input[type=text]
            {
                width: 75%;
                border-radius: 7px;
                margin-bottom: 5px;
                /* margin: 2px; */
            }
            .expiry_date {
                width: 75%;
                display: flex;
                flex-direction: row;
                align-items: center;
                justify-content: center;.
                text-align: center;
                margin: auto;
            }
            .expiry_date input[type=text]
            {
                width: 100%;
                border-radius: 7px;
                margin: 2px;
            }
            .upi {
                width: 80%;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                /* margin: auto; */
                display: none;
            }
            .upi input[type=text] {
                width: 75%;
                border-radius: 7px;
                margin: 2px;
            }
            .enroll {
                margin: auto;
                width: 100%;
                text-align: center;
                margin-top: 7px;
            }
            .enroll_btn {
                color:blue;
                background-color: lightgrey;
                display: block;
                border-radius: 5px;
                padding: 4px 15px;
                /* width: 15%; */
                margin: auto;
                text-align: center;
                /* align-items: center; */
                /* align-items: center; */
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
            .collapsible_container {
                display: none;
            }
            .enroll_modal {
                text-align: center;
                position: fixed;
                top:0;
                left:0;
                background-color: black;
                opacity: 1;
                width: 100%;
                height: 100vh;
                
                display: flex;
                display: none;
                align-items: center;
                justify-content: center;
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
            }
            .batch_relevant .batch_share h6 {
              float:right;
              border: 1px solid grey;
              /* margin: 3%; */
              /* text-align: center; */
            }
            
            .batch_hr {
              color:black;
            }
            #fdbk_btn {
              color: black;
              background-color: yellow;
              border-radius: 9px;
            }
            .students_fdbk h5 {
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
            @media only screen and (max-width: 732px)
            {
              .btn1 {
                width: 180px;
                font-size: 0.9rem;
                /* font-weight: bold; */
              }
            }
            @media(max-width: 520px)
            {
              .btn1 {
                width: 136px;
                font-size: 0.92rem;
                /* font-weight: bold; */
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
                  <a class="nav-link" href="become_a_tutor.php">Become a Tutor</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="view_batches.php">View Batches</a>
                </li>
                
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

                  if(isset($_SESSION['admin_id']) && !empty($_SESSION['admin_id']))
                  {
                      echo "<div class='dropdown'>
                      <button>Admin View<i class='fa fa-caret-down'></i></button>
                      <div class='dropdown-content'>
                        <a href='users.php'>Users</a>
                        <a href='batches.php'>Batches</a>
                        <a href='#'>Tutors</a>
                      </div>
                    </div>";
                  }  

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
                            $_SESSION['b_id']=$_GET['b_id'];
                            $query="select * from batch where batch_id=".$_GET['b_id'].";";
                            $res=mysqli_query($conn,$query);
                            if($res)
                            {
                                $row=mysqli_fetch_assoc($res);
                                $course_name=$row['course_name'];
                                echo "<div class='mybatch' id='batch_details_".$_GET['b_id']."'><h5>".$row['course_name']."</h5>".$row['course_description']."<br>Start date: ".$row['start_date']."<br>Course Duration: ".$row['duration']."<br>Fees: Rs.".$row['fees']."</div>";
                            }
                        }
                        else
                        {
                           goToTeacherPage();
                        }
                        function goToTeacherPage()
                        {
                          $teach_id=$_SESSION['teach_id'];
                          
                          header("location: teacher_batches.php?teach_id=".$teach_id);
                        }
                        ob_start();
                    ?> 
                </div>
                <div class="enroll">
                    <button type="button" class="enroll_btn" id="enroll_button" value="Enroll"> Enroll</button>
                </div>
                <div class="enroll_modal">
                    <div class="myEnrollModal">
                        <p class="cross">&#10006;</p>
                        <h5>Enroll Now!</h5>
                        <div class="form-group">
                            <select name="payment_type">
                                <option>Debit Card/Credit Card</option>
                                <option>UPI </option>
                            </select>
                        </div>
                        <div class="card">
                            <form method="post">
                              <input type="text" placeholder="Enter card number" name="card_no" required>
                              <div class="expiry_date">
                                  <input type="text" placeholder="MM" name="MM" required>
                                  <input type="text" placeholder="YYYY" name="YYYY" required>
                              </div>
                              <input type="text" name="name_on_card" placeholder="Name on Card" required>
                              <?php
                                $query="select * from batch where batch_id=".$_GET['b_id'];
                                $res=mysqli_query($conn,$query);
                                if($res)
                                {
                                  $row=mysqli_fetch_assoc($res);
                                  $fees=$row['fees'];

                                }
                              ?>
                              <input type="text" name="amount" value="<?php echo $fees; ?>" placeholder="amount" readonly>
                              <input type="submit" class="enroll_btn" name="card_payment_btn" value="Submit">
                            </form>
                        </div>
                        <div class="upi">
                          <form method="post">
                            <input type="text" placeholder="Account Name" name="acc_name" required>
                            <input type="text" placeholder="Account number" name="acc_no" required>
                            <input type="text" placeholder="amount"  value="<?php echo $fees; ?>" name="amount" readonly="readonly">
                            <input type="text" placeholder="UPI PIN" name="upi_pin" required>
                            <input type="submit" class="enroll_btn" name="upi_payment_btn" value="Submit">
                          </form>
                        </div>
                    </div>
                </div>
                <?php
                  if($_SERVER['REQUEST_METHOD']=='POST')
                  {
                    if(isset($_POST['card_payment_btn']))
                    {
                      $card_no=(int)$_POST['card_no'];
                      $mm=(int)$_POST['MM'];
                      $yyyy=(int)$_POST['YYYY'];
                      $name_on_card=$_POST['name_on_card'];
                      $amount=$_POST['amount'];
                      $date=date('Y-m-d H:i:s');
                      $query="insert into enroll(batch_id,student_name,user_id,enroll_date,unenroll_date,payment_type,acc_name,acc_no,card_no,name_on_card,amount) values(".$_GET['b_id'].",'".$_SESSION['full_name']."',".$_SESSION['user_id'].",now(),'NULL','Credit/Debit','NULL','NULL',".$card_no.",'".$name_on_card."',".$amount.")";
                      $res=mysqli_query($conn,$query);
                      if($res)
                      {
                        echo "<script>alert('Successfully enrolled for ".$course_name." course!')</script>";
                        echo "<script>window.location.href='http://localhost/OnlineTutorFinderSystem/batch_details.php?b_id=".$_GET['b_id']."'</script>";
                      }
                      else
                      {
                        echo "<script>alert('Failed to enrolled for ".$course_name." course!')</script>";
                      }
                    }
                    else
                    {
                        if(isset($_POST['upi_payment_btn']))
                        {
                          $acc_name=(int)$_POST['acc_name'];
                          $acc_no=$_POST['acc_no'];
                          $amount=$_POST['amount'];
                          $upi_pin=$_POST['upi_pin'];
                          $query="insert into enroll(batch_id,student_name,user_id,enroll_date,unenroll_date,payment_type,acc_name,acc_no,card_no,name_on_card,amount,upi_pin) values(".$_GET['b_id'].",'".$_SESSION['full_name']."',".$_SESSION['user_id'].",now(),'NULL','UPI','".$acc_name."',".$acc_no.",'NULL','NULL',".$amount.",".$upi_pin.")";
                          $res=mysqli_query($conn,$query);
                          if($res)
                          {
                            echo "<script>alert('Successfully enrolled for ".$course_name." course!')</script>";
                            echo "<script>window.location.href='http://localhost/OnlineTutorFinderSystem/batch_details.php?b_id=".$_GET['b_id']."'</script>";
                          }
                          else
                          {
                            echo "<script>alert('Failed to enrolled for ".$course_name." course!')</script>";
                          }
                        }
                    }
                  }
                ?>
                <div class="batch_btns">
                    <form class='inline-form row mb-2'>
                        <input type="button" class="btn1" name="batch_shares" value="Batch Shares">
                        <input type="button" class="btn1" name="feedbacks" id="feedback_btn" value="Course Feedbacks">
                        <input type="button" class="btn1" name="enrolled_stud" value="Enrolled Students">
                    </form>
                </div>
                
                <div class="collapsible_container">
                      <a href="#share" data-toggle="collapse" disabled>Share data with your Batch</a>
                      <div id="share" class="collapse"disabled>
                        
                        <form method="post" enctype="multipart/form-data" action=<?php echo "share_with_batch.php?b_id=".$_SESSION['b_id']?>>
                          <input type="file" name="share_file" id="share_file">
                          <input type="text" name="message" id="message">
                          <input type="button" value="URL" class="url_btn" id="url_btn">
                          <input type="submit" value="Submit" id="submit_data" name="submit_data">
                        </form>
                       </div>
                </div>
                <div class="bg-modal">
                      <div class="myModal">
                        <h3>URL link</h3>
                        <!-- <div class="modal-content"> -->
                        
                        <input type="text" name="url_link" id="url_link">
                        <input type="submit" value="Submit" name="submit_btn" id="submit_btn" class="submit_btn">
                        <span class="close-cross-btn">X</span>
                        
                      </div>
                </div>
                <!-- <div class="batch_relevant row">
                    <?php
                      $query="select * from batch_shares where batch_id=".$_SESSION['b_id'];
                      $res=mysqli_query($conn,$query);
                      if($res)
                      {
                         while($row=mysqli_fetch_assoc($res))
                         {
                          //  echo var_dump($row);
                            $q_sql="select full_name from user where user_id=".$row['user_id'];
                            $res1=mysqli_query($conn,$q_sql);
                            if($r=mysqli_fetch_row($res1))
                            {
                              echo "<h5>".$r['full_name']."</h5>";
                            }
                            echo "<div class='batch_share overflow-ellipsis' id='batch_share".$row['share_id']."'>";
                            echo "<h6>".$row['share_date_time']."</h6>";
                            if(!(is_null($row['file']) || empty($row['file']) || $row['file']=='NULL'))
                            {
                              echo "File: ";
                              echo "<a href='uploads/".$row['file']."' target='_blank'>".$row['file']."</a><br>";
                            }
                            if(!(is_null($row['url']) || $row['url']=='NULL'))
                            {
                                echo "Link: <a href='".$row['url']."'>".$row['url']."</a>"."<br>";
                            }
                            if(!(is_null($row['message']) || $row['message']=='NULL'))
                            {
                              echo $row['message'];
                            }
                            // echo "<hr class='batch_hr'>";
                            echo "</div>";
                            
                         }
                      }
                    ?>
                </div> -->
                <div class="course_feedbacks">
                
                    <div class="students_fdbk">
                        <?php
                            echo "<h5 class='text-center mt-3  mx-auto'>COURSE FEEDBACKS</h5>";
                            $query="select * from batch_feedback as bf inner join user as u on u.user_id=bf.user_id where bf.batch_id=".$_GET['b_id']." order by bf_id desc";
                            $r=mysqli_query($conn,$query);
                            if($r)
                            {
                                while($row=mysqli_fetch_assoc($r))
                                {
                                    echo "<div class='user_fb'><h6>".$row['full_name']."</h6><p>".$row['feedback']."</p></div>";
                                }
                            }
                        ?>
                    </div>
              </div>
          </div>
          
          <script>
            if (window.history.replaceState) {
            window.history.replaceState( null, null, window.location.href );
              }
            document.querySelector('.url_btn').addEventListener('click', function() {
              document.getElementsByClassName('bg-modal')[0].style.display="flex";
            });
            
            document.querySelector('.close-cross-btn').addEventListener('click', function() {
              document.getElementsByClassName('bg-modal')[0].style.display="none";
            });
            document.querySelector('#submit_btn').addEventListener('click',() => {
                document.getElementsByClassName('bg-modal')[0].style.display="none";
            });
            // document.querySelector(".enroll_btn").addEventListener("click", function() {
            document.querySelector('select').addEventListener("change", () => {
                var x=document.querySelector('select').value;
                if(x=="UPI")
                {
                    document.querySelector(".upi").style.display="block";
                    document.querySelector(".card").style.display="none";
                }
                else
                {
                    document.querySelector(".upi").style.display="none";
                    document.querySelector(".card").style.display="block"; 
                }
            });
            document.querySelector(".cross").addEventListener("click",() => {

                document.getElementsByClassName("enroll_modal")[0].style.display= "none";
            });

            document.querySelector("#enroll_button").addEventListener("click", () => {
                document.getElementsByClassName("enroll_modal")[0].style.display="flex";
            });
            document.getElementById('feedback_btn').addEventListener('click', () => {
              
              var course_fdbk=document.querySelector('.students_fdbk');
              if(course_fdbk.style.display=="block")
              {
                course_fdbk.style.display="none";
              }
              else
              {
                course_fdbk.style.display="block";
              }

            });


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
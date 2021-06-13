<?php
    session_start();
    if(isset($_GET['pg']) && !empty($_GET['pg']))
    {
        $page=$_GET['pg'];
    }
    session_destroy();
    echo "<script>window.location='http://localhost/OnlineTutorFinderSystem/".$page."'</script>";
?>
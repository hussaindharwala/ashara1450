<?php
    session_start();
    if(!isset($_SESSION["username"])) {
        // header("Location: https://ashara1450.vercel.app/index.php");
        // exit();
        echo "<script> location.href='https://ashara1450.vercel.app/index.php'; </script>";
        exit;
    }
?>
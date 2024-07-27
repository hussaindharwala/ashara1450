<?php
    session_start();
    // Destroy session
    if(session_destroy()) {
        // Redirecting To Home Page
        // header("Location: https://ashara1450.vercel.app/login.html");
        echo "<script> location.href='https://ashara1450.vercel.app/login.html'; </script>";
        exit;
    }
?>
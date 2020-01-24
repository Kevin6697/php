<?php
session_start();
if(isset($_SESSION['username'])){
    echo "Welcome  ". $_SESSION['username'];
}else{
    echo"<script>alert('Login Required');</script>";
    echo"<script>window.location.href='session.php';</script>";  
}
echo"<br/>";
echo"<a href='displaySession.php?logout=1' name='logout'>Logout</a>";

if(isset($_GET['logout'])){
    // unset($_SESSION['username']);
    session_destroy();
    echo"<script>alert('Logout Successfully');</script>";
    echo"<script>window.location.href='session.php';</script>";  
}
?>
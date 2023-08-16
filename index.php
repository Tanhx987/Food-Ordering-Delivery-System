<?php
include("config.php");

if(!isset($_SESSION['user'])){
    header("location: Login.html");
}else{
    header("location: dashboard.php");
}
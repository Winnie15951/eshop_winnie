<?php

if(!isset($_SESSION)){
    session_start();
}

if(! isset($_SESSION['eshop_manager'])){
    header('Location: _main_demo_manager.php');
    exit;
}


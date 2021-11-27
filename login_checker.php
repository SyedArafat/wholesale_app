<?php

if(isset($must_be_seller) && $must_be_seller == true){
    if($_SESSION['user_type'] != "Seller")
        header("Location: {$home_url}index.php?action=login_as_seller");
}

if(isset($require_login) && $require_login==true){
    if(!isset($_SESSION['user_type'])){
        header("Location: {$home_url}views/login.php?action=please_login");
    }
}

// if it was the 'login' or 'register' or 'sign up' page but the customer was already logged in
else if(isset($page_title) && ($page_title=="Login" || $page_title=="Sign Up")){
    // if user not yet logged in, redirect to login page
    if(isset($_SESSION['user_type'])){
        header("Location: {$home_url}/views/index.php?action=already_logged_in");
    }
}
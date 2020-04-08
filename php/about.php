<?php
// Configuration file 
require_once "include/config.php";

?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <title>Rebbit - Your world of frogs</title>
</head>
<!--Custom styling-->
<style>
    body{
        background-color: #f0ece0;
        margin: 0.25em; 
    }
    h1{
        padding-top: 1em; 
        padding-bottom: 0.25em; 
        font-weight: 600;
        color:#4f676c;
        text-align: left;
        font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
    }
    .nav_page{
        background-color: #f0ece0;
    }
    .about{
        display: flex;
        justify-content: space-evenly;
        flex-wrap: wrap;
    }
    .about_desc{
        font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
        background-color: #4e666b07;
        text-align: justify;
        padding: 20px;
    }
    .about_desc_text{
        color: #50504e;
    }
    .about_img{
        max-height: 700px;
        min-width: 150px;
        padding: 20px;
        margin: auto;
        width: auto;
    }
</style>

<body style="margin: 0.25em; background-color: #f1f0f0;">    
<!-- NAVIGATION BAR-->
    <?php
        require_once "include/navbar.php";
    ?>
    
    <!--ABOUT-->
    <div class="container-fluid" style="padding: 20px;">
        <h1>About</h1>
        <div class="about_flex about">
            <!-- TODO: Fix styling -->
            <div class="about_desc col-sm-6">
                <p class="about_desc_text">Rebbit is a Reddit style Discussion Forum website inspired by the wonderful world of the amphibia anura.</p>
                <p class="about_desc_text">Rebbit is a Canadian social news collection, content rating, and discussion website dedicated to frogs. 
                    Content is divided into 'Knots', where each Knot is a collection of logically related posts. 
                    Registered users can create and follow Knots, create posts, comment on posts, and vote up or down both posts or comments. 
                    Unregistered users are limited to viewing posts and comments on Rebbit. 
                    Rebbit users are given the capability to customize their profile and Knots that they own. 
                    Rebbit provides a platform for users to interact with posts and discussions through a comment and content rating system available to registered users.
                    Unregistered users will be presented with the view to log in within the navigation bar or on comments. 
                    Registered users have access to different functionality that will become visibile within the navigation bar after logged in. 
                    Administrators also have different functionality that regular registered users will not. 
                    These capabilities for administrators will be presented within the navigation bar, but will not for all other user types. </p>
            </div>
            <!-- TODO: Add citation caption -->
            <div class="about_img col-sm-6">
                <img src="../images/test_images/Anoures.jpg" class="img-fluid about_img">
            </div>
        </div>
    </div>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="../bootstrap/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
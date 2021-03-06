<?php
// Configuration file 

session_start();
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
<!-- Custom styling -->
<style>
  body{
    background-color: #f1f0f0;
    margin: 0.25em;
  }
  .top_desc{
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
  }
  .post{
    max-width: 200px;
    padding: 2px;
    margin-right: 10px;
  }
  .post_info{
    margin-top: 0.4em;
    padding: 10px;
    border-bottom: dashed 0.8px #4f676c;
  }
  .post_info:hover{
    background-color: darkseagreen;
    opacity: 0.8;
  }
  .post_desc{
    color: #50504e;
    font-size: small;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    max-height: 150px;
    overflow: hidden;
  }
  .post_title{
    color: #50504e;
    font-weight: 200;
    font-family: Cambria, Cochin, Georgia, Times, 'Times New Roman', serif;
    padding-right: 5px;
    display: inline;
  }
  .post_knot{
    font-weight: 600;
    color: #4f676c;
    font-family: 'Courier New', Courier, monospace;
    margin-top: 2px;
    font-size: small;
  }
  .post_date{
    font-family: 'Courier New', Courier, monospace;
    font-size: smaller;
    color: #5b767c ;
    display: inline;
  }
  .flex_post{
    display: flex;
    justify-content: space-evenly;
    flex-wrap: wrap;
  }
  .trending, .your_knots{
    max-height: 2000px;
  }

  h1, h2, h3{
    font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
  }
  
  /* width */
  ::-webkit-scrollbar {
    width: 6px;
  }
  
  /* Track */
  ::-webkit-scrollbar-track {
    background: #f1f0f0; 
    border-radius: 10px;
  }
  
  /* Handle */
  ::-webkit-scrollbar-thumb {
    background: #a8d1ca; 
    border-radius: 10px;
  }
  
  /* Handle on hover */
  ::-webkit-scrollbar-thumb:hover {
    background: #b8dbd5; 
  }
  .post_upvote{
    min-height: 30px;
    max-width: 60px;
    margin: auto;
    padding: 10px;
  }
  .comment_button{
    max-height: 30px;
    padding-left: 50px;
  }
  
</style>

<body style="margin: 0.25em; background-color: #f1f0f0;">    
<!-- NAVIGATION BAR-->
    <?php
        require_once "include/navbar.php";

        if(isset($_SESSION['user_name'])){
          echo("<div style=\"padding:15px\"><p style=\"color:#4f676c\"><i>Hello, ".$_SESSION['user_name']." </i></p></div>");
        }
    ?>
  
  <!-- 2 column layout -->
  <div class="container-fluid">
    <h1 style="padding-top: 1em; color:#4f676c;">Recent Activity</h1>
    <p class="top_desc">Hop to it partner. Also, the columns will automatically stack on top of each other when the screen is less than 768px wide.</p>
    <div class="row">
      <?php
      // YOUR KNOTS
      if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
            echo '<div class="col-sm-6 overflow-auto your_knots overflow-auto" style="background-color: #b7d6c6; padding: 1em; border-radius: 25px;" >';
            echo '<h3 style="padding-bottom:.25em; color:#50504e;">Your knots</h3>';

            // LIMIT 10: keeps from being too much information
            // theoretically have scroll/multiple pages via javascript
            $sql = "SELECT knot_name, post_id, post_title, image_location, p.create_date AS pdate
                    FROM Post AS p, Knot AS k
                    WHERE p.knot_id = k.knot_id
                        AND knot_id IN(SELECT knot_id
                                       FROM FollowingKnot
                                       WHERE user_id = ?)
                        AND knot_id NOT IN(SELECT knot_id
                                           FROM BannedFromKnot
                                           WHERE user_id = ?)";

            if($stmt = mysqli_prepare($link, $sql)){
              // Bind variables to the prepared statement as parameters
              mysqli_stmt_bind_param($stmt, "i", $param_userid);
              $param_userid = $_SESSION['user_id'];

              if(mysqli_stmt_execute($stmt)){
                mysqli_stmt_bind_result($stmt, $knot_name, $post_id, $post_title, $image_location, $pdate);
                echo '<div class="flex_post">';
                while (mysqli_stmt_fetch($stmt)){
                    // link to post
                    echo '<a href="post.php?post_id='.$post_id.'">';
                    echo "<div class=\"post\">";
                    echo '<p class="post_knot">'.$knot_name.'</p>';
                    echo '<img src="'.$image_location.'" alt="'.$post_title.'" class="img-thumbnail">';
                    echo '<div class="post_info">';
                    echo '<p class="post_title">'.$post_title.'</p>';
                    echo '<img src="images/graphics/UpvoteDownvote.png" alt="..." class="post_upvote" >';
                    echo '<p class="post_date">'.$pdate."</p>";
                    echo '<img src="../images/assets/chat-icon.png" class="comment_button">';
                    echo "</div></div>";
                    echo '</a>';
                }
                echo "</div>";
              }
            }else{
              echo "sorry, an error has occured. Please try again later";
            }

            echo '</div>';
            echo '<div class="col-sm-6 trending overflow-auto" style="background-color: #e7e4e4; padding: 1em; border-radius: 25px; ">';
        }else{
          echo '<div class="col-sm-12 trending overflow-auto" style="background-color: #e7e4e4; padding: 1em; border-radius: 25px; ">';
        }

        ?>

        <!-- TRENDING -->
        <h3 style="padding-bottom:.25em; color:#4f676c;">Trending</h3>

        <!-- Flex -->
        <?php

            // LIMIT 10: keeps from being too much information
            // theoretically have scroll/multiple pages via javascript
            
            $sql = "SELECT knot_name, user_name, post_id, post_title, image_location, post_body, p.create_date AS pdate
                    FROM Knot AS k, Post AS p, User as u
                    WHERE k.knot_id = p.knot_id
                        AND u.user_id = p.user_id
                        AND k.knot_id IN (SELECT knot_id
                                         FROM FollowingKnot
                                         GROUP BY knot_id
                                         ORDER BY count(user_id))";

            $query = mysqli_query($link, $sql) or die(mysqli_error($link));

            echo '<div class="flex_post">';
            while ($result = mysqli_fetch_array($query)){
                // link to 
                echo '<a href="post.php'.$result["post_id"].'">';
                echo "<div class=\"post\">";
                echo '<p class="post_knot">'.$result["knot_name"].'</p>';
                echo '<img src="'.$result["image_location"].'" alt="'.$result["post_title"].'" class="img-thumbnail">';
                echo '<div class="post_info">';
                echo '<p class="post_title">'.$result["post_title"].'</p>';
                echo '<p class="post_desc">'.$result["username"].'</p>';
                echo '<img src="images/graphics/UpvoteDownvote.png" alt="..." class="post_upvote" >';
                echo '<p class="post_date">'.$result["pdate"]."</p>";
                echo "</div></div>";
                echo '</a>';
            }

            
            echo "</div>";
        ?>

        </div>
      </div>
    </div>
  </div>
  
  <?php
      // Close connection
      mysqli_close($link);
  ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="../bootstrap/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
<?php

    session_start();

    require_once "include/config.php";
    require_once "include/authorize.php";

    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] === false){
        header("location: ../index.php");
    }

    $admin = is_admin($_SESSION["user_id"]);
    if(!$admin){
        header("location: ../index.php");
    }

    $sql = "UPDATE User SET delete_date = NOW() WHERE user_id = ?";
    if($stmt = mysqli_prepare($link, $sql)){
        mysqli_stmt_bind_param($stmt, "i", $param_userid);
        $param_userid = $_GET["user_id"];

        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }else{
        echo "Oops! Something went wrong. Please try again later";
    }


    mysqli_close($link);

?>
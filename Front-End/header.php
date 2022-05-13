<?php

session_start();

if(!isset($_SESSION["style"])) {
    $_SESSION["style"] = 1;
}

if(isset($_GET["style"])) {
    if(is_numeric($_GET["style"]) && ($_GET["style"] == "1" || $_GET["style"] == "2" || $_GET["style"] == "3")) {
        $_SESSION["style"] = (int)$_GET["style"];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" href="./reset.css">-->
    <link rel="stylesheet" href="/front-end/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
<?php
session_start();
unset($_SESSION["isAdmin"]);
header("Location: ./");
exit;
?>
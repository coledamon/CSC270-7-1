<?php
session_start();
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function createUser($dbConn, $username, $hashPass) {
    $query = "INSERT INTO Users(
                        username,
                        password_hash)
                    VALUES (
                    \"".$username."\",
                    \"".$hashPass."\")";
    $result = @mysqli_query($dbConn, $query);
    return $result? $result : @mysqli_error($dbConn);
}

if(isset($_POST["username"]) && isset($_POST["password"]) && $_POST["username"] && $_POST["password"]) {
    $username = sanitizeInput($_POST["username"]);
    $password= sanitizeInput($_POST["password"]);
    $hashPass = password_hash($password, PASSWORD_DEFAULT);

    $result = createUser($dbConn, $username, $hashPass);
    if($result != 1) {
        echo json_encode(json_decode('{"error": "'.$result.'"}'));
    }
    else {
        $_SESSION["isAdmin"] = true;
        echo true;
    }
    connClose($dbConn);
}
else {
    echo json_encode(json_decode('{"error": "All information is required"}'));
}
?>

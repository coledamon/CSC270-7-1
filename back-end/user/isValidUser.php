<?php
session_start();
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function getUserByUsername($dbConn, $username) {
    $query = "SELECT JSON_OBJECT(
                'id', u.id,
                'Username', u.username,
                'PasswordHash', u.password_hash) as User
                FROM Users u
                WHERE u.username = \"".$username."\";";
    $result = @mysqli_query($dbConn, $query);
    return $result? $result : @mysqli_error($dbConn);
}

if(isset($_POST["username"]) && $_POST["username"] && isset($_POST["password"]) && $_POST["password"]) {
    $username = sanitizeInput($_POST["username"]);
    $rawObject = getUserByUsername($dbConn, $username);
    $json = formatRecords($rawObject);
    if(!str_contains($json, "error")) {
        $passMatch = password_verify($_POST["password"],json_decode($json)->PasswordHash);
    }
    if(str_contains($json, "error") || !$passMatch) {
        echo json_encode(json_decode('{"error": "Invalid Credentials"}'));
    }
    else {
        $_SESSION["isAdmin"] = true;
        echo true;
    }
    connClose($dbConn);
}
else {
    echo json_encode(json_decode('{"error": "No Username or Password provided"}'));
}
?>

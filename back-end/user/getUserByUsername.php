<?php
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
if(isset($_GET["username"]) && $_GET["username"]) {
    $username = sanitizeInput($_GET["username"]);
    $json = formatRecords(getUserByUsername($dbConn, $username));
    if($json == "null") {
        echo json_encode(json_decode('{"error": "Invalid Username"}'));
    }
    else {
        echo $json;
    }
    connClose($dbConn);
}
else {
    echo json_encode(json_decode('{"error": "No Username provided"}'));
}
?>

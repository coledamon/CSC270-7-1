<?php
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

if(isset($_POST["username"]) && isset($_POST["hashPass"]) && $_POST["username"] && $_POST["hashPass"]) {
    $username = sanitizeInput($_POST["username"]);
    $hashPass = sanitizeInput($_POST["hashPass"]);

    $result = createUser($dbConn, $username, $hashPass);
    if($result != 1) {
        echo json_encode(json_decode('{"error": "'.$result.'"}'));
    }
    else {
        echo "{}";
    }
    connClose($dbConn);
}
else {
    echo json_encode(json_decode('{"error": "All information is required"}'));
}
?>

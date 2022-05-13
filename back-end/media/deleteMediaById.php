<?php
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function deleteMediaById($dbConn, $id) {

    $query = "DELETE FROM Media
                WHERE id = ".$id.";";

    $result =  @mysqli_query($dbConn, $query);
    return $result? $result : @mysqli_error($dbConn);
}
if(isset($_GET["id"]) && $_GET["id"]) {
    if(is_numeric($_GET["id"])) {
        $id = (int)sanitizeInput($_GET["id"]);
        $result = deleteMediaById($dbConn, $id);
        if($result != 1) {
            echo json_encode(json_decode('{"error": "'.$result.'"}'));
        }
        else {
            echo true;
        }
        connClose($dbConn);
    }
    else {
        echo json_encode(json_decode('{"error": "Invalid Id"}'));
    }
}
else {
    echo json_encode(json_decode('{"error": "No Id"}'));
}
?>

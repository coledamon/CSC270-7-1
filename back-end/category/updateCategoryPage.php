<?php
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function updateCategoryPage($dbConn, $id, $title, $body) {
    $queryUpdate = "UPDATE CategoryPage
                    SET ";
    $queryWhere=  " WHERE category_id =".$id;
    $queryUpdate .= ($title != null) ? "title =\"".$title."\", " : "";
    $queryUpdate .= ($body != null) ? "body=\"".$body."\", " : "";
    $queryUpdate = substr($queryUpdate, 0, strripos($queryUpdate, ","));
    $result = @mysqli_query($dbConn, $queryUpdate.$queryWhere);
    return $result? $result : @mysqli_error($dbConn);
}
if(isset($_POST["id"]) && $_POST["id"]) {
    if(is_numeric($_POST["id"])) {
        if((isset($_POST["title"]) || isset($_POST["body"])) && ($_POST["title"] || $_POST["body"])) {
            $id = (int)sanitizeInput($_POST["id"]);
            $title = isset($_POST["title"]) ? sanitizeInput($_POST["title"]): null;
            $body= isset($_POST["body"]) ? sanitizeInput($_POST["body"]): null;

            $result = updateCategoryPage($dbConn, $id, $title, $body);
            if($result != 1) {
                echo json_encode(json_decode('{"error": "'.$result.'"}'));
            }
            else {
                echo true;
            }
        }
        else {
            echo json_encode(json_decode('{"error": "'.var_dump($_POST).'"}'));
        }
        connClose($dbConn);
    }
    else {
        echo json_encode(json_decode('{"error": "Invalid Id"}'));
    }
}
else {
    echo json_encode(json_decode('{"error": "No Id Provided"}'));
}
?>

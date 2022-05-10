<?php
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function createCategoryPage($dbConn, $category_id, $title, $body) {
    @mysqli_query($dbConn, "Update Category set used = true where category_id = ".$category_id);

    $queryInsert = "INSERT INTO CategoryPage(
                        category_id";
    $queryValues=  "VALUES (
                    ".$category_id;
    if($title != null) {
        $queryInsert .= ", title";
        $queryValues .= ", \"".$title."\"";
    }
    if($body != null) {
        $queryInsert .= ", body";
        $queryValues .= ", \"".$body."\"";
    }
    $queryInsert .= ") ";
    $queryValues .= ") ";
    $result = @mysqli_query($dbConn, $queryInsert.$queryValues);
    return $result? $result : @mysqli_error($dbConn);
}

if(isset($_POST["name"]) && isset($_POST["authorId"]) && isset($_POST["categoryId"])) {
    if(is_numeric($_POST["categoryId"])) {
        $category_id = (int)sanitizeInput($_POST["categoryId"]);
        $title = isset($_POST["title"]) ? sanitizeInput($_POST["title"]) : null;
        $body = isset($_POST["body"]) ? sanitizeInput($_POST["body"]) : null;
        $result = createCategoryPage($dbConn, $category_id, $title, $body);
        if($result != 1) {
            echo json_encode(json_decode('{"error": "'.$result.'"}'));
        }
        else {
            echo "{}";
        }
        connClose($dbConn);
    }
    else {
        echo json_encode(json_decode('{"error": "Invalid Id"}'));
    }
}
else {
    echo json_encode(json_decode('{"error": "All information is required"}'));
}
?>

<?php
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function getCategoryByUse($dbConn, $use) {
    $query = "SELECT JSON_OBJECT(
                'id', c.id,
                'Name', c.category_name,
                'Used', c.used,
                'Title', cp.title,
                'Body', cp.body) as Category
                FROM Category c
                JOIN CategoryPage cp
                    ON cp.category_id = c.id
                WHERE c.used = ".$use.";";
    $result = @mysqli_query($dbConn, $query);
    return $result? $result : @mysqli_error($dbConn);
}
if(isset($_GET["use"]) && $_GET["use"]) {
    $use = sanitizeInput($_GET["use"]);
    $json = formatRecords(getCategoryByUse($dbConn, $use));
    if($json == "null") {
        echo json_encode(json_decode('{"error": "Invalid Use State"}'));
    }
    else {
        echo $json;
    }
    connClose($dbConn);
}
else {
    echo json_encode(json_decode('{"error": "No Use State"}'));
}
?>

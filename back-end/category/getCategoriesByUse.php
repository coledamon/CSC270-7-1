<?php
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function getCategoriesByUse($dbConn, $use) {
    $query = "SELECT JSON_OBJECT(
                'id', c.id,
                'Name', c.category_name,
                'Used', If(c.used, cast(true as json), cast(false as json))) as Category
                FROM Category c
                WHERE c.used = ".$use.";";
    $result = @mysqli_query($dbConn, $query);
    return $result? $result : @mysqli_error($dbConn);
}
if(isset($_GET["use"]) && $_GET["use"]) {
    $use = sanitizeInput($_GET["use"]);
    $json = formatRecords(getCategoriesByUse($dbConn, $use));
    if(!str_starts_with($json, "[")) {
        $json = json_encode(json_decode("[".formatRecords(getCategoriesByUse($dbConn, $use))."]"));
    }
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

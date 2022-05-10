<?php
include_once "../dbUtils.php";

header('Content-Type: application/json');

$dbConn = ConnGet();

function getCategoryByName($dbConn, $name) {
    $query = "SELECT JSON_OBJECT(
                'id', c.id,
                'Name', c.category_name,
                'Used',  If(c.used, cast(true as json), cast(false as json)),
                'Title', cp.title,
                'Body', cp.body) as Category
                FROM Category c
                JOIN CategoryPage cp
                    ON cp.category_id = c.id
                WHERE c.category_name = ".$name.";";
    $result = @mysqli_query($dbConn, $query);
    return $result? $result : @mysqli_error($dbConn);
}
if(isset($_GET["name"]) && $_GET["name"]) {
    $name = sanitizeInput($_GET["name"]);
    $json = formatRecords(getCategoryByName($dbConn, $name));
    if($json == "null") {
        echo json_encode(json_decode('{"error": "Invalid Category Name"}'));
    }
    else {
        echo $json;
    }
    connClose($dbConn);
}
else {
    echo json_encode(json_decode('{"error": "No Category Name"}'));
}
?>
